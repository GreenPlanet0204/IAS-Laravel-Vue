<template>
  <div class="row">
    <div class="cus_reg_title">
        <h1>{{$t('customer_register')}}</h1>
    </div>
    <div class="col-lg-9 m-auto">
      <card v-if="mustVerifyEmail">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else>
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- First Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('first_name') }}</label>
            <div class="col-md-7">
              <input v-model="form.first_name" :class="{ 'is-invalid': form.errors.has('first_name') }" class="form-control" type="text" name="first_name" :placeholder="$t('first_name')">
              <has-error :form="form" field="first_name" />
            </div>
          </div>

          <!-- Last Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('last_name') }}</label>
            <div class="col-md-7">
              <input v-model="form.last_name" :class="{ 'is-invalid': form.errors.has('last_name') }" class="form-control" type="text" name="last_name" :placeholder="$t('last_name')">
              <has-error :form="form" field="last_name" />
            </div>
          </div>
          
          <!-- Nike Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('nike_name') }}</label>
            <div class="col-md-7">
              <input v-model="form.nike_name" :class="{ 'is-invalid': form.errors.has('nike_name') }" class="form-control" type="text" name="nike_name" :placeholder="$t('nike_name')">
              <has-error :form="form" field="nike_name" />
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

          <!-- Email -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('email') }}</label>
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" :placeholder="$t('email')">
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Organization -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('organization') }}</label>
            <div class="col-md-7">
              <input v-model="form.organization" :class="{ 'is-invalid': form.errors.has('organization') }" class="form-control" type="text" name="organization" :placeholder="$t('organization')">
              <has-error :form="form" field="organization" />
            </div>
          </div>

          <!-- Department -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('deaprtment') }}</label>
            <div class="col-md-7">
              <input v-model="form.deaprtment" :class="{ 'is-invalid': form.errors.has('deaprtment') }" class="form-control" type="text" name="deaprtment" :placeholder="$t('deaprtment')">
              <has-error :form="form" field="deaprtment" />
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

          <!-- Country --> 
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('country') }}</label>
            <div class="col-md-7">
              <Countryselect countryClass="form-control" countryName="country" @selected="changeCountry" @statesList="changeStates" />
            </div>
          </div>

          <!-- State/County -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('state') }}</label>
            <div class="col-md-7">              
              <Stateselect stateClass="form-control" stateName="state" :selectedCountry="selectedCountry" :stateList="stateList" />
            </div>
          </div>

          <!-- Country City/Town -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('city') }}</label>
            <div class="col-md-7">
              <input v-model="form.city" class="form-control" type="text" name="city">
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

          <!-- Address 2 -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('address_2') }}</label>
            <div class="col-md-7">
              <input v-model="form.address_2" :class="{ 'is-invalid': form.errors.has('address_2') }" class="form-control" type="text" name="address_2" :placeholder="$t('address_2')">
              <has-error :form="form" field="address_2" />
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
                {{ $t('register') }}
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
import Countryselect from '~/components/Countries'
import Stateselect from '~/components/States'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  components: {
    LoginWithGithub,
    Countryselect,
    Stateselect
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('customer_register') }
  },

  data: () => ({
    form: new Form({
        first_name: '',
        last_name: '',  
        nike_name: '',      
        name: '',
        email: '',
        organization: '',
        deaprtment: '',
        phone: '',
        zip: '',
        city: '',
        address_1: '',
        address_2: '',
        password: '',
        password_confirmation: ''
    }),
    selectedCountry: "",
    stateList: [],
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
      const { data } = await this.form.post('/api/customerregister')
      // Must verify email first.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        //const { data: { token } } = await this.form.post('/api/login')
        const { data } = await this.form.post('/api/login')

        // Save the token.
        //this.$store.dispatch('auth/saveToken', { token })
        this.$store.dispatch('auth/saveToken', {
          token: data.token,
          remember: this.remember
        })

        // Update the user.
        //await this.$store.dispatch('auth/updateUser', { user: data })

        // Fetch the user.
        await this.$store.dispatch('auth/fetchUser')

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    },
    changeCountry(value) {
      this.selectedCountry = value;
    },
    changeStates(value) {
      this.stateList = value;
    }
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
