<template>
    <div class="contact">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <h3>{{$t('homepage.contact_title')}}</h3>
                <div class="content">
                    <span>{{$t('homepage.contact_content')}}</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <b-button variant="outline-primary" :to="{ name: $t('contact.url')}">{{$t('contact.text')}}</b-button>
            </div>
        </div>
    </div>
</template>

<style scoped>

.contact {
  padding: 30px 40px;
  border-top:1px solid gainsboro;
  background-color: #007FED;
}
.contact.row {
    margin: 0;
}
.contact .row h3 {
    color: #fff;
    font-weight: 600;
}
.contact .row .content{
  padding: 10px 0;
  color: #fff;
}
.contact .btn-outline-primary {
    color: #fff;
    border-color: #fff;
    font-size: 15px;
    border-radius: 15px;
    font-weight: 200;
}
</style>
