<template>
    <div>
        <p class="lead">{{pageContainer.title}}</p>
        <EventFeedbackQuestion v-for="questionContainer in pageContainer.questionContainers"
                               :question-container="questionContainer" :key="questionContainer.key"/>
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