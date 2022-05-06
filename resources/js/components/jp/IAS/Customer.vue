<template>
    <div class="ias_customer">
        <div class="container">
            <div class="title">
                <h2>{{$t('ias.customer_title')}}</h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h6 class="ias_des">{{$t('ias.customer_des1')}}</h6>
                    <h6 class="ias_subtitle">{{$t('ias.customer_des1_name')}}</h6>
                    <span>{{$t('researcher')}}</span>
                </div>
                <div class="col-md-6 col-sm-12">                
                    <h6 class="ias_des">{{$t('ias.customer_des2')}}</h6>
                    <h6 class="ias_subtitle">{{$t('ias.customer_des2_name')}}</h6>
                    <span>{{$t('researcher')}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.ias_customer {    
    padding: 5rem 0;
    background-color: #EEEEEE;
}
.ias_customer .title {
    text-align: center;
    padding: 10px 0;
}
.ias_customer .title h2 {
    text-transform: uppercase;
    padding-bottom: 50px;
}
.ias_customer .row .ias_des {
    line-height: 1.9em;
    font-style: italic;
}
.ias_customer .row .ias_subtitle {
    padding-top: 10px;
    font-weight: 600;
    color: #0C6AED;
    text-transform: uppercase;
}
.ias_customer .row span {
    font-size: 12px;
}
</style>