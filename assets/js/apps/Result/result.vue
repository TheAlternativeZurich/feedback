<template>
    <div>
        <LoadingIndicator v-if="isLoading"/>
        <div v-else class="container">
            <EventResult :eventContainer="activeEventContainer"
                         :future-events="selectableEvents"
            />
        </div>
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
            selectableEvents: function () {
                let events = [];
                this.semesters.forEach(s => {
                    events = events.concat(s.events.filter(e => e.date >= this.activeEventContainer.event.date));
                });
                events.reverse();
                return events;
            }
        },
        mounted() {
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
        }
    }

</script>