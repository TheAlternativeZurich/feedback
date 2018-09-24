<template>
    <div class="card">
        <div class="card-header">
            {{ $t('filter.title') }}
            <div class="ml-2 btn-group btn-group-sm">
                <button class="btn btn-outline-secondary"
                        :disabled="participantContainers.filter(pc => pc.selected).length === this.eventContainer.participants.length"
                        @click="selectAll">
                    {{$t('filter.actions.select_all')}}
                </button>
                <button class="btn btn-outline-secondary"
                        @click="invertFilter">
                    {{$t('filter.actions.invert_filter')}}
                </button>
            </div>
        </div>
        <div class="card-body">
            <p class="text-secondary">{{$t('filter.help')}}<br/>
            {{$t('filter.hint_click_answers')}}</p>
            <hr/>
            <div class="row">
                <div class="col">
                    <ParticipantTable
                            :participant-containers="participantContainers1"
                            @participant-selected="participantSelected(arguments[0])"/>
                </div>
                <div class="col">
                    <ParticipantTable
                            :participant-containers="participantContainers2"
                            @participant-selected="participantSelected(arguments[0])"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import ParticipantTable from "./ParticipantTable";

    export default {
        components: {ParticipantTable},
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
        data() {
            return {
                participantContainers1: [],
                participantContainers2: [],
                participantContainers: [],
            }
        },
        methods: {
            participantSelected: function (participantContainer) {
                participantContainer.selected = !participantContainer.selected;
                this.raiseSelectParticipantsEvent();
            },
            selectAll: function () {
                this.participantContainers.forEach(pc => pc.selected = true);
                this.raiseSelectParticipantsEvent();
            },
            invertFilter: function () {
                this.participantContainers.forEach(pc => pc.selected = !pc.selected);
                this.raiseSelectParticipantsEvent();
            },
            raiseSelectParticipantsEvent: function () {
                this.$emit('select-participants', this.participantContainers.filter(pc => pc.selected).map(pc => pc.participant));
            },
        },
        computed: {
            completingParticipants: function () {
                return this.allParticipants.filter(p => p.timeNeededInSeconds > 0);
            },
            allParticipants: function () {
                return this.eventContainer.participants;
            }
        },
        watch: {
            selectedParticipants: function () {
                this.participantContainers.forEach(pc => {
                    pc.selected = this.selectedParticipants.indexOf(pc.participant) >= 0;
                });
            }
        },
        mounted() {
            //create containers
            let participantContainers = [];
            const participantTrans = this.$t('participant');
            let participantIndex = 0;
            this.eventContainer.participants.forEach(p => {
                participantContainers.push({
                    participant: p,
                    identifier: participantTrans + participantIndex++,
                    selected: true
                })
            });

            //add to containers alternating
            for (let i = 0; i < participantContainers.length; i++) {
                if (i % 2 === 0) {
                    this.participantContainers1.push(participantContainers[i]);
                } else {
                    this.participantContainers2.push(participantContainers[i]);
                }
            }
            this.participantContainers = participantContainers;
        }
    }
</script>