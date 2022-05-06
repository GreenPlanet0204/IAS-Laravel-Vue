<template>
    <div class="container features">
      <div class="title">
        <h2>{{$t('homepage.feature_title')}}</h2>
      </div>
      <div class="body row">
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subimage">
            <b-icon icon="list-task"></b-icon>
          </div>
          <div class="subtitle">
            <h5>{{$t('homepage.feature_clude_title')}}</h5>
          </div>
          <div class="content">
            <h6>{{$t('homepage.feature_clude_content')}}</h6>
          </div>
        </div>
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subimage">
            <b-icon icon="alarm-fill"></b-icon>
          </div>
          <div class="subtitle">
            <h5>{{$t('homepage.feature_support_title')}}</h5>
          </div>
          <div class="content">
            <h6>{{$t('homepage.feature_supprot_content')}}</h6>
          </div>
        </div>
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subimage">
            <b-icon icon="phone"></b-icon>
          </div>
          <div class="subtitle">
            <h5>{{$t('homepage.feature_deep_title')}}</h5>
          </div>
          <div class="content">
            <h6>{{$t('homepage.feature_deep_content')}}</h6>
          </div>
        </div>
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subimage">
            <b-icon icon="pencil"></b-icon>
          </div>
          <div class="subtitle">
            <h5>{{$t('homepage.feature_sale_title')}}</h5>
          </div>
          <div class="content">
            <h6>{{$t('homepage.feature_sale_content')}}</h6>
          </div>
        </div>
      </div>
    </div>
</template>

<style scoped>
.features {
  padding: 50px 0;
}
.features .title {
  text-align: center;
  padding: 40px 0;
}
.features .body .body-pannel {
  padding: 0.2rem 2.5rem;
}
.features .body .subtitle {
  padding: 0.3rem 0;
}
.features .body .subimage svg {
  fill: #007FED;
  width: 35px;
  height: 35px;
}
.features .body .subtitle >h5 {
  line-height: 1.4;
}
.features .body .content {
  padding: 0.1rem 0;
}
.features .body .content >h6 {
  line-height: 1.5;
}
</style>