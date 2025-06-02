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
<!-- Hero Start -->
<!-- Hero Section -->
<div class="hero">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-6 my-4">
                <div class="hero-text">
                    <h1>India’s First Floating Fitness Platform <span style="color: #16B2FD;"> Welcome to GetWetFit</span></h1>
                    <p>
                    </p>
                    <div class="hero-btn">
                        <a class="btn" href="./contact_us.php">Join Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <section class="main-box-container">
                    <div class="main-box1">
                        <div class="box1 i1">

                            
                        </div>
                        <div class="box1 i2">
                            <img src="./assets/images/image1.webp" alt="Yoga 2">
                        </div>
                    </div>
                    <div class="main-box2">
                        <div class="box1 i3">
                            <img src="./assets/images/image14.webp" alt="Yoga 3">
                        </div>
                        <div class="box1 i4">
                            
                        </div>
                    </div>
                    <div class="main-box3">
                        <div class="box1 i5"><img src="./assets/images/image15.webp" alt="Yoga 1"></div>
                        <div class="box1 i6"><img src="./assets/images/image3.webp" alt="Yoga 4"></div>
                    </div>
                    <div class="main-box4 d-none d-md-block ">
                        <div class="box1 i7"></div>
                        <div class="box1 i8"><img src="./assets/images/image8.webp" alt="Yoga 4"></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Online Training -->
<div class="main-online-training-box">
    <div class="online-training1">
        <h6>Flaabh </h6>
        <img src="./assets/images/image1.webp" alt="">
    </div>
    <div class="online-training1">
        <h6>Sound Healing</h6>
        <img src="./assets/images/soundhealing.webp" alt="">
    </div>
    <div class="online-training1">
        <h6>Retreat</h6>
        <img src="./assets/images/comingsoon.webp" alt="">
    </div>
</div>

<!-- photos -->

<div class="training-photos-main-box">
    <div class="training-photos1">
        <img src="./assets/images/image8.webp" alt="">
        <!-- <p>FLAABH SESSION</p> -->
    </div>
    <div class="training-photos2">
        <img src="./assets/images/image4.webp" alt="">
        <!-- <P>FLAABH SESSION</P> -->
    </div>
</div>

<!-- quotes -->


<!-- Quote Section -->
<div class="quote-box container my-5">
  <div class="quote-content text-center p-4 shadow-sm rounded">
    
    <h5 class="quote-text">
    <i class="fa-solid fa-quote-left fa-2x text-secondary mb-3"></i>At GetWetFit, we’re redefining fitness the fun way — over water. As the first of its kind in 
                        India, we’ve created a revolutionary wellness experience that brings together movement, 
                        mindfulness, and water like never before. 
    </h5>
  </div>
</div>

<!-- sessions photos -->

<div class="sessions-photos-mainbox">
    <div class="sessions-photo1">
        <div class="image-container">
            <img src="./assets/images/image6.webp" alt="">
            <p class="image-name">Flaabh sessions</p>
        </div>
    </div>
    <div class="sessions-photo2">
        <div class="image-container">
            <img src="./assets/images/soundhealing.webp" alt="">
            <p class="image-name">Sound Healing experiences</p>
        </div>
    </div>
</div>

<!-- Email Newsletter -->
<!-- <div class="email-newsletter">
    <div class="newsletter-text">
        <h4>JOIN OUR FREE</h4>
        <h4>EMAIL NEWSLETTER</h4>
        <p>Sign up for our newsletter and never miss any offers</p>
    </div>
    <div class="newsletter-form">
        <form>
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe Now</button>
        </form>
    </div>
</div> -->

<!-- Events Calender -->
<?php
include 'includes/calendar/calendar.php';
?>

<!-- Venu Hotel Testimonial Start -->
<?php include 'includes/testinomial/testinomialPhoto.php' ?>
<!-- Testimonial End -->
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
    <img src="./assets/images/image7.webp" alt="Instagram post">
    <img src="./assets/images/image4.webp" alt="Instagram post">
    <img src="./assets/images/image2.webp" alt="Instagram post">
    <img src="./assets/images/image8.webp" alt="Instagram post">
    <img src="./assets/images/image9.webp" alt="Instagram post">
    <img src="./assets/images/image10.webp" alt="Instagram post">
  </div>
</section>




 

<?php
include 'layouts/footer.php';
?>