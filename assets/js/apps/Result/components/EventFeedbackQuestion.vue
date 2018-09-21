<template>
    <div>
        <div class="form-group">
            <ChoiceQuestion
                    v-if="questionContainer.question.type === 'choice'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @answer="answer(questionContainer, arguments[0])"
                    @add-feedback-inspiration="$emit('add-feedback-inspiration', arguments[0])"
                    @remove-feedback-inspiration="$emit('remove-feedback-inspiration', arguments[0])"
            />
            <SliderQuestion
                    v-else-if="questionContainer.question.type === 'slider'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @answer="answer(questionContainer, arguments[0])"
            />
            <OpenFeedbackQuestion
                    v-else-if="questionContainer.question.type === 'open_feedback'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    :feedback-inspiration="openFeedbackInspiration"
                    @answer="answer(questionContainer, arguments[0])"
            />
            <EventListQuestion
                    v-else-if="questionContainer.question.type === 'event_list'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    :events="futureEvents"
                    @answer="answer(questionContainer, arguments[0])"
            />
            <AcademicBackgroundQuestion
                    v-else-if="questionContainer.question.type === 'academic_background'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @answer="answer(questionContainer, arguments[0])"
            />
            <EmailQuestion
                    v-else-if="questionContainer.question.type === 'email'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @answer="answer(questionContainer, arguments[0])"
            />
        </div>
    </div>
</template>

<script>
    import ChoiceQuestion from "./ChoiceQuestion";
    import SliderQuestion from "./SliderQuestion";
    import OpenFeedbackQuestion from "./OpenFeedbackQuestion";
    import EventListQuestion from "./EventListQuestion";
    import AcademicBackgroundQuestion from "./AcademicBackgroundQuestion";
    import EmailQuestion from "./EmailQuestion";

    export default {
        components: {
            EmailQuestion,
            AcademicBackgroundQuestion,
            EventListQuestion,
            OpenFeedbackQuestion,
            SliderQuestion,
            ChoiceQuestion
        },
        props: {
            questionContainer: {
                type: Object,
                required: true
            },
            futureEvents: {
                type: Array,
                required: true
            },
            openFeedbackInspiration: {
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