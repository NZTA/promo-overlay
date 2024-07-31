(() => {

  document.addEventListener('DOMContentLoaded', () => {
    let apiScript = document.createElement('script');

    // create script tag to load in youtube api
    apiScript.src = 'https://www.youtube.com/iframe_api';

    let firstScriptTag = document.getElementsByTagName('script')[0];

    // add youtube iframe api javascript to page
    if (firstScriptTag) {
      firstScriptTag.parentNode.insertBefore(apiScript, firstScriptTag);
    }

    // setup youtube player references so we can trigger events as required
    let fullscreenWrapper = document.querySelector('.promooverlay__fullscreen-video');
    let backgroundPlayer = null;
    let fullscreenPlayer = null;

    /**
     * Setup the currently active slide to play the background video if
     * applicable.
     *
     * @return {void}
     */
    const playBackgroundVideo = () => {
      let activeSlide = document.querySelector('.promooverlay__slide--active');

      // can stop here if no background video to play
      if (!activeSlide || !activeSlide.classList.contains('promooverlay__slide--video')) {
        return;
      }

      let videoId = activeSlide.getAttribute('data-video');
      backgroundPlayer = new YT.Player('promooverlay-backgroundplayer', {
        videoId: videoId,
        playerVars: {
          autoplay: 1,
          playlist: videoId,
          controls: 0,
          modestbranding: 1,
          loop: 1,
          rel: 0,
          showinfo: 0
        },
        events: {
          'onReady': 'onPlayerReady'
        }
      });
    }

    /**
     * Play the currently active slides fullscreen video if applicable.
     *
     * @return {void}
     */
    const playFullscreenVideo = () => {
      let activeSlide = document.querySelector('.promooverlay__slide--active');

      // can stop here if no active slide or no fullscreen video wrapper
      if (!activeSlide || !fullscreenWrapper) {
        return;
      }

      let playButton = activeSlide.querySelector('.promooverlay__slide-play');

      // can stop here if no play button available
      if (!playButton) {
        return;
      }

      let videoId = playButton.getAttribute('data-video-id');

      // check video id available
      if (!videoId) {
        return;
      }

      fullscreenPlayer = new YT.Player('promooverlay-fullscreenplayer', {
        videoId: videoId,
        playerVars: {
          autoplay: 1,
          controls: 0,
          modestbranding: 1,
          loop: 0,
          rel: 0,
          showinfo: 0
        }
      });

      // bring fullscreen video to the foreground
      fullscreenWrapper.classList.add('active');
    }

    /**
     * Close the currently active fullscreen video.
     *
     * @return {void}
     */
    const closeFullscrenVideo = () => {
      // close the fullscreen overlay
      fullscreenWrapper.classList.remove('active');

      // destroy the current player so it doesn't continue playing in the background
      fullscreenPlayer.destroy();
    }

    /**
     * This is called when the youtube iframe api has loaded so needs to be
     * globally available. This sets up the initial background video if
     * applicable.
     *
     * @return {void}
     */
    window.onYouTubeIframeAPIReady = () => {
      playBackgroundVideo();
    }

    /**
     * This is called when the background youtube player is ready to play, so
     * needs to be globally available. This is used to mute the background video
     * when it starts playing.
     *
     * @param {Event} event
     *
     * @return {void}
     */
    window.onPlayerReady = (event) => {
      event.target.mute();
    }

    // setup play buttons and the fullscreen close video button events

    let playButtons = document.querySelectorAll('.promooverlay__slide-play');
    let fullscreenClose = document.querySelector('.promooverlay__close-fullscreen');

    // can stop here if no play buttons to activate or close button not available to close fullscreen
    if (playButtons.length === 0 || !fullscreenClose) {
      return;
    }

    // setup each play button to play fullscreen video when clicked
    for (let i = 0; i < playButtons.length; i++) {
      let button = playButtons[i];

      button.addEventListener('click', (e) => {
        e.preventDefault();

        playFullscreenVideo();
      });
    }

    // setup fullscreen close button event handler
    fullscreenClose.addEventListener('click', (e) => {
      e.preventDefault();

      closeFullscrenVideo();
    });
  });

})();
