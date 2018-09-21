<template>
    <div>
        <label :for="questionContainer.key"><b>{{questionContainer.question.title}}</b></label>
        <input type="range" class="form-control-range" min="0" max="100"
               :id="questionContainer.key"
               v-model="sliderValue"
               @input="valueChanged">
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
        <p v-if="showValueHighText" class="alert mt-2 alert-success">
            {{questionContainer.question.value_high_text}}
        </p>
    </div>
</template>

<script>
    import debounce from 'debounce'

    export default {
        props: {
            questionContainer: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                sliderValue: null
            };
        },
        methods: {
            valueChanged: debounce(function () {
                this.sendAnswer();
            }, 500),
            sendAnswer: function () {
                let answer = {
                    value: this.sliderValue,
                    action: "override"
                };

                this.$emit('answer', answer);
            }
        },
        computed: {
            showValueHighText: function () {
                return 'value_high_text' in this.questionContainer.question && this.sliderValue > 80
            }
        },
        mounted() {
            if (this.questionContainer.answers.length > 0) {
                this.sliderValue = this.questionContainer.answers[0].value;
            } else {
                this.sliderValue = this.questionContainer.question.start_value;
                this.sendAnswer();
            }
        }
    }
</script>