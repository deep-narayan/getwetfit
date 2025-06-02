<?php include 'layouts/header.php'; ?>

<style>
    .rotated-arrow {
        transform: rotate(45deg);
        color: #16B2FD !important;
    }


    /* Optional spacing tweak for larger gaps */
    .gap-2 {
        gap: 0.9rem;
    }




  .media-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
  }

  .media-video {
    width: 100%;
    border-radius: 5px;
  }

  .modal-body .row {
    margin: 0 -8px;
  }

  .modal-body .col-md-6, .modal-body .col-md-4 {
    padding: 8px;
  }


 .portfolio-container {
    max-height: 600px;
    overflow-y: overlay; /* Allows scrolling without shrinking content area */
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.portfolio-container::-webkit-scrollbar {
    display: none;
}

.portfolio-wrap img {
    width: 100%;       /* Makes the image responsive */
    height: 200px;     /* Fixes image height */
    object-fit: cover; /* Maintains aspect ratio, crops if needed */
}

.portfolio-wrap img:hover {
    transform: translateX(0); /* Return to original on hover, optional */
}

/* Default desktop size */
.glightbox-container .gslide-video video,
.glightbox-container .gslide iframe {
  width: 100% !important;
  max-height: 80vh !important;
  object-fit: contain;
}

/* On mobile devices, make video smaller */
@media (max-width: 768px) {
  .glightbox-container .gcontainer {
    width: 90% !important;
    max-width: 300px !important;  /* max width on mobile */
    margin: auto;
  }

  .glightbox-container .gslide-video video,
  .glightbox-container .gslide iframe {
    max-height: 200px !important;  /* smaller height */
  }
}


</style>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Events & Gallery</h2>
            </div>
            <div class="col-12">
                <a href="index.php">Home</a>
                <a href="#">Events & Gallery</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- GALLERY & EVENTS SECTION -->
<section class="gallery-events">
    <div class="container">

        <!-- Events Calendar -->
        <div class="events-calendar fade-in">
            
            <div class="d-flex justify-content-center align-items-center gap-2 text-center  my-4">
                <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
                <h2 class="tagline m-0" style="color: #FCFCFC;">Upcoming<span style="color:#16B2FD;"> Events</span></h2>
                <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
            </div>

            <div class="calendar-filters d-flex flex-wrap gap-4 mb-4 align-items-center">
                <form class="d-flex flex-wrap gap-3 align-items-center">
                    <select class="form-select filter-location">
                        <option value="">Select Location</option>
                        <option value="resort1">Luxury Resort 1</option>
                        <option value="resort2">Luxury Resort 2</option>
                    </select>
                    <select class="form-select filter-type">
                        <option value="">Select Type</option>
                        <option value="fitness">Fitness Classes</option>
                        <option value="healing">Sound Healing</option>
                        <option value="retreat">Retreats</option>
                    </select>
                    <select class="form-select filter-level">
                        <option value="">Select Level</option>
                        <option value="beginner">Beginner</option>
                        <option value="advanced">Advanced</option>
                    </select>
                    <button type="button" class="btn btn-secondary">Filter</button>
                </form>
            </div>


            <div class="calendar row g-4"> <!-- g-4 for gap between cards -->
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image1.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Fit</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time: Slot 1 : 7-8 AM</div>
                    <p class="mb-1">31st May 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image2.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Fit</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time: Slot 1 : 3-4 PM</div>
                    <p class="mb-1">1st June 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image3.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Heal</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time : Slot 1 : 8-9 PM</div>
                    <p class="mb-1">8th June 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image7.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Heal</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time : Slot 2 : 9-10 PM</div>
                    <p class="mb-1">8th June 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>

            <!-- Repeat for others -->
            </div>
            

        </div>

        <!-- Photo & Video Gallery -->
        <div class="container my-5 gallery-section">
            <div class="d-flex justify-content-center align-items-center gap-2 text-center  my-4">
                <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
                <h2 class="tagline m-0" style="color: #FCFCFC;">GALLERY</h2>
                <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
                
            </div>
            <!-- Flaabh Session -->
            <!-- Your Carousel -->
            <div class="portfolio">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul id="portfolio-filter">
                                <li data-filter="*" class="filter-active">All</li>
                                <li data-filter=".flaabh">Flaabh Session</li>
                                <li data-filter=".soundhealing">Sound Healing Session</li>
                                <li data-filter=".third">Retreat Session</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row portfolio-container">
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp" >
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image1.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image1.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image2.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image2.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image3.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image3.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image4.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image4.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image5.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image5.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image6.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image6.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image7.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image7.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image8.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image8.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image9.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image9.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image10.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image10.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image11.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image11.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image12.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image12.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item flaabh wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/image13.jpg" data-lightbox="portfolio">
                                    <img src="./assets/images/image13.jpg" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item soundhealing wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="./assets/images/soundhealing.png" data-lightbox="portfolio">
                                    <img src="./assets/images/soundhealing.png" alt="Portfolio Image">
                                </a>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- Portfolio Start -->
            <div class="video-session-gallery">
                <div class="container">
                    <div class="d-flex justify-content-center align-items-center gap-2 text-center my-4">
                        <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
                        <h4 class="tagline m-0" style="color: #FCFCFC;">Session<span style="color:#16B2FD;"> Videos</span></h4>
                        <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul id="video-filter">
                                <li data-filter="*" class="videofilter-active">All</li>
                                <li data-filter=".flaabh">Flaabh Session</li>
                                <li data-filter=".soundhealing">Sound Healing Session</li>
                                <li data-filter=".third">Retreat Session</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row video-scroll-container">
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video1.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video1.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video12.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video2.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video3.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video3.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video1.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video4.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video4.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video1.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video5.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video5.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video6.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video6.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video7.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video7.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video8.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video8.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video9.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video9.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video10.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video10.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item flaabh">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/video11.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/video11.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item soundhealing">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/soundhealing.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/soundhealing1.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item soundhealing">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/soundhealing.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/soundhealing2.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 video-session-item soundhealing">
                            <div class="video-session-wrap position-relative">
                                <!-- Background image (optional) -->
                                <img src="./assets/thumbnail/soundhealing.png" alt="Video Thumbnail" class="thumbnail">

                                <!-- Glightbox trigger -->
                                <a href="./assets/videos/soundhealing3.mp4" class="glightbox d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 start-0" data-type="video">
                                    <i class="fa fa-play-circle fa-3x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Repeat blocks as needed -->
                    </div>
                </div>
            </div>





        <!-- Event Highlights -->
        <div class="events-calendar fade-in">
            
            <div class="d-flex justify-content-center align-items-center gap-2 text-center  my-4">
                <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
                <h4 class="tagline m-0" style="color: #FCFCFC;">Events<span style="color:#16B2FD;"> Highlight</span></h4>
                <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
                
            </div>

            <div class="calendar row g-4"> <!-- g-4 for gap between cards -->
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image1.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Fit</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time: Slot 1 : 7-8 AM</div>
                    <p class="mb-1">31st May 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image2.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Fit</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time: Slot 1 : 3-4 PM</div>
                    <p class="mb-1">1st June 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image3.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Heal</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time : Slot 1 : 8-9 PM</div>
                    <p class="mb-1">8th June 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div><img src="./assets/images/image7.jpg" alt="" class="img-fluid mb-2"></div>
                    <h6>FLAABH™ Heal</h6>
                    <!-- <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci iusto delectus illo.</p> -->
                    <div class="event-date">Time : Slot 2 : 9-10 PM</div>
                    <p class="mb-1">8th June 2025</p>
                    <p class="mb-1">Contact: 9582384888</p>
                    <p class="mb-0">Location: Crowne Plaza Rohini.</p>
                    <hr>
                </div>

            <!-- Repeat for others -->
            </div>

        <!-- Events Calender -->

        <?php
            include 'includes/calendar/calendar.php';
        ?>


        <!-- Special Events -->

        <div class="container special-events mt-5 zoom-in">
            <div class="d-flex justify-content-center align-items-center gap-2 text-center  my-4">
                <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
                <h4 class="tagline m-0" style="color: #FCFCFC;">Upcoming Special<span style="color:#16B2FD;"> Events</span></h4>
                <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
                
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow p-4 border-0 special-event-card h-100">
                        <img src="./assets/images/image6.jpg" alt="">
                        <h3 class="card-title">GetWetFit FLAABH™ Fit - Crowne Plaza Rohini</h3>
                        <p class="event-date text-muted">31st May 2025, Slot 1 : 7-8 AM</p>
                        <!-- <p class="card-text">
                            1-day wellness retreat with fitness, healing, and food.
                        </p> -->
                        <button class="btn btn-primary w-100 mt-auto">Register Now</button>
                    </div>
                </div>

                <!-- You can add more cards like this -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow p-4 border-0 special-event-card h-100">
                        <img src="./assets/images/image7.jpg" alt="">
                        <h3 class="card-title">GetWetFit FLAABH™ Fit - Crowne Plaza Rohini</h3>
                        <p class="event-date text-muted">1st June 2025, Slot 1 : 3-4 PM</p>
                        <!-- <p class="card-text">
                            Morning yoga session with sea breeze and guided meditation.
                        </p> -->
                        <button class="btn btn-primary w-100 mt-auto">Register Now</button>
                    </div>
                </div>
                <!-- You can add more cards like this -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow p-4 border-0 special-event-card h-100">
                        <img src="./assets/images/image9.jpg" alt="">
                        <h3 class="card-title">GetWetFit FLAABH™ Fit - Crowne Plaza Rohini</h3>
                        <p class="event-date text-muted">8th June 2025, Slot 1 : 8-9 PM , Slot 2 : 9-10 PM</p>
                        <!-- <p class="card-text">
                            Morning yoga session with sea breeze and guided meditation.
                        </p> -->
                        <button class="btn btn-primary w-100 mt-auto">Register Now</button>
                    </div>
                </div>
                <!-- You can add more cards like this -->
            </div>
        </div>


        <!-- RSVP
        <div class="rsvp-buttons mt-5 d-flex flex-wrap gap-3 justify-content-center fade-in">
            <button class="btn btn-outline-primary">Book a Class</button>
            <button class="btn btn-outline-success">Join a Retreat</button>
            <button class="btn btn-outline-dark">Inquire via WhatsApp</button>
        </div> -->

    </div>
</section>

<?php include 'layouts/footer.php'; ?>
