<template>
    <select :class="countryClass" :name="countryName" v-model="country">
    <option
        :value="country.name"
        v-for="country of countryList"
        :key="country.id"
        >{{ country.name }}</option
    >
    </select>
</template>

<script>
export default {
    data: () => ({
        countryList: [],
        States: [],
        country: ""
    }),
    created() {
        this.countryList = require("/data/countries.json");
    },
    watch: {
        country() {
            this.$emit("selected", this.country);
            this.States=[];
            for (const everycountry of this.countryList) {
                if (this.country == everycountry.name) {
                    everycountry.states.forEach(state => {
                        this.States.push(state);
                    });
                }
            }
            this.$emit("statesList", this.States);
        }
    },
    props: {
        countryClass: { type: String, default: null },
        countryName: { type: String, default: null }
    }
}
</script>