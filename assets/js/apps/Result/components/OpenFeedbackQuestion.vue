<template>
    <div>
        <label :for="questionContainer.key"><b>{{questionContainer.question.title}}</b></label>
        <p v-for="textContainer in textContainers"><i @click="$emit('select-participants', [textContainer.participant])">{{textContainer.text}}</i></p>
    </div>
</template>

<script>

    export default {
        props: {
            questionContainer: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                textContainers: []
            };
        },
        methods: {
            refreshParticipants: function () {
                this.textContainers = this.questionContainer.participants.reduce((acc, current) => acc.concat(current.answers.filter(a => a.questionIndex == this.questionContainer.questionIndex).map(a => {
                    return {
                        text: a.value,
                        participant: current
                    }
                })), []);
            }
        },
        watch: {
            questionContainer: {
                handler: function () {
                    this.refreshParticipants();
                },
                deep: true
            }
        },
        mounted() {
            this.refreshParticipants();
        }
    }
</script>