<template>
  <card :title="$t('your_password')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('password_updated')" />

      <!-- Password -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">{{ $t('new_password') }}</label>
        <div class="col-md-7">
          <div style="display: flex">
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" :type="passwordType" name="password">
            <b-icon v-if="passwordType=='password'" icon="eye-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
            <b-icon v-else icon="eye-slash-fill" class="border rounded password-display" @click="passwordTypeChange"></b-icon>
          </div>
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

      <!-- Submit Button -->
      <div class="mb-3 row">
        <div class="col-md-9 ms-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('update') }}
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      password: '',
      password_confirmation: ''
    }),    
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
    async update () {
      await this.form.patch('/api/settings/password')

      this.form.reset()
    }
  }
}
</script>

<style>
.password-display {
  width: 38px;
  height: 38px;
  padding: 5px;
}
</style>
