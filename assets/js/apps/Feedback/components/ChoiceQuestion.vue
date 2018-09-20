<template>
    <div>
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
        methods: {
            valueChanged: function (choiceContainer) {
                let answer = {
                    value: choiceContainer.answerIndex,
                };

                if (choiceContainer.value) {
                    answer.action = "remove_value";
                    choiceContainer.selected = false;
                } else {
                    answer.action = "ensure_value_exists";
                    choiceContainer.selected = true;
                }

                this.$emit('answer', answer);
            }
        },
        computed: {
            choiceContainers: function () {
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

                return choiceContainers;
            }
        }
    }
</script>