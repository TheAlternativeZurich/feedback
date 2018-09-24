<template>
    <div>
        <span>
            <b>{{questionContainer.question.title}}</b>
        </span>
        <ChoiceQuestionEntry v-for="choiceContainer in choiceContainers"
                             :key="choiceContainer.key"
                             :choice-container="choiceContainer"
                             @selected="$emit('select-participants', choiceContainer.participants)"/>
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
                choiceContainers: []
            }
        },
        methods: {
            selected: function (choiceContainer) {
                this.$emit('select-participants', choiceContainer.participants);
            },
            refreshParticipants: function () {
                this.choiceContainers.forEach(c => {
                    c.participants = this.questionContainer.participants.filter(p => p.answers.filter(a => a.questionIndex == this.questionContainer.questionIndex && a.value == c.eventId).length > 0)
                })
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
                        participants: []
                    });
                });

                this.choiceContainers = choiceContainers;
                this.refreshParticipants();
            }
        },
        watch: {
            questionContainer: {
                handler: function() {
                    this.refreshParticipants();
                },
                deep: true
            },
            events() {
                this.refreshChoiceContainers()
            }
        },
        mounted() {
            this.refreshChoiceContainers();
        }
    }
</script>