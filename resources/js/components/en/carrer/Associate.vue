<template>
    <div class="container associate">
      <div class="title">
        <h6>{{$t('carrer.asso_job_opp')}}</h6>
        <h2>{{$t('carrer.asso_title')}}</h2>
      </div>
      <div class="body row">
        <div class="col-md-6 col-sm-12">
          <div class="body-pannel">
            <div class="content">
                <h4>{{$t('carrer.asso_des1_title')}}</h4>
                <h6>{{$t('carrer.asso_des1_con')}}</h6>
            </div>
            <div class="button">
                <b-button variant="outline-primary">{{$t('apply')}}</b-button>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="body-pannel">
            <div class="content">
                <h4>{{$t('carrer.asso_des2_title')}}</h4>
                <h6>{{$t('carrer.asso_des2_con')}}</h6>
            </div>
            <div class="button">
                <b-button variant="outline-primary">{{$t('apply')}}</b-button>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="body-pannel">
            <div class="content">
                <h4>{{$t('carrer.asso_des3_title')}}</h4>
                <h6>{{$t('carrer.asso_des3_con')}}</h6>
            </div>
            <div class="button">
                <b-button variant="outline-primary">{{$t('apply')}}</b-button>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="body-pannel">
            <div class="content">
                <h4>{{$t('carrer.asso_des4_title')}}</h4>
                <h6>{{$t('carrer.asso_des4_con')}}</h6>
            </div>
            <div class="button">
                <b-button variant="outline-primary">{{$t('apply')}}</b-button>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<style scoped>
.associate {
    padding: 50px 0;
}
.associate .title {
    text-align: center;
    padding: 40px 0;
}
.associate .title h6 {
    padding-top: 20px;
}
.associate .title h2 {
    padding-top: 20px;
    padding-bottom: 20px;
}
.associate .body .col-md-6 {
    padding-top: 20px;
}
.associate .body .body-pannel {
    display: flex;
    justify-content: space-around;
    padding: 20px;
    min-height: 10rem;
    border-left: 2px solid #007FED;
    box-shadow: 0 1.5px 12px 2px rgba(45, 44, 44, 0.33);
    height: 100%;
    transition: 0.3S;
}
.associate .body .body-pannel:hover {
    box-shadow: 0 1.5px 12px 2px rgb(120, 140, 251);
}
.associate .body .body-pannel .content {
    padding-top: 5px 5px;
    width: 75%;
}
.associate .body .body-pannel .content h4 {
    padding: 10px 0;
}
.associate .body .body-pannel .button {
    padding-left: 5px;
    width: 20%;
    display: flex;
    align-items: center;
}
.associate .body .body-pannel .button .btn-outline-primary {
  border-radius: 5px;
}
</style>