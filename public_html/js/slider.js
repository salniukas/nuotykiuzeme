// We are adding jQuery, cycle2, and the YouTube Iframe API in the Codepen settings. 

$(document).ready(function(){
    $('#slider').cycle({
    fx: 'scrollHorz',
    slides: '.slide',
    timeout: 6000,
    pagerActiveClass: 'active'
   }); 
  });
  
  var player
    function onYouTubeIframeAPIReady() {
      player = new YT.Player('player', {
        events: {
          'onStateChange': onPlayerStateChange,
        }
      });
    }
  
    function onPlayerStateChange(event) {
      if (event.data == YT.PlayerState.PLAYING) {
        $('#slider').cycle('pause');
      }
      if (event.data == YT.PlayerState.ENDED){
        $('#slider').cycle('resume');
      }
    }
    function stopVideo() {
      player.stopVideo();
    }