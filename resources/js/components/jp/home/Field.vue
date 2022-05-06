<template>
    <div class="container fields">
      <div class="title">
        <h2>{{$t('homepage.field_title')}}</h2>
      </div>
      <div class="body row">
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subtitle">
            <h5>{{$t('homepage.field_life')}}</h5>
          </div>
          <div class="image">
            <img src="/images/fields/life science.jpeg" />
          </div>
        </div>
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subtitle">
            <h5>{{$t('homepage.field_medical')}}</h5>
          </div>
          <div class="image">
            <img src="/images/fields/medical.png" />
          </div>
        </div>
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subtitle">
            <h5>{{$t('homepage.field_industrial')}}</h5>
          </div>
          <div class="image">
            <img src="/images/fields/industrial.jpg" />
          </div>
        </div>
        <div class="body-pannel col-md-3 col-sm-12">
          <div class="subtitle">
            <h5>{{$t('homepage.field_drone')}}</h5>
          </div>
          <div class="image">
            <img src="/images/fields/drone.png" />
          </div>
        </div>
      </div>
    </div>
</template>

<style scoped>
.fields {
  padding: 50px 0;
}
.fields .title {
  text-align: center;
  padding: 40px 0;
}
.fields .body .body-pannel {
  padding: 0.2rem 2.5rem;
}
.fields .body .subtitle {
  padding: 0.3rem 0;
  text-align: center;
}
.fields .body .subtitle >h5 {
  line-height: 1.4;
}
.fields .body .image >img {
    width: 100%;
}
</style>