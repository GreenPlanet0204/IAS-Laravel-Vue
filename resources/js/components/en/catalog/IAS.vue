<template>
    <div class="container catalog_ias">
        <div class="title">
            <h2>{{$t('catalog.ias_title')}}</h2>
        </div>
        <div class="body row">
            <div class="body-pannel col-md-3 col-sm-12">
                <div class="pannel">
                  <a href="/upload/pdf/ias_campain_en.pdf" target="_black">
                    <img src="/upload/img/ias_campain_en.png" />
                  </a>
                </div>
            </div>
            <div class="body-pannel col-md-3 col-sm-12">
                <div class="pannel">                
                  <a href="/upload/pdf/ias_catalog_4_06 _en_ver1.7.pdf" target="_black">
                    <img src="/upload/img/ias_catalog_4_06 _en_ver1.7.png" />
                  </a>                
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.catalog_ias {
  padding: 20px 0;
}
.catalog_ias .title {
    text-align: center;
  padding: 40px 0 20px 0;
}
.catalog_ias .description {
  padding: 10px 0 10px 30px;
}
.catalog_ias .body {
  padding: 20px 0;
}
.catalog_ias .body .body-pannel {
  padding: 0.2rem 1rem;
}
.catalog_ias .body .body-pannel .pannel {
  border-radius: 6px;
  background-color: #F9F9F9;
  transition: 0.3S
}
.catalog_ias .body .body-pannel .pannel img {
  width: 100%;
  padding: 30px;
}
</style>