<template>
    <div>
        <EventResultFilter
                :event-container="eventContainer"
                :selected-participants="selectedParticipants"
                @select-participants="changeParticipants(arguments[0])"/>
        <EventResultSummary
                :event-container="eventContainer"
                :selected-participants="selectedParticipants"/>
        <EventResultPage
                v-for="pageContainer in pageContainers"
                :key="pageContainer.key"
                :pageContainer="pageContainer"
                :future-events="futureEvents"
                @select-participants="changeParticipants(arguments[0])"
        />
    </div>
</template>

<script>
    import EventResultPage from './EventResultPage'
    import EventResultSummary from './EventResultSummary'
    import EventResultFilter from "./EventResultFilter";

    export default {
        props: {
            eventContainer: {
                type: Object,
                required: true
            },
            futureEvents: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                pageContainers: [],
                selectedParticipants: []
            }
        },
        components: {
            EventResultFilter,
            EventResultPage,
            EventResultSummary
        },
        methods: {
            changeParticipants: function (participants) {
                this.selectedParticipants = participants;
                this.refreshQuestionContainers(participants);
            },
            refreshQuestionContainers: function (participants) {
                //refresh at all questions
                this.pageContainers.forEach(p => {
                    p.questionContainers.forEach(q => {
                        q.participants = participants
                    })
                });
            }
        },
        mounted() {
            //create page & question containers
            let pageContainers = {};
            const whiteList = this.eventContainer.event.categoryWhitelist;
            let questionIndex = 0;
            let pageIndex = 0;
            this.eventContainer.template.questions.forEach(q => {
                if (whiteList.indexOf(q.category) > -1 && (!('requires_category' in q) || whiteList.indexOf(q.requires_category) > -1)) {
                    //add page container if not yet
                    if (!(q.category in pageContainers)) {
                        pageContainers[q.category] = {
                            key: pageIndex,
                            title: q.category,
                            questionContainers: []
                        };
                        pageIndex++;
                    }

                    //add question to page
                    let questionContainer = {
                        key: questionIndex,
                        question: q,
                        questionIndex: questionIndex,
                        participants: []
                    };
                    pageContainers[q.category].questionContainers.push(questionContainer);
                }
                questionIndex++;
            });
            this.pageContainers = Object.keys(pageContainers).map(e => pageContainers[e]);
            this.changeParticipants(this.eventContainer.participants);
        }
    }
</script>