<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-1">
                <AtomSpinner
                        :animation-duration="1000"
                        :size="60"
                        :color="'#007bff'"
                />
            </div>
        </div>
    </div>
</template>
<script>

    import {AtomSpinner} from 'epic-spinners'

    export default {
        components: {
            AtomSpinner
        }
    }
</script>