<?php include 'includes/header.php'; ?>
<br>
<br>
<br>
<main>
  <!-- Contact Hero Section -->
  <section class="contact-hero-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center">
          <h1 class="display-4 fw-bold">Contact Us</h1>
          <div class="separator my-3"></div>
          <p class="lead">Get in touch with the Nairobi Pulse team</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Form Section -->
  <section class="contact-section py-5">
    <div class="container">
      <div class="row g-5">
        <div class="col-md-6">
          <h2 class="mb-4">Send Us a Message</h2>
          
          <form id="contact-form" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
              <div class="invalid-feedback">
                Please provide your name.
              </div>
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <div class="invalid-feedback">
                Please provide a valid email address.
              </div>
            </div>
            
            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <select class="form-select" id="subject" name="subject" required>
                <option value="" selected disabled>Select a subject</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Venue Recommendation">Venue Recommendation</option>
                <option value="Correction/Update">Correction or Update</option>
                <option value="Collaboration">Collaboration Opportunity</option>
                <option value="Other">Other</option>
              </select>
              <div class="invalid-feedback">
                Please select a subject.
              </div>
            </div>
            
            <div class="mb-3">
              <label for="message" class="form-label">Your Message</label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
              <div class="invalid-feedback">
                Please provide your message.
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Send Message</button>
            
            <div id="form-response" class="mt-3 d-none">
              <!-- Response messages will be displayed here -->
            </div>
          </form>
        </div>
        
        <div class="col-md-6">
          <div class="contact-info">
            <h2 class="mb-4">Contact Information</h2>
            
            <div class="info-item mb-4">
              <div class="info-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="info-content">
                <h5>Email Us</h5>
                <p><a href="mailto:info@nairobipulse.com">info@nairobipulse.com</a></p>
              </div>
            </div>
            
            <div class="info-item mb-4">
              <div class="info-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="info-content">
                <h5>Location</h5>
                <p>Nairobi, Kenya</p>
              </div>
            </div>
            
            <div class="info-item mb-4">
              <div class="info-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="info-content">
                <h5>Working Hours</h5>
                <p>Monday-Friday: 9:00 AM - 5:00 PM</p>
                <p>Saturday: 10:00 AM - 2:00 PM</p>
              </div>
            </div>
            
            <div class="social-media mt-5">
              <h5 class="mb-3">Follow Us</h5>
              <div class="social-icons">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row mt-5">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Suggest a Venue</h3>
              <p class="card-text">Know an amazing restaurant, nightlife spot, or notable matatu that should be featured on Nairobi Pulse? Let us know!</p>
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#suggestVenueModal">
                Suggest a Venue
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Suggest Venue Modal -->
<div class="modal fade" id="suggestVenueModal" tabindex="-1" aria-labelledby="suggestVenueModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="suggestVenueModalLabel">Suggest a Venue</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="suggest-venue-form" class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="venue-type" class="form-label">Venue Type</label>
            <select class="form-select" id="venue-type" name="venue-type" required>
              <option value="" selected disabled>Select venue type</option>
              <option value="Restaurant">Restaurant</option>
              <option value="Nightlife">Nightlife Venue</option>
              <option value="Matatu">Matatu</option>
            </select>
            <div class="invalid-feedback">
              Please select a venue type.
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="venue-name" class="form-label">Venue Name</label>
                <input type="text" class="form-control" id="venue-name" name="venue-name" required>
                <div class="invalid-feedback">
                  Please provide the venue name.
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-3">
                <label for="venue-location" class="form-label">Location</label>
                <input type="text" class="form-control" id="venue-location" name="venue-location" required>
                <div class="invalid-feedback">
                  Please provide the venue location.
                </div>
              </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="venue-description" class="form-label">Description</label>
            <textarea class="form-control" id="venue-description" name="venue-description" rows="4" required></textarea>
            <div class="invalid-feedback">
              Please provide a description.
            </div>
          </div>
          
          <div class="mb-3">
            <label for="your-name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="your-name" name="your-name" required>
            <div class="invalid-feedback">
              Please provide your name.
            </div>
          </div>
          
          <div class="mb-3">
            <label for="your-email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="your-email" name="your-email" required>
            <div class="invalid-feedback">
              Please provide a valid email address.
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit-venue-suggestion">Submit Suggestion</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Form validation 
  document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    const suggestionForm = document.getElementById('suggest-venue-form');
    const formResponse = document.getElementById('form-response');
    
    // Contact form validation
    contactForm.addEventListener('submit', function(event) {
      event.preventDefault();
      
      if (!contactForm.checkValidity()) {
        event.stopPropagation();
      } else {
        // Simulate form submission
        formResponse.innerHTML = '<div class="alert alert-success">Thank you for your message! We will get back to you soon.</div>';
        formResponse.classList.remove('d-none');
        contactForm.reset();
      }
      
      contactForm.classList.add('was-validated');
    });
    
    // Venue suggestion submission
    document.getElementById('submit-venue-suggestion').addEventListener('click', function() {
      if (!suggestionForm.checkValidity()) {
        suggestionForm.classList.add('was-validated');
      } else {
        // Simulate form submission
        const modal = bootstrap.Modal.getInstance(document.getElementById('suggestVenueModal'));
        modal.hide();
        
        // Show success message
        formResponse.innerHTML = '<div class="alert alert-success">Thank you for your venue suggestion! Our team will review it shortly.</div>';
        formResponse.classList.remove('d-none');
        suggestionForm.reset();
        suggestionForm.classList.remove('was-validated');
      }
    });
  });
</script>

<?php include 'includes/footer.php'; ?>
