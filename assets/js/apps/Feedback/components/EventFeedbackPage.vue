<template>
    <div>
        <h3>{{$t("about_the")}} {{pageContainer.title}}</h3>
        <EventFeedbackQuestion v-for="questionContainer in pageContainer.questionContainers"
                               :key="questionContainer.key"
                               :question-container="questionContainer"
                               @answer="$emit('answer', arguments[0])"/>
        <hr/>
    </div>
</template>

<script>
    import EventFeedbackQuestion from "./EventFeedbackQuestion";

    export default {
        props: {
            pageContainer: {
                type: Object,
                required: true
            }
        },
        components: {
            EventFeedbackQuestion

        },
        methods: {},
        computed: {}
    }
</script>