<template>
    <div>
        <div class="form-group">
            <ChoiceQuestion v-if="questionContainer.question.type === 'choice'"
                            :key="questionContainer.key"
                            :question-container="questionContainer"
                            @answer="answer(questionContainer, arguments[0])"/>
            <SliderQuestion v-else-if="questionContainer.question.type === 'slider'"
                            :key="questionContainer.key"
                            :question-container="questionContainer"
                            @answer="answer(questionContainer, arguments[0])"/>
            <OpenFeedbackQuestion v-else-if="questionContainer.question.type === 'open_feedback'"
                                  :key="questionContainer.key"
                                  :question-container="questionContainer"
                                  @answer="answer(questionContainer, arguments[0])"/>
            <EventListQuestion v-else-if="questionContainer.question.type === 'event_list'"
                                  :key="questionContainer.key"
                                  :question-container="questionContainer"
                                  :events="futureEvents"
                                  @answer="answer(questionContainer, arguments[0])"/>
        </div>
    </div>
</template>

<script>
    import ChoiceQuestion from "./ChoiceQuestion";
    import SliderQuestion from "./SliderQuestion";
    import OpenFeedbackQuestion from "./OpenFeedbackQuestion";
    import EventListQuestion from "./EventListQuestion";

    export default {
        components: {EventListQuestion, OpenFeedbackQuestion, SliderQuestion, ChoiceQuestion},
        props: {
            questionContainer: {
                type: Object,
                required: true
            },
            futureEvents: {
                type: Array,
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