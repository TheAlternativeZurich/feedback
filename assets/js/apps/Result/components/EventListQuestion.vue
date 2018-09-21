<template>
    <div>
        <span>
            <b>{{questionContainer.question.title}}</b>
        </span>
        <ChoiceQuestionEntry v-for="choiceContainer in choiceContainers"
                             :key="choiceContainer.key"
                             :choice-container="choiceContainer"
                             @value-changed="valueChanged(choiceContainer)"/>
        <p v-if="showLotSelectedText" class="alert alert-success mt-2">
            {{questionContainer.question.lot_selected_text}}
        </p>
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
        data() {
            return {
                choiceContainers: [],
                showLotSelectedText: false
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
                this.refreshShowLotSelectedText();

                this.$emit('answer', answer);
            },
            refreshShowLotSelectedText: function () {
                const activeChoices = this.choiceContainers.filter(c => c.selected).length;
                this.showLotSelectedText = 'lot_selected_text' in this.questionContainer.question && ((activeChoices >= this.choiceContainers.length * 0.7 && activeChoices >= 2) || activeChoices > 4);
            },
            refreshChoiceContainers: function () {
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

                this.choiceContainers = choiceContainers;
                this.refreshShowLotSelectedText();
            }
        },
        watch: {
            events() {
                this.refreshChoiceContainers()
            }
        },
        mounted() {
            this.refreshChoiceContainers();
        }
    }
</script>