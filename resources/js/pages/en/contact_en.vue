<template>
    <div class="container contact">
      <div class="title">
        <h1>{{$t('contact.title')}}</h1>
      </div>
      <div class="body row">
        <form @submit.prevent="contact_submit" method="post" enctype="multipart/form-data">
          <div class="col-md-12 row">
            <div class="col-md-6 col-sm-12">
              <div class="body-pannel">
                <b-form-input type="text" ref="your_name" v-model="name" :placeholder="$t('contact.your_name')" required></b-form-input>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="body-pannel">
                <b-form-input type="email" ref="your_email" v-model="email" :placeholder="$t('contact.your_email')" required></b-form-input>
              </div>
            </div>
          </div>
          <div class="col-md-12 row">
            <div class="col-md-6 col-sm-12">
              <div class="body-pannel">
                <b-form-input type="text" ref="phone_number" v-model="phone" :placeholder="$t('contact.phone_number')" required></b-form-input>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="body-pannel">
                <b-form-file v-model="file" :placeholder="$t('contact.attach_file')"></b-form-file>
              </div>
            </div>
          </div>
          <div class="col-md-12 row">
            <div class="col-md-12 col-sm-12">
              <div class="body-pannel">
                <b-form-textarea 
                type="text" 
                ref="message"
                v-model="message"            
                :placeholder="$t('contact.your_text')" 
                rows="3" 
                max-rows="6"
                ></b-form-textarea>
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="body-pannel" style="text-align:right;">
                <b-button type="submit" variant="primary" :disabled="loading">
                  <b-spinner small :hidden="!loading"></b-spinner>
                  {{$t('send')}}
                </b-button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
</template>

<script>
  import axios from 'axios'
  export default {
    data: () => ({
      name: '',
      email: '',
      phone: '',
      message: '',
      file: null,
      loading: false,
    }),
    methods: {
      async contact_submit() {
        if (this.$refs.your_name.value == '') {
          this.$refs.your_name.focus()
          return false
        }
        if (this.$refs.your_email.value == '') {
          this.$refs.your_email.focus()
          return false
        }
        if (this.$refs.phone_number.value == '') {
          this.$refs.phone_number.focus()
          return false
        }
        if (this.$refs.message.value == '') {
          this.$refs.message.focus()
          return false
        }
        var form = new FormData();
        form.set('email', this.email);
        form.set('name', this.name);
        form.set('phone', this.phone);
        form.set('message', this.message);
        form.set('file', this.file);
        
        this.loading = true
        var {data} = await axios.post('/api/contact/send', form)
        console.log(data)
        this.loading = false
      },
    }

  }
</script>

<style scoped>
.contact {
    padding: 20px 0;
}
.contact .title {
    text-align: center;
    padding: 20px 0;
}
.contact .title h1 {
    padding-top: 40px;
    padding-bottom: 20px;
    font-weight: 600;
} 
.contact .body .body-pannel {
    padding: 10px;
} 
.contact .body .body-pannel .btn-outline-primary {
    border-radius: 5px;
    padding: 5px 25px;
} 
</style>