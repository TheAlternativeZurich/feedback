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
        components: {
            ChoiceQuestionEntry
        },
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
                this.$emit('select-participants', choiceContainer.participants);
            },
            refreshParticipants: function () {
                this.choiceContainers.forEach(c => {
                    c.participants = this.questionContainer.participants.filter(p => p.answers.filter(a => a.questionIndex == this.questionContainer.questionIndex && a.value == c.answerIndex).length > 0)
                })
            }
        },
        watch: {
            questionContainer: {
                handler: function() {
                    this.refreshParticipants();
                },
                deep: true
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
                    participants: []
                });
                answerIndex++;
            });

            this.choiceContainers = choiceContainers;
            this.refreshParticipants();
        }
    }
</script>