<template>
  <div class="row">
    <div class="col-lg-7 m-auto">
      <card :title="$t('login')">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('email') }}</label>
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">{{ $t('password') }}</label>
            <div class="col-md-7">
              <div style="display: flex">
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" :type="passwordType" name="password">
                <b-icon v-if="passwordType=='password'" icon="eye-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
                <b-icon v-else icon="eye-slash-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
              </div>
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Remember Me -->
          <div class="mb-3 row">
            <div class="col-md-3" />
            <div class="col-md-7 d-flex">
              <checkbox v-model="remember" name="remember">
                {{ $t('remember_me') }}
              </checkbox>

              <router-link :to="{ name: 'password.request' }" class="small ms-auto my-auto">
                {{ $t('forgot_password') }}
              </router-link>
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t('login') }}
              </v-button>

              <b-button variant="outline-primary" :to="{ name: registername ? 'registerCustomer' : 'registerAgency' }">
                {{$t('register')}}
              </b-button>
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  components: {
    LoginWithGithub
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false,
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
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: this.locale })
      }
    }
  },

  created() {
    this.locale = Cookies.get('locale')
  },

  props: {
    registername: {default: true}
  }
}
</script>

<style scoped>
.m-auto {
  padding-top: 40px;
}
.d-flex {
  justify-content: space-between;
}
.password-display {
  width: 38px;
  height: 38px;
  padding: 5px;
}
</style>
