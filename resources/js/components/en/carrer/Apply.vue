<template>
    <div class="container apply">
      <div class="title">
        <h6>{{$t('carrer.apply_your_next_job')}}</h6>
        <h2>{{$t('carrer.apply_title')}}</h2>
      </div>
      <div class="body row">
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-input :placeholder="$t('first_name')"></b-form-input>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-input :placeholder="$t('last_name')"></b-form-input>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-input :placeholder="$t('email')"></b-form-input>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-input :placeholder="$t('phone')"></b-form-input>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-input :placeholder="$t('city')"></b-form-input>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-select v-model="pos" :options="postext" class="form-select"></b-form-select>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-input :placeholder="$t('carrer.apply_linked_url')"></b-form-input>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="body-pannel">
            <b-form-select v-model="edu" :options="edutext" class="form-select"></b-form-select>
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          <div class="body-pannel">
            <b-form-textarea             
             :placeholder="$t('carrer.apply_personal_note')" 
             rows="3" 
             max-rows="6"
            ></b-form-textarea>
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          <div class="body-pannel" style="text-align:right;">
            <b-button variant="outline-primary">{{$t('submit')}}</b-button>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            pos: null,
            postext: [
                {value: null, text: this.$t('carrer.apply_position')},
                {value: 1, text: this.$t('carrer.apply_lateral')},
                {value: 2, text: this.$t('carrer.apply_product')},
                {value: 3, text: this.$t('carrer.apply_estate')},
                {value: 4, text: this.$t('carrer.apply_coporate')},
                {value: 5, text: this.$t('carrer.apply_law')},
                {value: 6, text: this.$t('carrer.apply_ass_attorney')},
                {value: 7, text: this.$t('carrer.apply_cor_attorney')}
            ],
            edu: null,
            edutext: [
                {value: null, text: this.$t('carrer.apply_education')},
                {value: 1, text: this.$t('carrer.apply_degree')},
            ]
        }
    }
}
</script>

<style scoped>
.apply {
    padding: 50px 0;
}
.apply .title {
    text-align: center;
    padding: 40px 0;
}
.apply .title h6 {
    padding-top: 20px;
}
.apply .title h2 {
    padding-top: 20px;
    padding-bottom: 20px;
} 
.apply .body .body-pannel {
    padding: 10px;
} 
.apply .body .body-pannel .btn-outline-primary {
    border-radius: 5px;
    padding: 5px 25px;
} 
</style>