<div class="testimonial wow fadeInUp" data-wow-delay="0.1s">
    <div class="d-flex justify-content-center align-items-center gap-2 text-center  my-4">
        <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
        <h4 class="tagline m-0" style="color: #FCFCFC;">Session<span style="color:#16B2FD;"> Review</span></h4>
        <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
        
    </div>
    <div class="container">
        <div class="owl-carousel testimonials-carousel">
            <!-- Video Gallery -->
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video1.mp4" muted preload="none" poster="./assets/thumbnail/video1.png"  style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video2.mp4" muted preload="none" poster="./assets/thumbnail/video2.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video3.mp4" muted preload="none" poster="./assets/thumbnail/video3.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video4.mp4" muted preload="none" poster="./assets/thumbnail/video4.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video5.mp4" muted preload="none" poster="./assets/thumbnail/video5.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video6.mp4" muted preload="none" poster="./assets/thumbnail/video6.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video7.mp4" muted preload="none" poster="./assets/thumbnail/video7.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video8.mp4" muted preload="none" poster="./assets/thumbnail/video8.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video9.mp4" muted preload="none" poster="./assets/thumbnail/video9.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video10.mp4" muted preload="none" poster="./assets/thumbnail/video10.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video11.mp4" muted preload="none" poster="./assets/thumbnail/video11.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <div class="testimonial-text">
                <video class="video-trigger img-fluid" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="./assets/videos/video12.mp4" muted preload="none" poster="./assets/thumbnail/video12.png" style="width: 400px; height: 400px; object-fit: contain;"></video>
            </div>
            <!-- Add more videos similarly -->
        </div>
    </div>
</div>


<!-- Modal for Video Playback -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0 position-relative">
        <button id="closeBtn" class="close text-white" aria-label="Close"
            style="position: absolute; top: 10px; right: 15px; z-index: 10; font-size: 2rem;">
            <span aria-hidden="true">&times;</span>
        </button>

        <video id="popupVideo" class="w-100" controls autoplay
          style="max-height: 80vh; object-fit: contain;">
          <source src="" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
  </div>
</div>



<script>
  const videoTriggers = document.querySelectorAll('.video-trigger');
  const popupVideo = document.getElementById('popupVideo');
  const videoModal = document.getElementById('videoModal');
  const closeBtn = document.getElementById('closeBtn');
  const videoSource = popupVideo.querySelector('source');

  // Show video modal and play selected video
  videoTriggers.forEach(trigger => {
    trigger.addEventListener('click', function () {
      const videoSrc = this.getAttribute('data-video');
      videoSource.src = videoSrc;
      popupVideo.load();
    });
  });

    closeBtn.addEventListener('click', function () {
        $('#videoModal').modal('hide');
    });

  videoModal.addEventListener('hidden.bs.modal', function () {
  popupVideo.pause();
  popupVideo.currentTime = 0;
  videoSource.src = '';
  popupVideo.load();
});
</script>