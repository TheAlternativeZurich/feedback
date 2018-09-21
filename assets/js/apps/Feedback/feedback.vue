<template>
    <div id="assign-app">
        <div v-if="isLoading">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row justify-content-center">
                            <div class="col-1">
                                <AtomSpinner
                                        :animation-duration="1000"
                                        :size="60"
                                        :color="'#007bff'"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else-if="activeEventContainer !== null" class="container">
            <EventFeedback :eventContainer="activeEventContainer"
                           :future-events="futureEvents"
                           :is-finished="isFinished"
                           @answer="answer(activeEventContainer, arguments[0])"
                           @finish="finish"
            />
        </div>
        <div v-else class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="alert alert-light">
                        {{$t('messages.no_active_questionnaire')}}
                    </p>
                    <div v-if="futureEvents.length > 0" class="card">
                        <div class="card-header">
                            {{$t('messages.join_us_at_future_courses')}}
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" v-for="event in futureEvents" :key="event.id">
                                {{(new Date(event.date)).toLocaleDateString() + ": " + event.name}}
                            </li>
                        </ul>
                        <div class="card-footer">
                            <a href="https://thealternative.ch" target="_blank">{{$t('messages.visit_us')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {AtomSpinner} from 'epic-spinners'
    import axios from "axios"
    import EventFeedback from './components/EventFeedback'

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
            AtomSpinner,
            EventFeedback
        },
        methods: {
            finish: function () {
                axios.post("/api/" + this.activeEventContainer.event.id + "/finish", {
                    identifier: this.identifier,
                    timeNeededInSeconds: ((new Date()).getTime() - this.startedAt.getTime()) / 1000
                }).then((response) => {
                    this.isFinished = true;
                });
            },
            answer: function (eventContainer, answer) {
                answer.identifier = this.identifier;
                axios.post("/api/" + eventContainer.event.id + "/answer", answer);
            }
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