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
            },
            events: {
                type: Array,
                required: true
            }
        },
        methods: {
            valueChanged: function (choiceContainer) {
                let answer = {
                    value: choiceContainer.eventId
                };

                if (choiceContainer.selected) {
                    answer.action = "remove_value";
                } else {
                    answer.action = "ensure_value_exists";
                }
                choiceContainer.selected = !choiceContainer.selected;

                this.$emit('answer', answer);
            }
        },
        computed: {
            choiceContainers: function () {
                let choiceContainers = [];
                this.events.forEach(e => {
                    choiceContainers.push({
                        key: this.questionContainer.key + "_" + e.id,
                        eventId: e.id,
                        choice: {
                            title: (new Date(e.date)).toLocaleDateString() + ": " + e.name
                        },
                        selected: this.questionContainer.answers.filter(a => a.value == e.id).length > 0
                    });
                });

                return choiceContainers;
            }
        }
    }
</script>