<template>
    <div>
        <p>{{eventContainer.template.start_text}}</p>

        <EventFeedbackPage v-for="pageContainer in pageContainers"
                           :key="pageContainer.key"
                           :pageContainer="pageContainer"
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
        methods: {},
        mounted() {
            //create page containers
            let pageContainers = {};
            const whiteList = this.eventContainer.event.categoryWhitelist;
            let pageIndex = 0;
            whiteList.forEach(p => {
                pageContainers[p] = {
                    key: pageIndex,
                    title: p,
                    questionContainers: [],
                };
                pageIndex++;
            });

            //fill containers
            let questionIndex = 0;
            this.eventContainer.template.questions.forEach(q => {
                if (whiteList.indexOf(q.category) > -1) {
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
            console.log(pageContainers);
            this.pageContainers = pageContainers;
        }
    }
</script>