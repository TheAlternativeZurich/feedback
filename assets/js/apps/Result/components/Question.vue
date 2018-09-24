<template>
    <div>
        <div class="form-group">
            <ChoiceQuestion
                    v-if="questionContainer.question.type === 'choice'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @select-participants="$emit('select-participants', arguments[0])"
            />
            <SliderQuestion
                    v-else-if="questionContainer.question.type === 'slider'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @select-participants="$emit('select-participants', arguments[0])"
            />
            <OpenFeedbackQuestion
                    v-else-if="questionContainer.question.type === 'open_feedback'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @select-participants="$emit('select-participants', arguments[0])"
            />
            <EventListQuestion
                    v-else-if="questionContainer.question.type === 'event_list'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    :events="futureEvents"
                    @select-participants="$emit('select-participants', arguments[0])"
            />
            <AcademicBackgroundQuestion
                    v-else-if="questionContainer.question.type === 'academic_background'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @select-participants="$emit('select-participants', arguments[0])"
            />
            <EmailQuestion
                    v-else-if="questionContainer.question.type === 'email'"
                    :key="questionContainer.key"
                    :question-container="questionContainer"
                    @select-participants="$emit('select-participants', arguments[0])"
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
            }
        }
    }
</script>