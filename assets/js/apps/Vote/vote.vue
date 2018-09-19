<template>
    <div id="assign-app">
        <div class="row">
            <div class="col-md-4">
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
    import axios from "axios"

    export default {
        data() {
            return {
                data: null
            }
        },
        components: {
            AtomSpinner
        },
        methods: {},
        computed: {},
        mounted() {
            axios.get("/api/vote/frontend_users")
                .then((response) => {
                    this.data = response.data;
                });
        },
    }

</script>