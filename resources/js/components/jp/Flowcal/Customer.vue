<template>
    <div class="flowcal_customer">
        <div class="container">
            <div class="title">
                <h2>{{$t('flowcal.customer_title')}}</h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h6 class="flowcal_des">{{$t('flowcal.customer_des1')}}</h6>
                    <h6 class="flowcal_subtitle">{{$t('flowcal.customer_des1_name')}}</h6>
                    <span>{{$t('researcher')}}</span>
                </div>
                <div class="col-md-6 col-sm-12">                
                    <h6 class="flowcal_des">{{$t('flowcal.customer_des2')}}</h6>
                    <h6 class="flowcal_subtitle">{{$t('flowcal.customer_des2_name')}}</h6>
                    <span>{{$t('researcher')}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.flowcal_customer {    
    padding: 5rem 0;
    background-color: #EEEEEE;
}
.flowcal_customer .title {
    text-align: center;
    padding: 10px 0;
}
.flowcal_customer .title h2 {
    text-transform: uppercase;
    padding-bottom: 50px;
}
.flowcal_customer .row .flowcal_des {
    line-height: 1.9em;
    font-style: italic;
}
.flowcal_customer .row .flowcal_subtitle {
    padding-top: 10px;
    font-weight: 600;
    color: #0C6AED;
    text-transform: uppercase;
}
.flowcal_customer .row span {
    font-size: 12px;
}
</style>