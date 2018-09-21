<template>
    <div>
        <LoadingIndicator v-if="isLoading"/>
        <div v-else-if="activeEventContainer !== null" class="container">
            <EventResult :eventContainer="activeEventContainer"
                         :future-events="futureEvents"
            />
        </div>
        <NoQuestionnaire v-else :events="futureEvents"/>
    </div>
</template>

<script>
    import axios from "axios"
    import EventResult from './components/EventResult'
    import LoadingIndicator from '../components/LoadingIndicator'
    import NoQuestionnaire from '../components/NoQuestionnaire'

    export default {
        data() {
            return {
                isLoading: true,

                activeEventContainer: null,
                semesters: []
            }
        },
        components: {
            LoadingIndicator,
            EventResult,
            NoQuestionnaire
        },
        computed: {
            futureEvents: function () {
                let events = [];
                const now = new Date();
                const todayDate = now.getFullYear() + "-" + ("0" + now.getMonth()).slice(-2) + "-" + ("0" + now.getDay()).slice(-2);
                this.semesters.forEach(s => {
                    events = events.concat(s.events.filter(e => e.date > todayDate));
                });
                events.reverse();
                return events;
            }
        },
        mounted() {
            //set identifier
            if (!localStorage.identifier) {
                localStorage.identifier = Math.random().toString(36).substr(2, 20);
            }

            this.identifier = localStorage.identifier;

            //remember when started with questionnaire
            this.startedAt = new Date();

            axios.get(window.location + "api/active")
                .then((response) => {
                    let eventContainer = {
                        event: response.data,
                        answers: [],
                        template: null
                    };

                    //get more infos if event exists
                    if (eventContainer.event !== null) {
                        //parse the template
                        eventContainer.template = JSON.parse(eventContainer.event.template);

                        //get questionnaire result
                        axios.get(window.location + "api/" + eventContainer.event.id + "/participants")
                            .then((response) => {
                                eventContainer.participants = response.data;
                                this.activeEventContainer = eventContainer;
                                this.isLoading = false;
                            });
                    } else {
                        this.isLoading = false;
                    }

                    //get semesters with their events
                    axios.get(window.location + "api/semesters")
                        .then((response) => {
                            this.semesters = response.data;
                        });
                });
        },
    }

</script>