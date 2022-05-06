<template>
    <div class="container catalog_flowcal">
        <div class="title">
            <h2>{{$t('catalog.flowcal_title')}}</h2>
        </div>
        <div class="body row">
            <div class="text col-md-9 col-sm-12">
                <h1>{{$t('comming_soon')}}</h1>
            </div>
        </div>
    </div>
</template>

<style scoped>
.catalog_flowcal {
  padding: 20px 0;
  min-height: 30rem;
}
.catalog_flowcal .title {
  padding: 40px 0 20px 0;
  text-align: center;
}
.catalog_flowcal .body {
  padding: 20px 0;
}
.catalog_flowcal .body .text h1{
  font-weight: 600;
}
</style>