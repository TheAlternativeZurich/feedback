<template>
    <div>
        <p>{{eventContainer.template.start_text}}</p>
        <EventFeedbackPage class="mt-5" v-for="pageContainer in pageContainers"
                           :key="pageContainer.key"
                           :pageContainer="pageContainer"
                           :future-events="futureEvents"
                           @answer="$emit('answer', arguments[0])"
        />
    </div>
</template>

<script>
    import EventFeedbackPage from './EventFeedbackPage'

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
            EventFeedbackPage
        },
        methods: {
        },
        mounted() {
            //create page & question containers
            let pageContainers = {};
            const whiteList = this.eventContainer.event.categoryWhitelist;
            let questionIndex = 0;
            let pageIndex = 0;
            this.eventContainer.template.questions.forEach(q => {
                if (whiteList.indexOf(q.category) > -1) {
                    //add page container if not yet
                    if (!(q.category in pageContainers)) {
                        pageContainers[q.category] = {
                            key: pageIndex,
                            title: q.category,
                            questionContainers: [],
                        };
                        pageIndex++;
                    }

                    //add question to page
                    let questionContainer = {
                        key: questionIndex,
                        question: q,
                        questionIndex: questionIndex,
                        answers: this.eventContainer.answers.filter(a => a.questionIndex === questionIndex)
                    };
                    pageContainers[q.category].questionContainers.push(questionContainer);
                }
                questionIndex++;
            });
            this.pageContainers = pageContainers;
        }
    }
</script>