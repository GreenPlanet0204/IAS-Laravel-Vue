<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$t('title_users')}}</h1>
        </div>
        <b-container fluid>
            <!-- User Interface controls -->
            <b-row>
                <b-col lg="4" class="my-1">
                    <b-form-group
                    :label="$t('filter')"
                    label-for="filter-input"
                    label-cols-sm="2"
                    label-align-sm="right"
                    label-size="sm"
                    class="mb-0"
                    >
                        <b-input-group size="sm">
                            <b-form-input
                            id="filter-input"
                            v-model="filter"
                            type="search"
                            placeholder="Type to Search"
                            ></b-form-input>

                            <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">{{$t('clear')}}</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>

                <b-col lg="8" class="my-1">
                    <b-form-group
                    :label="$t('filter_on')"
                    label-cols-sm="2"
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
                        <b-form-checkbox value="name">{{$t('name')}}</b-form-checkbox>
                        <b-form-checkbox value="email">{{$t('email')}}</b-form-checkbox>
                        <b-form-checkbox value="phone">{{$t('phone')}}</b-form-checkbox>
                        <b-form-checkbox value="role">{{$t('role')}}</b-form-checkbox>
                        <b-form-checkbox value="permission">{{$t('permission')}}</b-form-checkbox>
                    </b-form-checkbox-group>
                    </b-form-group>
                </b-col>

                <b-col md="4" class="my-1">
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

                <b-col md="5"></b-col>

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
                <template #cell(email)="data">
                    <router-link :to="{name: 'user-profile', params: {id: data.item.id}}">{{data.value}}</router-link>
                </template>
                <template #cell(role)="data">
                    {{$t(data.value)}}
                </template>
                <template #cell(permission)="data">
                    {{$t(data.value)}}
                </template>
            </b-table>

            <b-row> 
                <b-col md="4" class="my-1">
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

                <b-col md="5"></b-col>

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
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                items: '',
                fields: [
                { key: 'index', label: ''},
                { key: 'name', label: this.$root.$i18n.tc('name')},
                { key: 'email', label: this.$root.$i18n.tc('email')},
                { key: 'role', label: this.$root.$i18n.tc('role')},
                { key: 'permission', label: this.$root.$i18n.tc('permission')},
                { key: 'phone', label: this.$root.$i18n.tc('phone')}
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
        methods: {
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            async getUsers () {
                const { data } = await axios.get('/api/get/users')
                this.items = data
                this.totalRows = this.items.length
            },
            removeRow(index) {
                this.items.splice(index, 1)
            }
        },        
        created() {
            this.getUsers()
        }
    }
</script>
