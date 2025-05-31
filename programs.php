<?php 
include 'layouts/header.php';
?>
<style>
    .rotated-arrow {
        transform: rotate(45deg);
        color: #16B2FD !important;
    }


    /* Optional spacing tweak for larger gaps */
    .gap-2 {
        gap: 0.9rem;
    }

</style>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Our Signature Programs</h2>
            </div>
            <div class="col-12">
                <a href="index.php">Home</a>
                <a href="#">Our Signature Programs</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
<!-- Signature Programs Section Start -->
<section class="signature-programs">
    <div class="container">

        <div class="d-flex justify-content-center align-items-center gap-2 text-center  my-4">
            <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
            <h4 class="tagline m-0" style="color: #FCFCFC;">Our Signature<span style="color:#16B2FD;"> Programs</span></h4>
            <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
            
        </div>
        <div class="section-header text-center my-4 px-4">
            <h2 class="title text-white">
                Fitness, Mindfulness & Fun — 
                <span class="highlight" style="color: #16B2FD;">All on Water</span>
            </h2>
        </div>

        <!-- Program 1: Flaabh -->
        <div class="program-card wow fadeInLeft">
            <div class="program-image">
                <img src="./assets/images/image1.jpg" alt="Flaabh Program" class="img-fluid">
            </div>
            <div class="program-details">
                <h3 class="program-title">1. Flaabh – Fitness Over Water</h3>
                <p class="program-description">
                    Get ready to defy gravity and redefine your workout with Flaabh, our flagship high-energy fitness program on floating boards.
                    Flaabh is a full-body, core-engaging session that blends cardio, strength, and endurance — all while balancing on water.
                </p>
                <div class="program-benefits">
                    <div class="benefit">
                        <i class="fas fa-fire"></i>
                        <p>Burn more calories in less time</p>
                    </div>
                    <div class="benefit">
                        <i class="fas fa-balance-scale"></i>
                        <p>Improve balance, flexibility, and core strength</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Program 2: Sound Healing -->
        <div class="program-card wow fadeInRight">
            <div class="program-details">
                <h3 class="program-title">2. Sound Healing – Meditative Calm on Water</h3>
                <p class="program-description">
                    Float into deep relaxation with our Sound Healing sessions, combining ancient healing frequencies and the gentle sway of water
                    to bring your mind and body into complete harmony.
                </p>
                <div class="program-benefits">
                    <div class="benefit">
                        <i class="fas fa-heartbeat"></i>
                        <p>Reduces stress and anxiety</p>
                    </div>
                    <div class="benefit">
                        <i class="fas fa-brain"></i>
                        <p>Enhances mental clarity and balance</p>
                    </div>
                </div>
            </div>
            <div class="program-image">
                <img src="./assets/images/soundhealing.png" alt="Sound Healing Program" class="img-fluid">
            </div>
        </div>

        <!-- Program 3: Retreat Programs -->
        <div class="program-card wow fadeInLeft">
            <div class="program-image">
                <img src="./assets/images/comingsoon.png" alt="Retreat Programs" class="img-fluid" style="object-fit:content;">
            </div>
            <div class="program-details">
                <h3 class="program-title">3. Retreat Programs – The Ultimate Wellness Experience</h3>
                <p class="program-description">
                    Embark on a transformative wellness journey with our GetWetFit Retreats, combining fitness, sound healing, and nourishing food
                    to give you the ultimate escape.
                </p>
                <div class="program-benefits">
                    <div class="benefit">
                        <i class="fas fa-water"></i>
                        <p>Fitness sessions over water</p>
                    </div>
                    <div class="benefit">
                        <i class="fas fa-spa"></i>
                        <p>Floating meditation and sound healing</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Signature Programs Section End -->

<!-- Testimonial Start -->
<?php
include 'includes/testinomial/testinomialText.php';
?>
<!-- Testimonial End -->
<!-- Video Testimonial Start -->
<?php
include 'includes/testinomial/testinomialVideo.php';
?>
<!-- Testimonial End -->

<!-- Follow us on Instagram -->
<section class="instagram-section">
  <h1 class="section-title">Follow Us On <span>Instagram</span></h1>
  <div class="instagram-gallery">
    <img src="./assets/images/image7.jpg" alt="Instagram post">
    <img src="./assets/images/image4.jpg" alt="Instagram post">
    <img src="./assets/images/image2.jpg" alt="Instagram post">
    <img src="./assets/images/image8.jpg" alt="Instagram post">
    <img src="./assets/images/image9.jpg" alt="Instagram post">
    <img src="./assets/images/image10.jpg" alt="Instagram post">
  </div>
</section>
<?php
include 'layouts/footer.php'
?>