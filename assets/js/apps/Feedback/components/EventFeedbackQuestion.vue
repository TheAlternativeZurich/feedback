<template>
    <div>
        <span><b>{{questionContainer.question.title}}</b></span>
        <div class="form-group">
            <ChoiceQuestion v-if="questionContainer.question.type === 'choice'"
                            :key="questionContainer.key"
                            :question-container="questionContainer"
                            @answer="answer(questionContainer, arguments[0])"/>
        </div>
    </div>
</template>

<script>
    import ChoiceQuestion from "./ChoiceQuestion";

    export default {
        components: {ChoiceQuestion},
        props: {
            questionContainer: {
                type: Object,
                required: true
            }
        },
        methods: {
            answer: function (questionContainer, answer) {
                answer.questionIndex = questionContainer.questionIndex;
                answer.private = "private" in questionContainer.question && questionContainer.question.private;
                this.$emit('answer', answer);
            }
        }
    }
</script>