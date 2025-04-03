  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="footer-logo">
            <img src="assets/logo.svg" alt="Nairobi Pulse Logo" class="logo">
            <h4>Nairobi Pulse</h4>
          </div>
          <p>Experience Nairobi like never before with Nairobi Pulse, your digital guide to the city's vibrant culture.</p>
          <div class="social-icons">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        
        <div class="col-md-2">
          <h5>Explore</h5>
          <ul class="footer-links">
            <li><a href="restaurants.php">Restaurants</a></li>
            <li><a href="nightlife.php">Nightlife</a></li>
            <li><a href="matatu.php">Matatu Culture</a></li>
            <li><a href="fun-things.php">Fun Things To Do</a></li>
          </ul>
        </div>
        
        <div class="col-md-2">
          <h5>About</h5>
          <ul class="footer-links">
            <li><a href="about.php">Our Story</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
        
        <div class="col-md-4">
          <h5>Subscribe to Our Newsletter</h5>
          <p>Stay updated with the latest happenings in Nairobi.</p>
          <form class="footer-subscribe">
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Your Email Address" required>
              <button class="btn btn-warning" type="submit">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Nairobi Pulse. All rights reserved. | Developed by <a href="https://dennisnzioki.com/" target="_blank" class="developer-link">Dennis Nzioki</a></p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Animation Libraries -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true
    });
  </script>
  
  <!-- Swiper Slider -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  
  <!-- Main JS -->
  <script src="js/main.js"></script>
  
  <!-- Search JS -->
  <script src="js/search.js"></script>
</body>
</html>
