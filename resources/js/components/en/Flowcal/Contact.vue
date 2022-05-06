<template>
    <div class="flowcal_contact">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12">
                    <h3>{{$t('flowcal.contact_des')}}</h3>
                </div>
                <div class="col-md-2 col-sm-12">
                    <b-button variant="outline-primary" :to="{ name: $t('contact.url')}">{{$t('contact.text')}}</b-button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

.flowcal_contact {
    padding-top: 5rem;
    padding-bottom: 3rem;
}
.flowcal_contact.row {
    margin: 0;
}
.flowcal_contact .row h3 {
    font-weight: 600;
}
.flowcal_contact .btn-outline-primary {
    color: #fff;
    border-color: #0C6AED;
    font-size: 15px;
    border-radius: 15px;
    font-weight: 400;
    background-color: #0C6AED;
}
</style>
