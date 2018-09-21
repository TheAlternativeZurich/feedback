<template>
    <div>
        <label :for="questionContainer.key"><b>{{questionContainer.question.title}}</b></label>
        <input
                type="email"
                class="form-control"
                :id="questionContainer.key"
                v-model="emailValue"
                placeholder="stallmann@gnu.com"
                @input="valueChanged">
        </input>
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
                emailValue: null
            };
        },
        methods: {
            valueChanged: debounce(function () {
                let answer = {
                    value: this.emailValue,
                    action: "override"
                };

                this.$emit('answer', answer);
            }, 500)
        },
        mounted() {
            if (this.questionContainer.answers.length > 0) {
                this.emailValue = this.questionContainer.answers[0].value;
            }
        }
    }
</script>