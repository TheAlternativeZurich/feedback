<template>
    <div>
        <label :for="questionContainer.key"><b>{{questionContainer.question.title}}</b></label>
        <textarea
                rows="5"
                class="form-control"
               :id="questionContainer.key"
               v-model="textValue"
               @input="valueChanged">
        </textarea>
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
                textValue: null
            };
        },
        methods: {
            valueChanged: debounce(function () {
                let answer = {
                    value: this.textValue,
                    action: "override"
                };

                this.$emit('answer', answer);
            }, 500)
        },
        mounted() {
            if (this.questionContainer.answers.length > 0) {
                this.textValue = this.questionContainer.answers[0].value;
            }
        }
    }
</script>