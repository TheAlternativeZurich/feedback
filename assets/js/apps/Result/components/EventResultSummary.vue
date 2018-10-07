<template>
    <div class="card">
        <div class="card-header">
            {{ $t('summary.title') }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <p>
                        <b>{{$t('summary.event')}}</b>: {{eventContainer.event.name}} <br/>
                        <b>{{$t('summary.questionnaire_open')}}</b>:
                        {{(new Date(eventContainer.event.date)).toLocaleDateString()}}
                        {{eventContainer.event.feedbackStartTime.substr(0, 5)}} -
                        {{eventContainer.event.feedbackEndTime.substr(0, 5)}}<br/>
                        <b>{{$t('summary.questions_asked')}}</b>: {{eventContainer.template.questions.length}}
                    </p>
                </div>
                <div class="col">
                    <b>{{$t('summary.participants')}}</b>: {{allParticipants.length}}<br/>
                    <b>{{$t('summary.completion_rate')}}</b>:
                    {{completingParticipants.length === 0 ? 0 : Math.round(completingParticipants.length /
                    allParticipants.length * 100, 2)}}%<br/>
                    <span v-if="completingParticipants.length > 0">
                        <b>{{$t('summary.average_completion_time')}}</b>:
                        {{completingParticipants.reduce((prev, current) => prev + current.timeNeededInSeconds, 0) / completingParticipants.length}}
                        {{$t('seconds')}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            eventContainer: {
                type: Object,
                required: true
            },
            selectedParticipants: {
                type: Array,
                required: true
            }
        },
        computed: {
            completingParticipants: function () {
                return this.allParticipants.filter(p => p.timeNeededInSeconds > 0);
            },
            allParticipants: function () {
                return this.selectedParticipants;
            }
        }
    }
</script>