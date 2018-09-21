<template>
    <div>
        <label :for="questionContainer.key"><b>{{questionContainer.question.title}}</b></label>
        <input type="range" disabled="disabled" class="form-control-range" min="0" max="100"
               :id="questionContainer.key"
               :value="average">
        <div class="row">
            <div class="col text-left">
                {{questionContainer.question.min}}
            </div>
            <div class="col text-center">
                {{questionContainer.question.center}}
            </div>
            <div class="col text-right">
                {{questionContainer.question.max}}
            </div>
        </div>
        <p class="small">{{$t('slider.average', {response_count: responseCount})}}</p>
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
                average: null,
                responseCount: 0
            }
        },
        methods: {
            refreshParticipants: function () {
                const values = this.questionContainer.participants.reduce((acc, current) => acc.concat(current.answers.filter(a => a.questionIndex == this.questionContainer.questionIndex).map(a => parseInt(a.value))), []);
                this.responseCount = values.length;
                this.average = values.reduce((acc, curr) => acc + curr) / this.responseCount;
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
            this.refreshParticipants()
        }
    }
</script>