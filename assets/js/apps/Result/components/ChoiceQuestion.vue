<template>
    <div>
        <span>
            <b>{{questionContainer.question.title}}</b>
        </span>
        <ChoiceQuestionEntry v-for="choiceContainer in choiceContainers"
                             :key="choiceContainer.key"
                             :choice-container="choiceContainer"
                             @selected="selected(choiceContainer)"/>
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
            selected: function (choiceContainer) {
                this.$emit('participants-selected', choiceContainer.participants);
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
                    participants: this.questionContainer.participants.filter(p => p.answers.filter(a => a.value = answerIndex).length > 0)
                });
                answerIndex++;
            });

            this.choiceContainers = choiceContainers;
        }
    }
</script>