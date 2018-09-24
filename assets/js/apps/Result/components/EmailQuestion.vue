<template>
    <div>
        <label :for="questionContainer.key"><b>{{questionContainer.question.title}}</b></label>
        <p>
            <span v-for="textContainer in textContainers" @click="$emit('select-participants', [textContainer.participant])">
                <a :href="'mailto:' + textContainer.text" >
                    <i class="fal fa-envelope"></i>
                </a>
                {{textContainer.text}}
                <br/>
            </span>
        </p>
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