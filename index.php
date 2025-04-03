<?php
  include 'includes/header.php';
  include 'includes/db.php';
  
  // Get featured items from each category
  $featuredRestaurants = array_slice(getRestaurants(), 0, 3);
  $featuredNightlife = array_slice(getNightlifeVenues(), 0, 3);
  $featuredMatatu = array_slice(getMatatuCulture(), 0, 3);
  $featuredAttractions = array_slice(getAttractions(), 0, 3);
  $upcomingEvents = array_slice(getEvents(), 0, 3);
?>

<main>
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1 class="display-4 fw-bold text-white">Experience <span class="text-warning">Nairobi</span> like never before</h1>
          <p class="lead text-light">Discover the vibrant restaurant scene, electrifying nightlife, and iconic matatu culture of Kenya's capital.</p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="#explore" class="btn btn-warning btn-lg px-4 me-md-2">Explore Now</a>
            <a href="about.php" class="btn btn-outline-light btn-lg px-4">Learn More</a>
          </div>
        </div>
        <div class="col-md-6 d-none d-md-block">
          <div class="hero-image-container">
            <img src="assets/images/hero/nai.jpg" alt="Nairobi City View" class="hero-image img-fluid rounded">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Categories Section -->
  <section id="explore" class="categories-section py-5">
    <div class="container">
      <h2 class="text-center mb-5">Explore Nairobi Pulse</h2>
      
      <div class="row g-4">
        <div class="col-md-4 mb-4">
          <div class="card category-card h-100">
            <div class="card-body text-center">
              <i class="fas fa-utensils fa-3x mb-3 text-primary"></i>
              <h3 class="card-title">Restaurants</h3>
              <p class="card-text">From hidden culinary gems to bustling street food, discover Nairobi's diverse dining scene.</p>
              <a href="restaurants.php" class="btn btn-outline-primary">Discover Restaurants</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card category-card h-100">
            <div class="card-body text-center">
              <i class="fas fa-glass-cheers fa-3x mb-3 text-danger"></i>
              <h3 class="card-title">Nightlife</h3>
              <p class="card-text">Explore trendy rooftop bars to legendary clubs that keep the energy alive till dawn.</p>
              <a href="nightlife.php" class="btn btn-outline-danger">Discover Nightlife</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card category-card h-100">
            <div class="card-body text-center">
              <i class="fas fa-bus-alt fa-3x mb-3 text-success"></i>
              <h3 class="card-title">Matatu Culture</h3>
              <p class="card-text">Experience the artistic and musical expression of matatus, the colorful minibuses of Nairobi.</p>
              <a href="matatu.php" class="btn btn-outline-success">Discover Matatu Culture</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card category-card h-100">
            <div class="card-body text-center">
              <i class="fas fa-landmark fa-3x mb-3 text-info"></i>
              <h3 class="card-title">Attractions</h3>
              <p class="card-text">Explore Nairobi's top tourist spots, parks, museums, and fun activities for all ages.</p>
              <a href="attractions.php" class="btn btn-outline-info">Discover Attractions</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card category-card h-100">
            <div class="card-body text-center">
              <i class="fas fa-heart fa-3x mb-3 text-danger"></i>
              <h3 class="card-title">Fun Activities</h3>
              <p class="card-text">Explore Nairobi's top fun spots, parks, museums, and fun activities for all ages.</p>
              <a href="fun-things.php" class="btn btn-outline-info">Discover Fun Things</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card category-card h-100">
            <div class="card-body text-center">
              <i class="fas fa-calendar-alt fa-3x mb-3 text-warning"></i>
              <h3 class="card-title">Events</h3>
              <p class="card-text">Find exciting festivals, concerts, exhibitions, and cultural events happening in Nairobi.</p>
              <a href="events.php" class="btn btn-outline-warning">Discover Events</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Restaurants Section -->
  <section class="featured-section py-5 bg-light">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Featured Restaurants</h2>
        <a href="restaurants.php" class="btn btn-sm btn-primary">View All</a>
      </div>
      
      <div class="row g-4">
        <?php foreach ($featuredRestaurants as $restaurant): ?>
          <div class="col-md-4">
            <div class="card venue-card h-100">
              <div class="card-img-top venue-image" style="background-image: url('<?php echo $restaurant['image_url']; ?>')"></div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0"><?php echo $restaurant['name']; ?></h5>
                  <span class="badge bg-primary"><?php echo $restaurant['cuisine']; ?></span>
                </div>
                <p class="card-text small text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $restaurant['location']; ?></p>
                <div class="mb-2">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $restaurant['rating']): ?>
                      <i class="fas fa-star text-warning"></i>
                    <?php else: ?>
                      <i class="far fa-star text-warning"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                  <span class="small text-muted ms-1">(<?php echo $restaurant['reviews']; ?> reviews)</span>
                </div>
                <p class="card-text small"><?php echo substr($restaurant['description'], 0, 100); ?>...</p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-muted small"><i class="fas fa-clock me-1"></i> <?php echo $restaurant['hours']; ?></span>
                  <span class="text-success small"><?php echo $restaurant['price_range']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Featured Nightlife Section -->
  <section class="featured-section py-5">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Featured Nightlife</h2>
        <a href="nightlife.php" class="btn btn-sm btn-danger">View All</a>
      </div>
      
      <div class="row g-4">
        <?php foreach ($featuredNightlife as $venue): ?>
          <div class="col-md-4">
            <div class="card venue-card h-100">
              <div class="card-img-top venue-image" style="background-image: url('<?php echo $venue['image_url']; ?>')"></div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0"><?php echo $venue['name']; ?></h5>
                  <span class="badge bg-danger"><?php echo $venue['type']; ?></span>
                </div>
                <p class="card-text small text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $venue['location']; ?></p>
                <div class="mb-2">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $venue['vibe_rating']): ?>
                      <i class="fas fa-fire text-danger"></i>
                    <?php else: ?>
                      <i class="far fa-fire text-danger"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                  <span class="small text-muted ms-1">(Vibe rating)</span>
                </div>
                <p class="card-text small"><?php echo substr($venue['description'], 0, 100); ?>...</p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-muted small"><i class="fas fa-clock me-1"></i> <?php echo $venue['hours']; ?></span>
                  <span class="text-info small"><?php echo $venue['music']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Featured Matatu Section -->
  <section class="featured-section py-5 bg-light">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Featured Matatu Culture</h2>
        <a href="matatu.php" class="btn btn-sm btn-success">View All</a>
      </div>
      
      <div class="row g-4">
        <?php foreach ($featuredMatatu as $matatu): ?>
          <div class="col-md-4">
            <div class="card venue-card h-100">
              <div class="card-img-top venue-image" style="background-image: url('<?php echo $matatu['image_url']; ?>')"></div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0"><?php echo $matatu['name']; ?></h5>
                  <span class="badge bg-success"><?php echo $matatu['route']; ?></span>
                </div>
                <p class="card-text small text-muted"><i class="fas fa-road me-1"></i> <?php echo $matatu['route_description']; ?></p>
                <div class="mb-2">
                  <span class="badge bg-secondary me-1"><?php echo $matatu['art_style']; ?></span>
                  <span class="badge bg-secondary"><?php echo $matatu['music_system']; ?></span>
                </div>
                <p class="card-text small"><?php echo substr($matatu['description'], 0, 100); ?>...</p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-muted small"><i class="fas fa-user-alt me-1"></i> <?php echo $matatu['designer']; ?></span>
                  <span class="text-success small"><?php echo $matatu['year']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Featured Attractions Section -->
  <section class="featured-section py-5">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Top Attractions</h2>
        <a href="attractions.php" class="btn btn-sm btn-info">View All</a>
      </div>
      
      <div class="row g-4">
        <?php foreach ($featuredAttractions as $attraction): ?>
          <div class="col-md-4">
            <div class="card venue-card h-100">
              <div class="card-img-top venue-image" style="background-image: url('<?php echo $attraction['image_url']; ?>')"></div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0"><?php echo $attraction['name']; ?></h5>
                  <span class="badge bg-info"><?php echo $attraction['category']; ?></span>
                </div>
                <p class="card-text small text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $attraction['location']; ?></p>
                <div class="mb-2">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $attraction['rating']): ?>
                      <i class="fas fa-star text-warning"></i>
                    <?php else: ?>
                      <i class="far fa-star text-warning"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                  <span class="small text-muted ms-1">(<?php echo $attraction['reviews']; ?> reviews)</span>
                </div>
                <p class="card-text small"><?php echo substr($attraction['description'], 0, 100); ?>...</p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-muted small"><i class="fas fa-clock me-1"></i> <?php echo $attraction['hours']; ?></span>
                  <span class="text-success small"><?php echo $attraction['price_range']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Upcoming Events Section -->
  <section class="featured-section py-5 bg-light">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Upcoming Events</h2>
        <a href="events.php" class="btn btn-sm btn-warning">View All</a>
      </div>
      
      <div class="row g-4">
        <?php foreach ($upcomingEvents as $event): ?>
          <div class="col-md-4">
            <div class="card venue-card h-100">
              <div class="card-img-top venue-image" style="background-image: url('<?php echo $event['image_url']; ?>')">
                <div class="event-date-badge">
                  <span class="day"><?php echo date('d', strtotime($event['date'])); ?></span>
                  <span class="month"><?php echo date('M', strtotime($event['date'])); ?></span>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0"><?php echo $event['name']; ?></h5>
                  <span class="badge bg-warning text-dark"><?php echo $event['category']; ?></span>
                </div>
                <p class="card-text small text-muted">
                  <i class="fas fa-map-marker-alt me-1"></i> <?php echo $event['venue']; ?>, <?php echo $event['location']; ?>
                </p>
                <p class="card-text small text-muted">
                  <i class="fas fa-calendar-alt me-1"></i> 
                  <?php echo date('F j, Y', strtotime($event['date'])); ?>
                </p>
                <p class="card-text small text-muted">
                  <i class="fas fa-clock me-1"></i> <?php echo $event['time']; ?>
                </p>
                <p class="card-text small"><?php echo substr($event['description'], 0, 100); ?>...</p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-success small"><?php echo $event['price_range']; ?></span>
                  <a href="events.php" class="text-warning small">
                    <i class="fas fa-calendar-plus me-1"></i> More Events
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Newsletter Section -->
  <section class="newsletter-section py-5 bg-dark text-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h2>Stay Updated with Nairobi Pulse</h2>
          <p class="lead">Subscribe to our newsletter for the latest updates on Nairobi's vibrant scene.</p>
          <form class="row g-3 justify-content-center">
            <div class="col-auto">
              <input type="email" class="form-control" id="email" placeholder="Your email address">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-warning">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Custom styles for event date badges -->
  <style>
    .event-date-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: var(--primary-color);
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      display: flex;
      flex-direction: column;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .event-date-badge .day {
      font-size: 1.2rem;
      font-weight: bold;
      line-height: 1;
    }
    
    .event-date-badge .month {
      font-size: 0.8rem;
      text-transform: uppercase;
    }
  </style>
</main>

<?php include 'includes/footer.php'; ?>
