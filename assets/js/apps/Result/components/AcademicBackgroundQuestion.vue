<template>
    <div>
        <span><b>{{questionContainer.question.title}}</b></span>
        <p>
            <span v-for="textContainer in textContainers" @click="$emit('select-participants', textContainer.participants)">
                <b>{{textContainer.participants.length}}</b> {{textContainer.text}}<br/>
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
                values: [],
                textContainers: []
            };
        },
        methods: {
            refreshParticipants: function () {
                const allValues = this.questionContainer.participants.reduce((pre, current) => pre.concat(current.answers.filter(a => a.questionIndex == this.questionContainer.questionIndex).map(a => a.value)), []);
                const values = [...new Set(allValues)];
                this.textContainers = values.map(v => {
                    return {
                        text: v,
                        participants: this.questionContainer.participants.filter(p => p.answers.filter(a => a.questionIndex == this.questionContainer.questionIndex && a.value === v).length > 0)
                    };
                })
            },
            selected: function (participant) {
                this.$emit('select-participants', [participant]);
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