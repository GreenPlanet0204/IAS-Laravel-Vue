<template>
    <div>        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$t('applications.create_title')}}</h1>
            <router-link class="btn btn-secondary btn-icon-split" :to="{name: 'admin.applications'}">
              <span class="text">{{$t('back')}}</span>
              <span class="icon text-white-50">
                <i class="fas fa-arrow-right"></i>
              </span>
            </router-link>
        </div>
        <card>
            <form @submit.prevent="create_application" @keydown="form.onKeydown($event)">
                <!-- Application Name -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">{{ $t('applications.app_name') }}</label>
                    <div class="col-md-8">
                    <input v-model="form.app_name" :class="{ 'is-invalid': form.errors.has('app_name') }" class="form-control" type="text" name="app_name" :placeholder="$t('applications.app_name')">
                    <has-error :form="form" field="app_name" />
                    </div>
                </div>

                <!-- Catagory ID -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">{{ $t('applications.cat_id') }}</label>
                    <div class="col-md-8">
                    <input v-model="form.cat_id" :class="{ 'is-invalid': form.errors.has('cat_id') }" class="form-control" type="number" name="cat_id" min="0" :placeholder="$t('applications.cat_id')">
                    <has-error :form="form" field="cat_id" />
                    </div>
                </div>

                <!-- Catagory Tab Name -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">{{ $t('applications.cat_tab') }}</label>
                    <div class="col-md-8">
                    <input v-model="form.cat_tab" :class="{ 'is-invalid': form.errors.has('cat_tab') }" class="form-control" type="text" name="cat_tab" :placeholder="$t('applications.cat_tab')">
                    <has-error :form="form" field="cat_tab" />
                    </div>
                </div>

                <!-- Price -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">{{ $t('applications.price') }}</label>
                    <!-- Currency -->
                    <div class="col-md-1">
                        <select v-model="form.currency" class="form-control" name="currency">
                            <option value="en" selected>$</option>
                            <option value="jp">¥</option>
                        </select>
                    </div>
                    <div class="col-md-7">
                        <input id="price" v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" class="form-control" type="number" name="price" min="0" step="10" :placeholder="$t('applications.price') "@focusout="discount_price_change">
                        <has-error :form="form" field="price" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">{{ $t('applications.discount') }}(%)</label>
                    <!-- Discount -->
                    <div class="col-md-2">
                        <input id="discount" v-model="form.discount" class="form-control" type="number" name="discount" min="0" @focusout="discount_price_change" >
                    </div>
                    <div class="col-md-6">
                        <input id="discount_price" v-model="form.discount_price" class="form-control" type="text" name="discount_price" min="0" :placeholder="$t('applications.discount_price')" disabled>
                    </div>
                </div>

                <!-- Period Date -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">{{ $t('applications.period_date') }}</label>
                    <div class="col-md-8">
                    <input v-model="form.period_date" :class="{ 'is-invalid': form.errors.has('period_date') }" class="form-control" type="number" name="period_date" :placeholder="$t('applications.period_date')">
                    <has-error :form="form" field="period_date" />
                    </div>
                </div>

                <!-- Capacity -->
                <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">{{ $t('applications.capacity') }}</label>
                    <div class="col-md-5">
                        <input v-model="form.capacity" :class="{ 'is-invalid': form.errors.has('capacity') }" class="form-control" type="number" min="0" name="capacity" :placeholder="$t('applications.capacity')">
                        <has-error :form="form" field="capacity" />
                    </div>
                    <div class="col-md-3">
                        <select v-model="form.capacity_unit" :class="{ 'is-invalid': form.errors.has('capacity_unit') }" class="form-control" name="capacity_unit">
                            <option value="G" selected>GByte</option>
                            <option value="T">TByte</option>
                        </select>
                        <has-error :form="form" field="capacity_unit" />
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-12 d-flex" style="justify-content: space-around;">
                        <!-- Submit Button -->
                        <v-button :loading="form.busy">
                            {{ $t('create') }}
                        </v-button>
                    </div>
                </div>
            </form>
        </card>
    </div>
</template>

<script>
import Form from 'vform'
import swal from 'sweetalert2/dist/sweetalert2.js'
export default {
    data: () => ({
        form : new Form ({
            app_name: '',
            cat_id: '',
            cat_tab: '',
            period_date: '',
            capacity: '',
            capacity_unit: '',
            currency: '',
            price: '',
            discount: '',
            discount_price: ''
        })
    }),
    methods: {
        discount_price_change() {
            var price = document.getElementById('price').value;
            var discount = document.getElementById('discount').value;
            if(price!='' && discount!='' && price!='0' && discount!='0') {
                var discount_price = price*((100-discount)/100)
                document.getElementById('discount_price').value = discount_price
                this.form.discount_price = discount_price
            }
        },
         async create_application () {
            // Create  new Application.
            const { data } = await this.form.post('/api/application/create')
            if (data) {
                swal.fire({
                    icon: 'success',
                    title: this.$t('successTitle'),
                    text: this.$t('successText'),
                    reverseButtons: true,
                    confirmButtonText: this.$t('ok'),
                    cancelButtonText: this.$t('cancel')
                }).then(() => {
                    this.$router.push({ name: 'admin.applications' })
                })
            } else {                
                swal.fire({
                    icon: 'warning',
                    title: this.$t('warningTitle'),
                    text: this.$t('warningText'),
                    reverseButtons: true,
                    confirmButtonText: this.$t('ok'),
                    cancelButtonText: this.$t('cancel')
                })
            }
        }
    }
}
</script>