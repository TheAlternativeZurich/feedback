<template>
    <div>
        <LoadingIndicator v-if="isLoading"/>
        <div v-else-if="activeEventContainer !== null">
            <EventFeedback :eventContainer="activeEventContainer"
                           :future-events="selectableEvents"
                           :is-finished="isFinished"
                           @answer="answer(activeEventContainer, arguments[0])"
                           @finish="finish"
            />
        </div>
        <NoQuestionnaire v-else :events="futureEvents"/>
    </div>
</template>

<script>
    import axios from "axios"
    import EventFeedback from './components/EventFeedback'
    import LoadingIndicator from '../components/LoadingIndicator'
    import NoQuestionnaire from '../components/NoQuestionnaire'

    export default {
        data() {
            return {
                isLoading: true,
                identifier: null,

                activeEventContainer: null,
                semesters: [],
                startedAt: null,
                isFinished: false
            }
        },
        components: {
            LoadingIndicator,
            EventFeedback,
            NoQuestionnaire
        },
        methods: {
            finish: function () {
                axios.post(window.location + "api/" + this.activeEventContainer.event.id + "/finish", {
                    identifier: this.identifier,
                    timeNeededInSeconds: ((new Date()).getTime() - this.startedAt.getTime()) / 1000
                }).then((response) => {
                    this.isFinished = true;
                });
            },
            answer: function (eventContainer, answer) {
                answer.identifier = this.identifier;
                axios.post(window.location + "api/" + eventContainer.event.id + "/answer", answer);
            }
        },
        computed: {
            futureEvents: function () {
                let events = [];
                const now = new Date();
                const todayDate = now.getFullYear() + "-" + ("0" + (now.getMonth() + 1)).slice(-2) + "-" + ("0" + now.getDate()).slice(-2);
                this.semesters.forEach(s => {
                    events = events.concat(s.events.filter(e => e.date >= todayDate));
                });
                events.reverse();
                return events;
            },
            selectableEvents: function () {
                let events = [];
                this.semesters.forEach(s => {
                    events = events.concat(s.events.filter(e => e.date > this.activeEventContainer.event.date));
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

                    //recover questionnaire state
                    if (eventContainer.event !== null) {
                        //parse the template
                        eventContainer.template = JSON.parse(eventContainer.event.template);

                        //restore any previous answers
                        axios.get(window.location + "api/" + eventContainer.event.id + "/" + this.identifier + "/answers")
                            .then((response) => {
                                eventContainer.answers = response.data;
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