<template>
    <div @click="$emit('selected')">
        <b>{{choiceContainer.participants.length}}</b> {{choiceContainer.choice.title}}
    </div>
</template>

<script>
    export default {
        props: {
            choiceContainer: {
                type: Object,
                required: true
            }
        }
    }
</script>