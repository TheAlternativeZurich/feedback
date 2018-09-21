<template>
    <div class="card">
        <div class="card-header">
            {{$t("about_the")}} {{pageContainer.title}}
        </div>
        <div class="card-body">
            <div class="row">
                <Question class="mb-4 col-md-6"
                          v-for="questionContainer in pageContainer.questionContainers"
                          :key="questionContainer.key"
                          :question-container="questionContainer"
                          :future-events="futureEvents"
                          @select-participants="$emit('select-participants', arguments[0])"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import Question from "./Question";

    export default {
        props: {
            pageContainer: {
                type: Object,
                required: true
            },
            futureEvents: {
                type: Array,
                required: true
            }
        },
        components: {
            Question
        }
    }
</script>