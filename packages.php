<?php
include "./layouts/dashboardheader.php";
?>

<style>
body {
  background-color: #0f0f0f;
  color: #fff;
  font-family: 'Segoe UI', sans-serif;
  overflow-x: hidden;
}

.pricing-3d {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2rem;
  padding: 80px 0;
  perspective: 1500px;
  background: linear-gradient(rgba(15, 15, 15, 0.8), rgba(15, 15, 15, 0.8)), url('./assets/images/image8.webp') no-repeat center center/cover;
}


.card-3d {
  width: 280px;
  padding: 2rem;
  border-radius: 20px;
  background:rgb(0, 0, 0);
  color: #fff;
  box-shadow: 0 0 20px #fcfcfc;
  transition: transform 0.5s ease, box-shadow 0.5s ease;
  position: relative;
  z-index: 1;
}

.card-3d h3 {
  font-size: 1.4rem;
  margin-bottom: 0.5rem;
  color: #16B2FD;
}

.card-3d h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.card-3d ul {
  padding: 0;
  list-style: none;
  margin-bottom: 1rem;
}

.card-3d ul li {
  margin: 8px 0;
  font-size: 0.95rem;
}

.card-3d .btn {
  background: #16B2FD;
  padding: 0.5rem 1.3rem;
  color: #fff;
  border-radius: 30px;
  text-decoration: none;
  font-weight: bold;
  display: inline-block;
  margin-top: 1rem;
  transition: 0.3s ease;
}

.card-3d .btn:hover {
  background: #0f0c29;
  box-shadow: 0 0 10px #16B2FD;
}

.left-card {
  transform: rotateY(15deg) scale(0.9);
  opacity: 0.7;
  z-index: 0;
}

.center-card {
  transform: scale(1.05);
  box-shadow: 0 0 25px rgba(22, 178, 253, 0.6);
  z-index: 2;
}

.right-card {
  transform: rotateY(-15deg) scale(0.9);
  opacity: 0.7;
  z-index: 0;
}

@media (max-width: 768px) {
  .pricing-3d {
    flex-direction: column;
  }

  .left-card,
  .right-card,
  .center-card {
    transform: none;
    opacity: 1;
    scale: 1;
    margin-bottom: 1.5rem;
  }
}
</style>
<main id="content">
<nav aria-label="breadcrumb" class="mt-5">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="main.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Packages</li>
    </ol>
</nav>

<div class="text-center mb-5">
  <h2 style="color: #16B2FD; font-size: 2.5rem;">Choose Your Plan</h2>
  <p style="color: #ccc;">Flexible options that fit your fitness goals</p>
</div>

<div class="pricing-3d">
  <!-- Left Card -->
  <div class="card-3d left-card">
    <h3>4 Sessions</h3>
    <h2>₹6300</h2>
    <ul>
      <li>45 Days Validity</li>
      <li>Quick Start</li>
    </ul>
    <a href="#" class="btn">Join Now</a>
  </div>

  <!-- Center Card (Popular Plan) -->
  <div class="card-3d center-card">
    <div style="text-align: center; margin-bottom: 10px;">
      <span style="background: #16B2FD; color: #fff; padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 0.85rem;">Recommended</span>
    </div>
    <h3>8 Sessions</h3>
    <h2>
      <img src="./assets/images/rupee-indian.png" style="height:16px; margin-right: 4px; filter: invert(31%) sepia(76%) saturate(7141%) hue-rotate(189deg) brightness(96%) contrast(90%);">
      11880<span>/-</span>
    </h2>
    <ul>
      <li>60 Days Validity</li>
      <li>Flexible Scheduling</li>
      <li>Great for Consistency</li>
    </ul>
    <a href="#" class="btn" style="background: linear-gradient(90deg, #16B2FD, #0f0c29);">Join Now</a>
  </div>

  <!-- Right Card -->
  <div class="card-3d right-card">
    <h3>12 Sessions</h3>
    <h2>₹16740</h2>
    <ul>
      <li>75 Days Validity</li>
      <li>Best Value</li>
    </ul>
    <a href="#" class="btn">Join Now</a>
  </div>
</div>




<?php
include "./layouts/dashboardfooter.php";
?>