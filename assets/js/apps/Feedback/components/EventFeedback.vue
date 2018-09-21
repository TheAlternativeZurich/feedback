<template>
    <div>
        <p class="alert alert-light">
            {{eventContainer.template.start_text}}
            <br/> <br/>
            {{$t('feedback_for')}}
            <b>{{(new Date(eventContainer.event.date)).toLocaleDateString()}}: {{eventContainer.event.name}}</b>
        </p>
        <div>
            <progress class="mb-1 w-100" :max="pageCount" :value="currentPage + 1">
            </progress>
        </div>
        <EventFeedbackPage v-for="pageContainer in pageContainers"
                           :key="pageContainer.key"
                           v-if="currentPage === pageContainer.key"
                           :pageContainer="pageContainer"
                           :future-events="futureEvents"
                           @answer="$emit('answer', arguments[0])"
        >
            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-secondary" v-if="currentPage > 0" @click="currentPage--">
                        {{$t('actions.backward')}}
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-secondary float-right" @click="currentPage++"
                            v-if="currentPage < pageCount -1">
                        {{$t('actions.forward')}}
                    </button>

                    <button class="btn btn-primary float-right" @click="$emit('finish')"
                            v-if="currentPage === pageCount - 1">
                        {{$t('actions.submit')}}
                    </button>
                </div>
            </div>
        </EventFeedbackPage>
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
                pageContainers: [],

                currentPage: 0,
                pageCount: 0
            }
        },
        components: {
            EventFeedbackPage
        },
        mounted() {
            //create page & question containers
            let pageContainers = {};
            const whiteList = this.eventContainer.event.categoryWhitelist;
            let questionIndex = 0;
            let pageIndex = 0;
            this.eventContainer.template.questions.forEach(q => {
                if (whiteList.indexOf(q.category) > -1 && (!('needs_category' in q) || whiteList.indexOf(q.needs_category) > -1)) {
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
            this.pageCount = pageIndex;
        }
    }
</script>