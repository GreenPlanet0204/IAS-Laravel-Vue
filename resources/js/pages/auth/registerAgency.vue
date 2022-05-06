<template>
  <div class="row">
    <div class="cus_reg_title">
        <h1>{{$t('agency_register')}}</h1>
    </div>
    <div class="col-lg-9 m-auto">
      <card v-if="mustVerifyEmail">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else>
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Company Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('company_name') }}</label>
            <div class="col-md-7">
              <input v-model="form.company_name" :class="{ 'is-invalid': form.errors.has('company_name') }" class="form-control" type="text" name="company_name" :placeholder="$t('company_name')">
              <has-error :form="form" field="company_name" />
            </div>
          </div>

          <!-- SEO/Person -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('seo_name') }}</label>
            <div class="col-md-7">
              <input v-model="form.seo_name" :class="{ 'is-invalid': form.errors.has('seo_name') }" class="form-control" type="text" name="seo_name" :placeholder="$t('seo_name')">
              <has-error :form="form" field="seo_name" />
            </div>
          </div>

          <!-- Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('name') }}</label>
            <div class="col-md-7">
              <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name" :placeholder="$t('name')">
              <has-error :form="form" field="name" />
            </div>
          </div>

          <!-- Nike Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('nike_name') }}</label>
            <div class="col-md-7">
              <input v-model="form.nike_name" :class="{ 'is-invalid': form.errors.has('nike_name') }" class="form-control" type="text" nike_name="nike_name" :placeholder="$t('nike_name')">
              <has-error :form="form" field="nike_name" />
            </div>
          </div>

          <!-- Email -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('email') }}</label>
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" :placeholder="$t('email')">
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Address 1 -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('address_1') }}</label>
            <div class="col-md-7">
              <input v-model="form.address_1" :class="{ 'is-invalid': form.errors.has('address_1') }" class="form-control" type="text" name="address_1" :placeholder="$t('address_1')">
              <has-error :form="form" field="address_1" />
            </div>
          </div>

          <!-- Moblie Phone -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('phone') }}</label>
            <div class="col-md-7">
              <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" type="tel" name="phone" pattern="^(\W|\d){9,15}" placeholder="(+)000-000-0000">
              <has-error :form="form" field="phone" />
            </div>
          </div>

          <!-- Zip Code -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('zip') }}</label>
            <div class="col-md-7">
              <input v-model="form.zip" :class="{ 'is-invalid': form.errors.has('zip') }" class="form-control" type="text" name="zip" pattern="[0-9]{3,7}" placeholder="12345">
              <has-error :form="form" field="zip" />
            </div>
          </div>

          <!-- Company Website -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('company_site') }}</label>
            <div class="col-md-7">
              <input v-model="form.company_site" :class="{ 'is-invalid': form.errors.has('company_site') }" class="form-control" type="text" name="company_site" :placeholder="$t('company_site')">
              <has-error :form="form" field="company_site" />
            </div>
          </div>

          <!-- Transaction Condition(Please note that we may not be able to meet your request) -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('transaction_con') }}</label>
            <div class="col-md-7">
              <textarea v-model="form.transaction_con" :class="{ 'is-invalid': form.errors.has('transaction_con') }" class="form-control" type="text" name="transaction_con" :placeholder="$t('transaction_con_des')"></textarea>
              <has-error :form="form" field="transaction_con" />
            </div>
          </div>

          <!-- Deposit amount -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('deposit_amount') }}</label>
            <div class="col-md-7">
              <input v-model="form.deposit_amount" :class="{ 'is-invalid': form.errors.has('deposit_amount') }" class="form-control" type="number" name="deposit_amount" :placeholder="$t('deposit_amount')">
              <has-error :form="form" field="deposit_amount" />
            </div>
          </div>

          <!-- Department of the Company -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('deaprtment') }}</label>
            <div class="col-md-7">
              <input v-model="form.deaprtment" :class="{ 'is-invalid': form.errors.has('deaprtment') }" class="form-control" type="text" name="deaprtment" :placeholder="$t('deaprtment')">
              <has-error :form="form" field="deaprtment" />
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('password') }}</label>
            <div class="col-md-7">              
              <div style="display: flex">
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" :type="passwordType" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" :placeholder="$t('password')">
                <b-icon v-if="passwordType=='password'" icon="eye-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
                <b-icon v-else icon="eye-slash-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
              </div>
              <span class="password_validate">{{ $t('password_pattern') }}</span>
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Password Confirmation -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('confirm_password') }}</label>
            <div class="col-md-7">
              <div style="display: flex">
                <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" :type="passwordType" name="password_confirmation">
                <b-icon v-if="passwordType=='password'" icon="eye-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
                <b-icon v-else icon="eye-slash-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
              </div>
              <has-error :form="form" field="password_confirmation" />
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t('application') }}
              </v-button>

              <!-- GitHub Register Button -->
              <login-with-github />
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import swal from 'sweetalert2/dist/sweetalert2.js'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  components: {
    LoginWithGithub
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('agency_register') }
  },

  data: () => ({
    form: new Form({
        company_name: '',
        seo_name: '',        
        name: '',
        nike_name: '',
        email: '',
        address_1: '',
        deaprtment: '',
        phone: '',
        zip: '',
        company_site: '',
        transaction_con: '',
        deposit_amount: '',
        password: '',
        password_confirmation: ''
    }),
    mustVerifyEmail: false,
    passwordType: 'password'
  }),

  methods: {
    passwordTypeChange() {
      if(this.passwordType == 'password') {
        this.passwordType = 'text'
      } else {
        this.passwordType = 'password'
      }
    },
    async register () {
        // Register the user.
        const { data } = await this.form.post('/api/agencyregister')
        if (data) {
            swal.fire({
                icon: 'success',
                title: this.$t('register_success_title'),
                text: this.$t('agency_register_success_text'),
                reverseButtons: true,
                confirmButtonText: this.$t('ok'),
                cancelButtonText: this.$t('cancel')
            }).then(() => {
                this.$router.push({ name: 'home' })
            })
        } else {
            swal.fire({
                icon: 'warning',
                title: this.$t('register_failure_title'),
                text: this.$t('agency_register_faiure_text'),
                reverseButtons: true,
                confirmButtonText: this.$t('ok'),
                cancelButtonText: this.$t('cancel')
            }).then(() => {
                this.$router.push({ name: 'registerAgency' })
            })
        }
      // Must verify email first.
    //  if (data.status) {
    //    this.mustVerifyEmail = true
    //  } else {
        // Log in the user.
    //    const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
    //    this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
    //    await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
    //    this.$router.push({ name: 'home' })
    //  }
    },
  }
}
</script>

<style scoped>
.cus_reg_title {
    padding: 40px 0;
    background-color: #211F40;
    text-align: center;
    color: #fff;
}
.m-auto {
    padding-top: 10px;
}
.password_validate {
  font-size: 12px;
  color: red;
}
.password-display {
  width: 38px;
  height: 38px;
  padding: 5px;
}
</style>
