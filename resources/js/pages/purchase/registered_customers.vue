<template>
    <div>
        <div class="header">
            <h1>{{$t('customers')}}</h1>
        </div>
        <div class="content">        
            <b-container fluid>
                <!-- User Interface controls -->
                <b-row>
                    <b-col lg="5" class="my-1">
                        <b-form-group
                        :label="$t('filter')"
                        label-for="filter-input"
                        label-cols-sm="3"
                        label-align-sm="right"
                        label-size="sm"
                        class="mb-0"
                        >
                            <b-input-group size="sm">
                                <b-form-input
                                id="filter-input"
                                v-model="filter"
                                type="search"
                                :placeholder="$t('type_to_search')"
                                ></b-form-input>

                                <b-input-group-append>
                                <b-button :disabled="!filter" @click="filter = ''">{{$t('clear')}}</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </b-form-group>
                    </b-col>

                    <b-col lg="7" class="my-1">
                        <b-form-group
                        :label="$t('filter_on')"
                        label-cols-sm="3"
                        label-align-sm="right"
                        label-size="sm"
                        class="mb-0"
                        v-slot="{ ariaDescribedby }"
                        >
                        <b-form-checkbox-group
                            v-model="filterOn"
                            :aria-describedby="ariaDescribedby"
                            class="mt-1"
                        >
                            <b-form-checkbox value="email">{{$t('email')}}</b-form-checkbox>
                            <b-form-checkbox value="app_name">{{$t('applications.app_name')}}</b-form-checkbox>
                            <b-form-checkbox value="cat_tab">{{$t('applications.cat_tab')}}</b-form-checkbox>
                        </b-form-checkbox-group>
                        </b-form-group>
                    </b-col>

                    <b-col md="5" class="my-1">
                        <b-form-group
                        :label="$t('per_page')"
                        label-for="per-page-select"
                        label-cols-lg="4"
                        label-align-sm="center"
                        label-size="sm"
                        class="mb-0"
                        >
                            <b-form-select
                                id="per-page-select"
                                v-model="perPage"
                                :options="pageOptions"
                                size="sm"
                            ></b-form-select>
                        </b-form-group>
                    </b-col>

                    <b-col md="4"></b-col>

                    <b-col md="3" class="my-1">
                        <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="fill"
                        size="sm"
                        class="my-0"
                        ></b-pagination>
                    </b-col>
                </b-row>

                <!-- Main table element -->
                <b-table
                responsive
                striped hover
                :items="items"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :filter="filter"
                :filter-included-fields="filterOn"
                stacked="md"
                show-empty
                small
                @filtered="onFiltered"
                >
                    <template v-slot:cell(index)="data">
                        {{data.index + 1}}
                    </template>
                    <template v-slot:cell(capacity)="data">
                        {{data.item.capacity}} {{data.item.capacity_unit}}                      
                    </template>
                </b-table>

                <b-row> 
                    <b-col md="5" class="my-1">
                        <b-form-group
                        :label="$t('per_page')"
                        label-for="per-page-select"
                        label-cols-lg="4"
                        label-align-sm="center"
                        label-size="sm"
                        class="mb-0"
                        >
                            <b-form-select
                                id="per-page-select"
                                v-model="perPage"
                                :options="pageOptions"
                                size="sm"
                            ></b-form-select>
                        </b-form-group>
                    </b-col>

                    <b-col md="4"></b-col>

                    <b-col md="3" class="my-1">
                        <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="fill"
                        size="sm"
                        class="my-0"
                        ></b-pagination>
                    </b-col>
                </b-row>
            </b-container>
        </div>
    </div>
</template>
<script>    
    import axios from 'axios'
    import { mapGetters } from 'vuex'

    export default {
        data() {
            return {
                items: [],
                fields: [
                { key: 'index', label: ''},
                { key: 'email', label: this.$root.$i18n.tc('email')},
                { key: 'app_name', label: this.$root.$i18n.tc('applications.app_name')},
                { key: 'cat_tab', label: this.$root.$i18n.tc('applications.cat_tab')},
                { key: 'period_date', label: this.$root.$i18n.tc('expire_date')},
                { key: 'capacity', label: this.$root.$i18n.tc('applications.capacity')},
                { key: 'created_at', label: this.$root.$i18n.tc('created_date')}
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 15, { value: 100, text: this.$root.$i18n.tc('show_a_lot') }],
                filter: null,
                filterOn: []
            }
        },
        mounted() {
            // Set the initial number of items
            this.totalRows = this.items.length
        },
        created() {
            this.getRegisteredCustomers()
        },
        methods: {            
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            removeRow(index) {
                this.items.splice(index, 1)
            },
            async getRegisteredCustomers(id){
                const {data} = await axios.get('/api/get/purchase/admin/registered_customers')
                console.log(data)
                for (let i = 0; i < data.length; i++) {
                    let created_date = new Date(data[i].created_at)
                    let createdyear = created_date.getFullYear()
                    let createdmonth = created_date.getMonth()+1
                    let createddate = created_date.getDate()
                    data[i].created_at = createdyear+'-'+createdmonth+'-'+createddate
                    let expire_date = new Date(data[i].created_at)
                    expire_date.setDate(created_date.getDate()+data[i].period_date)
                    let expireyear = expire_date.getFullYear()
                    let expiremonth = expire_date.getMonth()+1
                    let expiredate = expire_date.getDate() 
                    data[i].period_date = expireyear+'-'+expiremonth+'-'+expiredate
                }                
                this.items = data                
                this.totalRows = this.items.length
            }
        },
        computed: mapGetters({
            user: 'auth/user'
        })

    }
</script>

<style scoped>
    .header {
        width: 100%;
        background-color: #211F40;
        height: 150px;
    }
    .header h1 {
        padding-top: 3rem;
        text-align: center;
        color: #fff;
        font-weight: 600;
    }
    .content {
        padding: 50px 10px 20px 10px;
    }
</style>