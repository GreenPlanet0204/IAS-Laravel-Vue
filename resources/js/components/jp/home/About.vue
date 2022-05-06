<template>
    <div class="container about">
        <div class="row">
            <div class="title col-md-4 col-sm-12">
                <span>{{$t('homepage.about')}}</span>
            </div>
            <div class="description col-md-8 col-sm-12">
                <span>
                {{$t('homepage.about_des')}}
                </span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.about {
  width: 70%;
  padding: 50px 0;
}
.about.row {
    margin: 0;
}
.about .title {
  padding: 20px 40px;
  font-size: 40px;
  font-weight: 400;
  text-transform: uppercase;
  text-align: center;
}
.about .description {
  padding: 20px 40px;
  font-size: 20px;
  font-weight: 300;
}
</style>
