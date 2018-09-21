<template>
    <div>
        <span>
            <b>{{questionContainer.question.title}}</b>
        </span>
        <ChoiceQuestionEntry v-for="choiceContainer in choiceContainers"
                             :key="choiceContainer.key"
                             :choice-container="choiceContainer"
                             @value-changed="valueChanged(choiceContainer)"/>
    </div>
</template>

<script>
    import ChoiceQuestionEntry from "./ChoiceQuestionEntry";

    export default {
        components: {ChoiceQuestionEntry},
        props: {
            questionContainer: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                choiceContainers: []
            }
        },
        methods: {
            valueChanged: function (choiceContainer) {
                let answer = {
                    value: choiceContainer.answerIndex,
                };

                if (choiceContainer.selected) {
                    answer.action = "remove_value";
                } else {
                    answer.action = "ensure_value_exists";
                }
                choiceContainer.selected = !choiceContainer.selected;

                this.$emit('answer', answer);
                this.raiseFeedbackInspirationEvents(choiceContainer);
            },
            raiseFeedbackInspirationEvents: function (choiceContainer) {
                if (choiceContainer.selected) {
                    if ("on_feedback_inspiration" in choiceContainer.choice) {
                        this.$emit('add-feedback-inspiration', choiceContainer.choice.on_feedback_inspiration);
                    }
                    if ("off_feedback_inspiration" in choiceContainer.choice) {
                        this.$emit('remove-feedback-inspiration', choiceContainer.choice.off_feedback_inspiration);
                    }
                } else {
                    if ("off_feedback_inspiration" in choiceContainer.choice) {
                        this.$emit('add-feedback-inspiration', choiceContainer.choice.off_feedback_inspiration);
                    }
                    if ("on_feedback_inspiration" in choiceContainer.choice) {
                        this.$emit('remove-feedback-inspiration', choiceContainer.choice.on_feedback_inspiration);
                    }
                }
            }
        },
        mounted() {
            let choiceContainers = [];
            let answerIndex = 0;
            this.questionContainer.question.choices.forEach(c => {
                choiceContainers.push({
                    key: this.questionContainer.key + "_" + answerIndex,
                    answerIndex: answerIndex,
                    choice: c,
                    selected: this.questionContainer.answers.filter(a => a.value == answerIndex).length > 0
                });
                answerIndex++;
            });

            this.choiceContainers = choiceContainers;

            this.choiceContainers.forEach(c => {
                this.raiseFeedbackInspirationEvents(c);
            })
        }
    }
</script>