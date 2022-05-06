<template>
    <div class="ias_subscription">
        <div class="container">
            <div class="title">
                <h2>{{$t('ias.subscription_title')}}</h2>
            </div>
            <div class="description">
                <h5>{{$t('ias.subscription_des')}}</h5>
            </div>
            <div class="body row">
                <div class="body-pannel col-md-3 col-sm-12">
                    <div class="white-pannel">
                        <div class="head">
                            <h3>{{$t('ias.1_month')}}<br/>{{$t('ias.plan')}}</h3>
                            <h6>I A S</h6>
                            <hr />
                        </div>
                        <div class="content">
                            <ul>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.user')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.500server')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.chat')}}</li>
                            </ul>
                        </div>
                        <div class="foot">
                            <div class="button">
                                <b-button variant="outline-primary" :to="{ name: $t('purchase.url') }">{{$t('subscribe')}}</b-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body-pannel col-md-3 col-sm-12">
                    <div class="blue-pannel">
                        <div class="head">
                            <h3>{{$t('ias.3_month')}}<br/>{{$t('ias.plan')}}</h3>
                            <h6>I A S</h6>
                            <hr />
                        </div>
                        <div class="content">
                            <ul>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.user')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.500server')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.chat')}}</li>
                            </ul>
                        </div>
                        <div class="foot">
                            <div class="button">
                                <b-button variant="outline-primary" :to="{ name: $t('purchase.url') }">{{$t('subscribe')}}</b-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body-pannel col-md-3 col-sm-12">
                    <div class="white-pannel">
                        <div class="head">
                            <h3>{{$t('ias.annual')}}<br/>{{$t('ias.plan')}}</h3>
                            <h6>I A S</h6>
                            <hr />
                        </div>
                        <div class="content">
                            <ul>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.user')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.500server')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.chat')}}</li>
                            </ul>
                        </div>
                        <div class="foot">
                            <div class="button">
                                <b-button variant="outline-primary" :to="{ name: $t('purchase.url') }">{{$t('subscribe')}}</b-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body-pannel col-md-3 col-sm-12">
                    <div class="blue-pannel">
                        <div class="head">
                            <h3>{{$t('ias.annual_special')}}<br/>{{$t('ias.plan')}}</h3>
                            <h6>I A S</h6>
                            <hr />
                        </div>
                        <div class="content">
                            <ul>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.user')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.2Tserver')}}</li>
                                <li><b-icon icon="check"></b-icon>{{$t('ias.chat')}}</li>
                            </ul>
                        </div>
                        <div class="foot">
                            <div class="button">
                                <b-button variant="outline-primary" :to="{ name: $t('purchase.url') }">{{$t('subscribe')}}</b-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.ias_subscription {
    padding-top: 5rem;
    padding-bottom: 1rem;
    background-color: #EEEEEE;
}
.ias_subscription .title {
  text-align: center;
  padding: 20px 0;
}
.ias_subscription .title h2 {
  text-transform: uppercase;
}
.ias_subscription .description {
  text-align: center;
  padding: 10px 0;
}
.ias_subscription .body {
  padding: 20px 0;
}
.ias_subscription .body .body-pannel {
  padding: 0.2rem 1rem;
}
.ias_subscription .body .body-pannel .white-pannel,
.ias_subscription .body .body-pannel .blue-pannel {
  border-radius: 12px;
}
.ias_subscription .body .body-pannel .white-pannel {
    color: #000;
    background-color: #fff
}
.ias_subscription .body .body-pannel .blue-pannel {
    color: #fff;
    background-color: #0D70FA
}
.ias_subscription .body .body-pannel .white-pannel .head,
.ias_subscription .body .body-pannel .blue-pannel .head {
    padding-top: 3rem;
    text-align: center;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}
.ias_subscription .body .body-pannel .white-pannel .head h3,
.ias_subscription .body .body-pannel .blue-pannel .head h3 {
  font-weight: 600;
}
.ias_subscription .body .body-pannel .white-pannel .head h6,
.ias_subscription .body .body-pannel .blue-pannel .head h6 {
  padding: 10px 0;
}
.ias_subscription .body .body-pannel .white-pannel .head hr,
.ias_subscription .body .body-pannel .blue-pannel .head hr {
  margin: 0 6rem;
  margin-top: 2rem;
  height: 3px;
  color: #000;
}
.ias_subscription .body .body-pannel .white-pannel .head hr {
  color: #000;
}
.ias_subscription .body .body-pannel .blue-pannel .head hr {
  color: #fff;
}
.ias_subscription .body .body-pannel .white-pannel .content,
.ias_subscription .body .body-pannel .blue-pannel .content {
  line-height: 3rem;
  padding: 1rem;
}
.ias_subscription .body .body-pannel .white-pannel .content li,
.ias_subscription .body .body-pannel .blue-pannel .content li {
    list-style-type: none;
}
.ias_subscription .body .body-pannel .white-pannel .content li svg,
.ias_subscription .body .body-pannel .blue-pannel .content li svg {
    width: 3rem;
}
.ias_subscription .body .body-pannel .white-pannel .foot,
.ias_subscription .body .body-pannel .blue-pannel .foot {
    text-align: center;
    padding-bottom: 3rem;
}
.ias_subscription .body .body-pannel .white-pannel .foot .btn-outline-primary {
  color: #4054B2;
  background-color: #FFF;
  border-radius: 20px;
  border: 2px solid #0D70FA;
}
.ias_subscription .body .body-pannel .white-pannel .foot .btn-outline-primary:hover {
  color: #fff;
  background-color: #0D70FA;
}
.ias_subscription .body .body-pannel .blue-pannel .foot .btn-outline-primary {
  color: #4054B2;
  background-color: #FFF;
  border-radius: 20px;
  border: 2px solid #fff;
}
.ias_subscription .body .body-pannel .blue-pannel .foot .btn-outline-primary:hover {
  color: #fff;
  background-color: #4054B2;
}
</style>