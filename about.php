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

</style>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>About Us</h2>
            </div>
            <div class="col-12">
                <a href="index.php">Home</a>
                <a href="#">About Us</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- About Section Start -->
<section class="about-section">
    <div class="container">
        
        <div class="d-flex justify-content-center align-items-center gap-2 text-center  my-4">
            <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
            <h4 class="tagline m-0" style="color: #FCFCFC;">About<span style="color:#16B2FD;"> Us</span></h4>
            <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
            
        </div>
        
        <div class="section-header text-center my-4 px-4">
            <h2 class="title text-white">
                India’s First Floating Fitness Platform – Welcome to
                <span class="highlight" style="color: #16B2FD;">GetWetFit</span>
            </h2>
        </div>

        
        <div class="row align-items-center gx-5 gy-5">
            <!-- Text Column -->
            <div class="col-lg-6 slide-in">
                
                <div class="about-content">
                    <p>At <strong>GetWetFit</strong>, we’re redefining fitness the fun way — over water. As India’s first floating fitness platform, we blend movement, mindfulness, and water to create a one-of-a-kind wellness experience.</p>
                    <p><strong>Born out of innovation:</strong> Our founders envisioned a vibrant alternative to monotonous gyms. Why not make fitness dynamic, meditative, and fun — all at once?</p>
                    <p><strong class="highlight">Why Water?</strong><br>Our bodies are 70% water — so why not train with it? Our floating boards challenge your balance, build core strength, and stay gentle on joints.</p>
                    <p><strong class="highlight">Mission:</strong> Burn more, stress less. Fitness should feel like joy — not a chore.</p>
                    <p><strong class="highlight">Vision:</strong> Spark a fitness revolution across India where movement feels like play and wellness flows naturally.</p>
                    <ul class="features">
                        <li>🔥 Higher calorie burn in less time</li>
                        <li>💪 Full-body workouts without monotony</li>
                        <li>🧘 Calm, balance, and renewed energy</li>
                        <li>🌊 A playful, transformative lifestyle shift</li>
                    </ul>
                    <a href="contact.php" class="btn-learn" style="margin-bottom: 4px;">Learn More</a>
                </div>
            </div>
            <!-- Images Column -->
            <div class="col-lg-6">
                <div class="image-grid">
                    <div class="image-box fade-in delay-1">
                        <img src="./assets/images/image1.jpg" alt="Yoga Float 1">
                    </div>
                    <div class="image-box fade-in delay-2">
                        <img src="./assets/images/image6.jpg" alt="Yoga Float 2" style="height:400px;object-fit: cover;">
                    </div>
                    <div class="image-box fade-in delay-3">
                        <img src="./assets/images/image4.jpg" alt="Yoga Float 3">
                    </div>
                    <div class="image-box fade-in delay-3">
                        <img src="./assets/images/image8.jpg" alt="Yoga Float 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Venu Hotel Testimonial Start -->
<?php
include 'includes/testinomial/testinomialPhoto.php';
?>
<!-- Testimonial End -->

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

<?php include 'layouts/footer.php'; ?>
