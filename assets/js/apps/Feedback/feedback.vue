<template>
    <div id="assign-app">
        <div v-if="isLoading">
            <AtomSpinner
                    :animation-duration="1000"
                    :size="60"
                    :color="'#007bff'"
            />
        </div>
        <div v-else-if="activeEventContainer !== null" class="row">
            <div class="col">
                <EventFeedback class="feedback-content" :eventContainer="activeEventContainer"/>
            </div>
            <div class="col-md-auto text-right">
                <h3>{{activeEventContainer.event.name}}</h3>
                <p>{{formattedEventDate}}</p>
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
                semesters: []
            }
        },
        components: {
            AtomSpinner,
            EventFeedback
        },
        methods: {
            finish: function () {
            }
        },
        computed: {
            formattedEventDate: function () {
                let date = new Date(this.activeEventContainer.event.date);
                return date.toLocaleDateString();
            }
        },
        mounted() {
            //set identifier
            if (!localStorage.identifier) {
                localStorage.identifier = Math.random().toString(36).substr(2, 20);
            }

            this.identifier = localStorage.identifier;

            axios.get("/api/active")
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
                        axios.get("/api/" + eventContainer.event.id + "/" + this.identifier + "/answers")
                            .then((response) => {
                                eventContainer.answers = response.data;
                                this.activeEventContainer = eventContainer;
                                this.isLoading = false;
                            });
                    } else {
                        this.isLoading = false;
                    }

                    //get semesters with their events
                    axios.get("/api/semesters")
                        .then((response) => {
                            this.semesters = response.data;
                        });
                });
        },
    }

</script>

<style>
    .feedback-content {
        max-width: 600px;
    }
</style>