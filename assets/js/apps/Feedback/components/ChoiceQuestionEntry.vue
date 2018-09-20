<template>
    <div class="custom-control custom-checkbox">
        <input @input="$emit('value-changed')" :checked="choiceContainer.selected" type="checkbox" class="custom-control-input" :id="choiceContainer.key">
        <label class="custom-control-label" :for="choiceContainer.key">
            {{choiceContainer.choice.title}}
        </label>
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