<template>
    <div>
        <p class="alert alert-light">
            {{$t('messages.no_active_questionnaire')}}
        </p>
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
        }
    }
</script>