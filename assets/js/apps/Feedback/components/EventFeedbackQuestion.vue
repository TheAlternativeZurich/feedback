<template>
    <div>
        <div v-if="questionContainer.question.type === 'choice'">

            <div v-for="choiceContainer in choiceContainers"
                 :key="choiceContainer.key"
                 class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                       :id="questionContainer.key + '_' + choiceContainer.key">
                <label class="custom-control-label"
                       :for="questionContainer.key + '_' + choiceContainer.key">
                    {{choiceContainer.choice.title}}
                </label>
            </div>
        </div>
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
        methods: {},
        computed: {
            choiceContainers: function () {
                let choiceContainers = [];
                let answerIndex = 0;
                this.questionContainer.question.choices.forEach(c => {
                    choiceContainers.push({
                        key: answerIndex,
                        choice: c
                    });
                    answerIndex++;
                });

                return choiceContainers;
            }
        }
    }
</script>