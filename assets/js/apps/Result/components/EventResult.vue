<template>
    <div>
        <div>
            <p class="alert alert-light">
                {{$t('result_for')}}
                <b>{{(new Date(eventContainer.event.date)).toLocaleDateString()}}: {{eventContainer.event.name}}</b>
            </p>
            <EventResultPage
                    v-for="pageContainer in pageContainers"
                    :key="pageContainer.key"
                    :pageContainer="pageContainer"
                    :future-events="futureEvents"
                    @select-participants="changeParticipants(arguments[0])"
            />
        </div>
    </div>
</template>

<script>
    import EventResultPage from './EventResultPage'

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
                pageContainers: []
            }
        },
        components: {
            EventResultPage
        },
        methods: {
            changeParticipants: function (participants) {
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
            this.refreshQuestionContainers(this.eventContainer.participants);
        }
    }
</script>