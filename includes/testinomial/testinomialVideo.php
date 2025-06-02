<!-- Session Review Section -->
<div class="testimonial wow fadeInUp" data-wow-delay="0.1s">
  <div class="d-flex justify-content-center align-items-center gap-2 text-center my-4">
    <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
    <h4 class="tagline m-0" style="color: #FCFCFC;">Session<span style="color:#16B2FD;"> Review</span></h4>
    <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
  </div>

  <div class="container">
    <div class="owl-carousel testimonials-carousel">
      <!-- YouTube Thumbnails with Data IDs -->
      <div class="testimonial-text">
        <div class="youtube-thumbnail" data-video-id="XbXt0H_wtDo">
          <img src="https://img.youtube.com/vi/XbXt0H_wtDo/hqdefault.jpg" alt="Session 1" class="img-fluid" style="cursor: pointer;">
          <div class="play-button"></div>
        </div>
      </div>
      <div class="testimonial-text">
        <div class="youtube-thumbnail" data-video-id="XbXt0H_wtDo">
          <img src="https://img.youtube.com/vi/XbXt0H_wtDo/hqdefault.jpg" alt="Session 1" class="img-fluid" style="cursor: pointer;">
          <div class="play-button"></div>
        </div>
      </div>
      <!-- Add more videos similarly -->
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0 position-relative">
        <button id="closeBtn" class="close text-white" aria-label="Close"
          style="position: absolute; top: 10px; right: 15px; z-index: 10; font-size: 2rem;">
          <span aria-hidden="true">&times;</span>
        </button>
        <div style="position:relative; width:100%; padding-bottom:56.25%;">
          <iframe id="popupIframe" style="position:absolute; top:0; left:0; width:100%; height:100%;" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CSS for Play Button Overlay -->
<style>
  .youtube-thumbnail {
    position: relative;
    display: inline-block;
  }

  .youtube-thumbnail .play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 64px;
    height: 64px;
    background: url('https://img.icons8.com/ios-filled/100/ffffff/play--v1.png') no-repeat center;
    background-size: 64px;
    pointer-events: none;
  }
</style>

<!-- JavaScript -->
<script>
  const thumbnails = document.querySelectorAll('.youtube-thumbnail');
  const popupIframe = document.getElementById('popupIframe');
  const videoModal = document.getElementById('videoModal');
  const closeBtn = document.getElementById('closeBtn');

  thumbnails.forEach(thumb => {
    thumb.addEventListener('click', () => {
      const videoId = thumb.getAttribute('data-video-id');
      popupIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
      $('#videoModal').modal('show');
    });
  });

  closeBtn.addEventListener('click', () => $('#videoModal').modal('hide'));

  videoModal.addEventListener('hidden.bs.modal', () => {
    popupIframe.src = '';
  });
</script>
