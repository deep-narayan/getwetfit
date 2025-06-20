
  <!-- Footer -->
  <!-- <footer>
    &copy; 2025 GetWetFit. All rights reserved.
  </footer> -->

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    const sidebar = $('#sidebar');
    const toggleBtn = $('#toggleSidebar');
    const icon = $('#sidebarIcon');

    toggleBtn.on('click', function () {
      sidebar.toggleClass('active');
      icon.toggleClass('fa-bars fa-times');
    });

    $(document).on('click touchstart', function (e) {
      if ($(window).width() < 768) {
        if (!$(e.target).closest('#sidebar, #toggleSidebar').length) {
          if (sidebar.hasClass('active')) {
            sidebar.removeClass('active');
            icon.removeClass('fa-times').addClass('fa-bars');
          }
        }
      }
    });
  </script>
<script>
  const bell = document.getElementById("notificationToggle");
  const dropdown = document.getElementById("notificationDropdown");

  bell.addEventListener("click", function (e) {
    e.preventDefault();
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
  });

  // Hide dropdown on outside click
  document.addEventListener("click", function (e) {
    if (!bell.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = "none";
    }
  });
</script>
<script>
  const profile = document.getElementById("profileToggle");
  const profiledropdown = document.getElementById("profileDropDown");

  profile.addEventListener("click", function (e) {
    e.preventDefault();
    profiledropdown.style.display = profiledropdown.style.display === "block" ? "none" : "block";
  });

  // Hide dropdown on outside click
  document.addEventListener("click", function (e) {
    if (!profile.contains(e.target) && !profiledropdown.contains(e.target)) {
      profiledropdown.style.display = "none";
    }
  });
</script>

</body>
</html>
