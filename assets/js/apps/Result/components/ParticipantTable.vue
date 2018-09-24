<template>
    <table class="table table-hover table-sm table-borderless">
        <thead>
        <tr>
            <th></th>
            <th>{{$t('participant')}}</th>
            <th>{{$t('completion_time')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="participantContainer in participantContainers" @click="$emit('participant-selected', participantContainer)">
            <td>
                <input :title="participantContainer.identifier" @input="$emit('participant-selected', participantContainer)"
                       :checked="participantContainer.selected" type="checkbox">
            </td>
            <td>{{participantContainer.identifier}}</td>
            <td>
                <span v-if="participantContainer.participant.timeNeededInSeconds > 0">{{participantContainer.participant.timeNeededInSeconds}} {{$t('seconds')}}</span>
                <span v-else>-</span>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>

    export default {
        props: {
            participantContainers: {
                type: Array,
                required: true
            }
        }
    }
</script>