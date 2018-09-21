<template>
    <div class="card">
        <div class="card-header">
            {{$t("about_the")}} {{pageContainer.title}}
        </div>
        <div class="card-body">
            <div class="row">
                <EventFeedbackQuestion class="mb-4 col-md-6" v-for="questionContainer in pageContainer.questionContainers"
                                       :key="questionContainer.key"
                                       :question-container="questionContainer"
                                       :future-events="futureEvents"
                                       :open-feedback-inspiration="openFeedbackInspiration"
                                       @add-feedback-inspiration="addFeedbackInspiration(arguments[0])"
                                       @remove-feedback-inspiration="removeFeedbackInspiration(arguments[0])"
                                       @answer="$emit('answer', arguments[0])"/>
            </div>
            <slot>

            </slot>
        </div>
    </div>
</template>

<script>
    import EventFeedbackQuestion from "./EventFeedbackQuestion";

    export default {
        props: {
            pageContainer: {
                type: Object,
                required: true
            },
            futureEvents: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                openFeedbackInspiration: []
            }
        },
        components: {
            EventFeedbackQuestion
        },
        methods: {
            addFeedbackInspiration: function (inspiration) {
                if (this.openFeedbackInspiration.indexOf(inspiration) === -1) {
                    this.openFeedbackInspiration.push(inspiration);
                }
            },
            removeFeedbackInspiration: function (inspiration) {
                const oldIndex = this.openFeedbackInspiration.indexOf(inspiration);
                if (oldIndex !== -1) {
                    this.openFeedbackInspiration.splice(oldIndex, 1);
                }
            }
        }
    }
</script>