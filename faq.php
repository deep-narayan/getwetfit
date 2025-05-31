<?php include "layouts/header.php" ?>

<div class="faq">
<div class="container py-5">
  <div class="text-center mb-4 faq-text">
    <h1 class="font-weight-bold">FaQ</h1>
    <p class="text-muted mb-0">Frequently Asked Questions</p>
  </div>

  <div id="accordion" class="faq-accordion">
    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingOne">
        <div class="question-text flex-grow-1">
         1. What happens if I cancel my session?
        </div>
        <button class="toggle-icon btn btn-link  p-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">+</button>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          If you cancel a session due to personal reasons or emergencies, the session will be 
            forfeited. Unfortunately, we do not offer refunds or rescheduling for cancellations 
            made by clients.
        </div>
      </div>
    </div>
    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingTwo">
        <div class="question-text flex-grow-1">
          2. I have a monthly package. Can I carry over unused sessions to the next month?
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">+</button>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          No. Monthly package sessions are valid for 45 days only. Any unused sessions will not 
            roll over beyond that period.
        </div>
      </div>
    </div>
    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingThree">
        <div class="question-text flex-grow-1">
          3. Will I be refunded if GetWetFit™ cancels a session?
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">+</button>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          No. We do not provide refunds for company-initiated cancellations. However, we will 
            offer a rescheduled session after coordinating with you.
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingFour">
        <div class="question-text flex-grow-1">
          4. How will I be informed if a session is canceled?
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">+</button>
      </div>
      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
        <div class="card-body">
          <p>You will be notified via email, SMS, or WhatsApp: </p>
            <p>• At least 1 hour in advance for cancellations due to operational reasons. </p>
            <p>• At least 2 hours in advance for cancellations due to weather or natural events.</p> 
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingFive">
        <div class="question-text flex-grow-1">
          5. What happens if a session is canceled due to bad weather?
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">+</button>
      </div>
      <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
        <div class="card-body">
            We will reschedule your session within 5 to 20 days, based on mutual availability. 
            Refunds are not offered for weather-related cancellations. 
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingSix">
        <div class="question-text flex-grow-1">
          6. Is there a penalty for not showing up to a session?
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">+</button>
      </div>
      <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
        <div class="card-body">
            Yes. If you do not attend a scheduled session without prior notice, it will be marked as a 
            no-show. In such cases, no refund, credit, or reschedule will be provided. 
 
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingSeven">
        <div class="question-text flex-grow-1">
          7. Do I need to know how to swim to join a FLAABH™ session? 
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseThree">+</button>
      </div>
      <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
        <div class="card-body">
            No. Swimming skills are not required. All sessions are conducted with proper safety 
            measures in water using floating equipment, under trained supervision.
 
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingEight">
        <div class="question-text flex-grow-1">
          8. Is there a minimum age requirement?
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseThree">+</button>
      </div>
      <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
        <div class="card-body">
            There is no strict age limit, but participants must have a minimum height of 4.5 feet for 
            safety and equipment suitability. 
 
        </div>
      </div>
    </div>

    <div class="card mb-3 shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center flex-nowrap" id="headingNine">
        <div class="question-text flex-grow-1">
          9. Who can join GetWetFit™ sessions?
        </div>
        <button class="toggle-icon btn btn-link  p-0 collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseThree">+</button>
      </div>
      <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
        <div class="card-body">
            <p>Our FLAABH™—Fitness On Water sessions are open to:</p>
            <p>• Beginners and fitness enthusiasts</p>
            <p>• Adults and children meeting the minimum height 
                    We recommend disclosing any medical conditions during registration so sessions 
                    can be safely customized.</p>
 
        </div>
      </div>
    </div>


  </div>
</div>
</div>


<?php include "layouts/footer.php" ?>


<script>
  $('#accordion').on('hide.bs.collapse show.bs.collapse', function (e) {
    var icon = $(e.target).prev('.card-header').find('.toggle-icon');
    icon.text(e.type === 'show' ? '-' : '+');
  });
</script>
