<template>
    <div>
        <label :for="questionContainer.key"><b>{{questionContainer.question.title}}</b></label>
        <textarea
                :title="questionContainer.question.title"
                rows="5"
                class="form-control"
                :id="questionContainer.key"
                :placeholder="placeholder"
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
            },
            feedbackInspiration: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                textValue: null,
                placeholder: ""
            };
        },
        watch: {
            feedbackInspiration() {
                let currentFeedback = "";
                let max = 3;
                this.feedbackInspiration.forEach(fi => {
                    if (max-- > 0) {
                        currentFeedback += fi + "\n";
                    }
                });
                if (currentFeedback === "") {
                    currentFeedback = this.$t('open_feedback.default_placeholder');
                }
                this.placeholder = currentFeedback;
            }
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