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

    .on-water-benefits img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }
    .on-water-benefits img:hover {
        transform: scale(1.02);
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
                        <img src="./assets/images/image1.webp" alt="Yoga Float 1">
                    </div>
                    <div class="image-box fade-in delay-2">
                        <img src="./assets/images/image6.webp" alt="Yoga Float 2" style="height:400px;object-fit: cover;">
                    </div>
                    <div class="image-box fade-in delay-3">
                        <img src="./assets/images/image4.webp" alt="Yoga Float 3">
                    </div>
                    <div class="image-box fade-in delay-3">
                        <img src="./assets/images/image8.webp" alt="Yoga Float 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Benefits Section Zig-Zag Start -->
<section class="on-water-benefits py-5" style="background-color: #000;">
  <div class="container text-white">
    <div class="text-center mb-5">
      <h2 class="text-white">💦 Why Fitness On Water Works for Everyone</h2>
      <p class="lead">At <strong>GetWetFit & Co</strong>, our floating fitness sessions—on SUP boards in pools—are designed for all fitness levels, all goals.</p>
    </div>

    <!-- Row 1 -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <h4 class="text-info">🧘‍♀ For Beginners & Weight Loss Seekers</h4>
        <blockquote>“I want to lose weight, but gyms bore me and I can’t stay consistent…”</blockquote>
        <ul>
          <li><strong>Low-impact, high-burn:</strong> Gentle on joints, great on fat burn.</li>
          <li><strong>Fun & feel-good:</strong> Every session is a pool party with purpose.</li>
          <li><strong>No gym anxiety:</strong> Just balance, movement, and calm.</li>
          <li><strong>Boosted confidence:</strong> Feel great without feeling judged.</li>
        </ul>
        <p class="text-success font-weight-bold">✅ Fitness meets therapy, with real results.</p>
      </div>
      <div class="col-md-6">
        <img src="./assets/images/image9.webp" alt="Beginner on water" class="img-fluid rounded shadow">
      </div>
    </div>

    <!-- Row 2 -->
    <div class="row align-items-center mb-5 flex-md-row-reverse">
      <div class="col-md-6">
        <h4 class="text-info">🏋‍♂ For Regular Fitness Enthusiasts</h4>
        <blockquote>“I already work out, but I want to try something different…”</blockquote>
        <ul>
          <li><strong>New muscle engagement:</strong> Core and stabilizers fire constantly.</li>
          <li><strong>Mind-body connection:</strong> Strength with presence.</li>
          <li><strong>Cross-training:</strong> Perfect complement for lifting, yoga, or running.</li>
          <li><strong>Active recovery:</strong> Decrease inflammation, increase flow.</li>
        </ul>
        <p class="text-success font-weight-bold">✅ Level up your routine with an innovative challenge.</p>
      </div>
      <div class="col-md-6">
        <img src="./assets/images/image6.webp" alt="Regular fitness on board" class="img-fluid rounded shadow" style="height:400px; object-fit:cover;">
      </div>
    </div>

    <!-- Row 3 -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <h4 class="text-info">🧗‍♀ For Fitness Freaks & Wellness Explorers</h4>
        <blockquote>“I’m always chasing the next big thing in fitness…”</blockquote>
        <ul>
          <li><strong>Science-backed hybrid:</strong> Yoga, HIIT, and Pilates on water.</li>
          <li><strong>Instagrammable:</strong> Scenic, luxe, photogenic sessions.</li>
          <li><strong>Adrenaline + balance:</strong> Thrill and focus combined.</li>
          <li><strong>Premium feel:</strong> It’s a workout—and a vibe.</li>
        </ul>
        <p class="text-success font-weight-bold">✅ Push boundaries, build balance, and feel fierce.</p>
      </div>
      <div class="col-md-6">
        <img src="./assets/images/image4.webp" alt="Wellness explorer" class="img-fluid rounded shadow">
      </div>
    </div>

    <!-- Row 4 -->
    <div class="row align-items-center mb-5 flex-md-row-reverse">
      <div class="col-md-6">
        <h4 class="text-info">🏊‍♂ For Athletes & High-Performance Trainers</h4>
        <blockquote>“I need cross-training that improves my game, not slows me down…”</blockquote>
        <ul>
          <li><strong>Stability training:</strong> Improves core and reflexes.</li>
          <li><strong>Reduce injury risk:</strong> Safer conditioning.</li>
          <li><strong>Better breath control:</strong> Water = lung power boost.</li>
          <li><strong>Train smart:</strong> Brain and body synergy.</li>
        </ul>
        <p class="text-success font-weight-bold">✅ Recovery meets performance in the most advanced way possible.</p>
      </div>
      <div class="col-md-6">
        <img src="./assets/images/image8.webp" alt="Athlete training" class="img-fluid rounded shadow">
      </div>
    </div>

    <!-- Final Callout -->
    <div class="text-center mt-5">
      <h4 class="text-white">🌟 It’s not just a workout. It’s a lifestyle.</h4>
      <p class="lead">No treadmills. No mirrors. No excuses.<br>Just the sound of water and a challenge under your feet.</p>
      <a href="contact_us.php" class="btn btn-outline-info btn-lg mt-3">👉 Join the Fitness Wave</a>
    </div>
  </div>
</section>
<!-- Benefits Section Zig-Zag End -->

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
    <img src="./assets/images/image7.webp" alt="Instagram post">
    <img src="./assets/images/image4.webp" alt="Instagram post">
    <img src="./assets/images/image2.webp" alt="Instagram post">
    <img src="./assets/images/image8.webp" alt="Instagram post">
    <img src="./assets/images/image9.webp" alt="Instagram post">
    <img src="./assets/images/image10.webp" alt="Instagram post">
  </div>
</section>

<?php include 'layouts/footer.php'; ?>
