<template>
    <div class="container introduction">
      <div class="title">
        <h2>{{$t('homepage.intro_title')}}</h2>
      </div>
      <div class="body row" style="height: 20rem">
        <div class="text col-md-6 col-sm-12">
          <div class="subtitle">
            <h4>{{$t('homepage.intro_subtitle')}}</h4>
          </div>
          <div class="content">
            <h6>{{$t('homepage.intro_subcontent')}}</h6>
          </div>
          <div class="button">
            <b-button variant="outline-primary">{{ $t('subscribe') }}</b-button>
          </div>
        </div>
        <div class="video col-md-6 col-sm-12">
          <div>
            <iframe src="https://www.youtube.com/embed/51BIfNZQIFc" width="480" height="270"> </iframe>
          </div>
          <!-- <youtube :video-id="videoId" @ready="ready" @playing="playing" player-width= "480" player-height="270"></youtube> -->
        </div>
      </div>
    </div>
</template>

<script>
  export default {
    data: () => ({
      videoId: 'videoId',
    }),
    methods: {
      ready (event) {
        this.player = event.target
      },
      palying (event) {
      },
      change () {
        this.videoId = this.$youtube.getIdFromURL('https://www.youtube.com/embed/51BIfNZQIFc')
      },
      stop () {
        this.player.stopVideo()
      },
      pause () {
        this.player.pauseVideo()
      }
    }
  }
</script>

<style scoped>
.introduction {
  padding: 50px 0;
}
.introduction .title {
  text-align: center;
  padding: 40px 0;
}
.introduction .body .text {
  padding: 0.2rem 2.5rem;
}
.introduction .body .subtitle {
  padding: 1rem 0;
}
.introduction .body .subtitle h4 {
  line-height: 1.4;
}
.introduction .body .button {
  padding-top: 10px;
}
.introduction .body .button .btn-outline-primary {
  border-radius: 10px;
}
.introduction .body .video div {
  width: 100%;
  height: 100%;
  text-align:center;
  padding: 15px; 
}
</style>