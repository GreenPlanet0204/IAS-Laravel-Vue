<template>
    <select :class="stateClass" :name="stateName" v-model="state">
        <option disabled v-if="!selectedCountry.length > 0">
            Please select a country first!
        </option>
        <option
            disabled
            v-if="!stateList.length > 0 && selectedCountry.length > 0"
            >Sorry, there is a list of cities in {{ selectedCountry }}!</option
        >
        <option :value="state.name" v-for="state in stateList" :key="state.id">
            {{ state.name }}
        </option>
    </select>
</template>

<script>
export default {
    data: () => ({
        countryList: [],
        state: ""
    }),
    created() {
        this.countryList = require("/data/countries.json");
    },
    props: {
        stateClass: { type: String, default: null },
        stateName: { type: String, default: null },
        selectedCountry: { type: String, default: null },
        stateList: {default: null}
    }
}
</script>