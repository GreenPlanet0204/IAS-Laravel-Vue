<template>
    <div class="container flowcal">
        <div class="title">
            <h2>{{$t('flowcal_title')}}</h2>
        </div>
        <div class="body row">
            <div class="text col-md-9 col-sm-12">
                <h1>{{$t('comming_soon')}}</h1>
                <h5>{{$t('purchase.flowcal_des')}}</h5>
            </div>
            <div class="button col-md-3 col-sm-12">
                <b-button variant="outline-primary" :to="{ name: $t('contact.url') }">{{$t('contact.text')}}</b-button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.flowcal {
  padding: 20px 0;
  min-height: 30rem;
}
.flowcal .title {
  padding: 40px 5px 20px 5px;
}
.flowcal .body {
  padding: 20px 0;
}
.flowcal .body .text h1{
  font-weight: 600;
  padding: 0 5px;
}
.flowcal .body .text h5{
  padding-top: 20px;
  padding-left: 20px;
}
.flowcal .body .button {
    text-align: center;
    padding-top: 4rem;
}
.flowcal .body .button .btn-outline-primary {
    border-radius: 15px;
}
</style>