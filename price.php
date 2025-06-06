<?php
include './layouts/header.php'
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
                <h2>Price</h2>
            </div>
            <div class="col-12">
                <a href="index.php">Home</a>
                <a href="#">Price</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div class="price">
    <div class="container">
        <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
            <p style="color:#FCFCFC;">Flaabh Fit Session</p>
            <h2 style="color:#FCFCFC;">Package Price List</h2>
        </div>
        <div class="row">
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.0s">
                <div class="price-item">
                    <div class="price-header">
                        <div class="price-title">
                            <h2>4 SESSIONS</h2>
                        </div>
                        <div class="price-prices">
                            <h2><small><img src="./assets/images/rupee-indian.png" style="height:16px; filter: brightness(0) invert(1);"></small>6300<span>/-</span></h2>
                        </div>
                    </div>
                    <div class="price-body">
                        <div class="price-description">
                            <ul>
                                <li>4 Sessions</li>
                                <li>45 Days of validity</li>
                            </ul>
                        </div>
                    </div>
                    <div class="price-footer">
                        <div class="price-action">
                            <a class="btn" href="contact_us.php">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="price-item featured-item">
                    <div class="price-header">
                        <div class="price-status">
                            <span>Recommended</span>
                        </div>
                        <div class="price-title">
                            <h2>8 SESSIONS</h2>
                        </div>
                        <div class="price-prices">
                            <h2><small><img src="./assets/images/rupee-indian.png" style="height:16px; filter: invert(31%) sepia(76%) saturate(7141%) hue-rotate(189deg) brightness(96%) contrast(90%);"></small>11880<span>/-</span></h2>
                        </div>
                    </div>
                    <div class="price-body">
                        <div class="price-description">
                            <ul>
                                <li> - 8 Sessions</li>
                                <li> - 60 Days of validity</li>
                            </ul>
                        </div>
                    </div>
                    <div class="price-footer">
                        <div class="price-action">
                            <a class="btn" href="contact_us.php">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.6s">
                <div class="price-item">
                    <div class="price-header">
                        <div class="price-title">
                            <h2>12 SESSIONS</h2>
                        </div>
                        <div class="price-prices">
                            <h2><small><img src="./assets/images/rupee-indian.png" style="height:16px; filter: brightness(0) invert(1);"></small>16740<span>/-</span></h2>
                        </div>
                    </div>
                    <div class="price-body">
                        <div class="price-description">
                            <ul>
                                <li>- 12 Sessions</li>
                                <li> - 75 Days of validity</li>
                            </ul>
                        </div>
                    </div>
                    <div class="price-footer">
                        <div class="price-action">
                            <a class="btn" href="contact_us.php">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4 d-flex flex-column align-items-center p-3" style="background-color: #1a1a1a; border-radius: 8px;">
        <!-- <div style="font-weight: 600; font-size: 16px; color: #16B2FD; margin-bottom: 4px;">T&C</div> -->
        <small style="color: #fcfcfc; display: block; font-size: 14px; max-width: 600px; font-style: italic;">
            <span style="font-weight: 600; color: #16B2FD">T&C</span> : “Please note that prices may vary depending on the location. This is because local costs, taxes, and regulations can differ from one area to another, which can affect the final price you pay.”
        </small>
    </div>

</div>
<!-- Price End -->
<!-- Discount Start -->
<div class="discount wow zoomIn" data-wow-delay="0.1s" style="margin-bottom: 90px;">
    <div class="container">
        <div class="section-header text-center">
            <!-- <p>Awesome Discount</p> -->
            <!-- <h2 style="color: black;">Get <span>30%</span> Discount for all Classes</h2> -->
             <h2 style="color: black;">Planning something special?</h2>
        </div>
        <div class="container discount-text">
            <p>
                 Whether it’s a birthday bash, corporate gathering, personal celebration, or any kind of event — we bring the vibe, you make the memories. Get in touch to craft an unforgettable experience with us.
            </p>
            <a href="contact_us.php" class="btn">Join Now</a>
        </div>
    </div>
</div>
<!-- Discount End -->
<?php
include './layouts/footer.php'
?>