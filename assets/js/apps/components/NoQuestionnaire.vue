<template>
    <div>
        <div>
            <p v-if="nextEvent !== null" class="alert alert-light">
                {{$t('messages.next_active_questionnaire', {name: nextEvent.name, time: nextEvent.feedbackStartTime.substring(0, 5)})}}
            </p>
            <p v-else class="alert alert-light">
                {{$t('messages.no_active_questionnaire')}}
            </p>
        </div>
        <div v-if="events.length > 0" class="card">
            <div class="card-header">
                {{$t('messages.join_us_at_future_courses')}}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" v-for="event in events" :key="event.id">
                    {{(new Date(event.date)).toLocaleDateString() + ": " + event.name}}
                </li>
            </ul>
            <div class="card-footer">
                <a href="https://thealternative.ch" target="_blank">{{$t('messages.visit_us')}}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            events: {
                type: Array,
                required: true
            }
        },
        computed: {
            nextEvent: function () {
                //format date
                const now = new Date();
                const todayDate = now.getFullYear() + "-" + ("0" + (now.getMonth() + 1)).slice(-2) + "-" + ("0" + now.getDay()).slice(-2);
                const nowTime = ("0" + (now.getHours())).slice(-2) + ":" + ("0" + (now.getMinutes())).slice(-2);

                const todayEvents = this.events.filter(e => e.date === todayDate && e.feedbackStartTime > nowTime).sort(e => e.feedbackStartTime);
                if (todayEvents.length > 0) {
                    return todayEvents[0];
                }
                return null;
            }
        }
    }
</script>