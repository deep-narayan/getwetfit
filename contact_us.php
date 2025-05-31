<?php
include 'layouts/header.php';

if(isset($_POST['submit'])){

  $name = $_POST['fullname'];
  $number = $_POST['contact'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $height = $_POST['height'];
  $swim = $_POST['swim'];
  $join = $_POST['join'];
  $address = $_POST['address'];
  $message = $_POST['message'];
}

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
                <h2>Contact Us</h2>
            </div>
            <div class="col-12">
                <a href="index.php">Home</a>
                <a href="#">Contact Us</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div class="contact-container">
  <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
      <p>Get In Touch</p>
      <h2>For Any Query</h2>
  </div>
  <div class="col-12">
    <div class="row">
      <div class="col-md-4 contact-item wow zoomIn" data-wow-delay="0.2s">
        <i class="fa fa-map-marker-alt"></i>
        <div class="contact-text">
          <h2>Location</h2>
          <p>22-A, 2nd Floor, Asaf Ali Road, Delhi - 110002</p>
        </div>
      </div>
      <div class="col-md-4 contact-item wow zoomIn" data-wow-delay="0.4s">
        <i class="fa fa-phone-alt"></i>
        <div class="contact-text">
          <h2>Phone</h2>
          <p>9582384888</p>
        </div>
      </div>
      <div class="col-md-4 contact-item wow zoomIn" data-wow-delay="0.6s">
        <i class="far fa-envelope"></i>
        <div class="contact-text">
            <h2>Email</h2>
            <p>hello@getwetfit.com</p>
        </div>
      </div>
    </div>
  </div>
  <form action="contact_us.php" method="POST">
    <div class="form-group row">
      <div class="col-md-6">
        <label for="fullName">Full Name *</label>
        <input type="text" name="fullname" id="fullName" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label for="phone">Phone Number *</label>
        <input type="tel" name="contact" id="phone" class="form-control" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-6">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
      <div class="col-md-6">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" class="form-control">
      </div>
    </div>

    <div class="form-group">
      <label>Gender</label>
      <div class="form-check form-check-inline">
        <input type="radio" name="gender" value="Male" class="form-check-input">
        <label class="form-check-label">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input type="radio" name="gender" value="Female" class="form-check-input">
        <label class="form-check-label">Female</label>
      </div>
      <div class="form-check form-check-inline">
        <input type="radio" name="gender" value="Non-binary" class="form-check-input">
        <label class="form-check-label">Non-binary</label>
      </div>
      <div class="form-check form-check-inline">
        <input type="radio" name="gender" value="Prefer not to say" class="form-check-input">
        <label class="form-check-label">Prefer not to say</label>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-6">
        <label for="height">Height</label>
        <input type="text" name="height" id="height" class="form-control" placeholder="e.g. 170 cm or 5'7">
      </div>
      <div class="col-md-6">
        <label for="swimming">Do you know how to swim?</label>
        <select id="swimming" name="swim" class="form-control">
          <option value="">Select</option>
          <option>Yes</option>
          <option>No</option>
          <option>Somewhat</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="join-as">Join us as:</label>
      <select id="join-as" class="form-control multi-select-placeholder" name="join[]" multiple="multiple">
        <option value="Customer">Customer</option>
        <option value="Venue Partner">Venue Partner</option>
        <option value="Trainer">Trainer</option>
        <option value="Employee">Employee</option>
        <option value="Collaboration Partner">Collaboration Partner</option>
      </select>
    </div>


    <div class="form-group">
      <label for="location">Location / Address</label>
      <input type="text" name="address" id="location" class="form-control">
    </div>

    <div class="form-group">
      <label for="message">Any other queries or message?</label>
      <textarea id="message" name="message" class="form-control"></textarea>
    </div>

    <div class="form-group text-center">
      <button type="submit" name="submit" class="btn custom-btn" id="submitBtn">Submit</button>
    </div>
  </form>
</div>

<script>
  document.getElementById('submitBtn').addEventListener('click', function () {
    this.classList.add('submitted');
    this.innerText = 'Submitted';
  });
</script>


<?php
include 'layouts/footer.php'
?>