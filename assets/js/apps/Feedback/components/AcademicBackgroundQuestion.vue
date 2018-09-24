<template>
    <div>
        <span><b>{{questionContainer.question.title}}</b></span>
        <div class="row mt-2">
            <div class="col-md-8">
                <select :title="$t('academic_background.field')" class="form-control" v-model="selectedField" @input="valueChanged">
                    <option v-for="field in fields" :key="field" :value="field">
                        {{field}}
                    </option>
                </select>
            </div>
            <div class="col-md-4">
                <select :title="$t('academic_background.institution')" class="form-control" v-model="selectedInstitution" @input="valueChanged">
                    <option v-for="institution in institutions" :key="institution" :value="institution">
                        {{institution}}
                    </option>
                </select>
            </div>

        </div>
    </div>
</template>

<script>
    import debounce from 'debounce'

    export default {
        props: {
            questionContainer: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedField: null,
                selectedInstitution: null
            };
        },
        methods: {
            valueChanged: debounce(function () {
                let answer = {
                    value: this.selectedField + " at " + this.selectedInstitution,
                    action: "override"
                };

                this.$emit('answer', answer);
            }, 500)
        },
        computed: {
            fields: function () {
                return this.questionContainer.question.fields;
            },
            institutions: function () {
                return this.questionContainer.question.institutions;
            }
        },
        mounted() {
            if (this.questionContainer.answers.length > 0) {
                const value = this.questionContainer.answers[0].value;
                if (value.indexOf(" at ") > 0) {
                    const parts = value.split(" at ");
                    if (this.fields.filter(a => a === parts[0]).length > 0) {
                        this.selectedField = parts[0];
                    }
                    if (this.institutions.filter(a => a === parts[1]).length > 0) {
                        this.selectedInstitution = parts[1];
                    }
                }
            }

            if (this.selectedField === null) {
                this.selectedField = this.fields[0];
            }

            if (this.selectedInstitution === null) {
                this.selectedInstitution = this.institutions[0];
            }
        }
    }
</script>