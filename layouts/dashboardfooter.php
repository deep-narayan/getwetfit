
    </div>

    
  </div>

  <!-- Scripts -->
  <script>
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    let menuOpen = false;

    menuToggle.addEventListener('click', () => {
      menuOpen = !menuOpen;
      mobileMenu.classList.toggle('show', menuOpen);
      mobileMenu.classList.toggle('hide', !menuOpen);
      menuToggle.innerHTML = menuOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
    });
    

    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
            mobileMenu.classList.remove("show");
            mobileMenu.classList.add("hide");
            menuOpen = false;
            menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
        }
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>