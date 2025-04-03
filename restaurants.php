<?php
  include 'includes/header.php';
  include 'includes/db.php';
  
  // Get all restaurants
  $allRestaurants = getRestaurants();
  
  // Get current page from URL parameter
  $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
  
  // Get paginated restaurants data
  $paginatedData = getPaginatedData($allRestaurants, $currentPage, 6);
  $restaurants = $paginatedData['data'];
  $pagination = $paginatedData['pagination'];
  
  // Get unique cuisines for filter
  $cuisines = [];
  $locations = [];
  foreach ($allRestaurants as $restaurant) {
    if (!in_array($restaurant['cuisine'], $cuisines)) {
      $cuisines[] = $restaurant['cuisine'];
    }
    
    if (!in_array($restaurant['location'], $locations)) {
      $locations[] = $restaurant['location'];
    }
  }
  sort($cuisines);
  sort($locations);
?>
<br>
<br>
<br>
<main>
  <!-- Hero Section -->
  <section class="category-hero-section restaurant-hero py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center text-white">
          <h1 class="display-4 fw-bold">Nairobi Restaurants</h1>
          <div class="separator my-3"></div>
          <p class="lead">Discover the diverse culinary experiences in Kenya's capital</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Filter Section -->
  <section class="filter-section py-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-3">Filter Restaurants</h5>
              <form id="filter-form" class="row g-3">
                <div class="col-md-4">
                  <select class="form-select" id="cuisine-filter">
                    <option value="">All Cuisines</option>
                    <?php foreach ($cuisines as $cuisine): ?>
                      <option value="<?php echo $cuisine; ?>"><?php echo $cuisine; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="location-filter">
                    <option value="">All Locations</option>
                    <?php foreach ($locations as $location): ?>
                      <option value="<?php echo $location; ?>"><?php echo $location; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="price-filter">
                    <option value="">Any Price Range</option>
                    <option value="$">$ (Budget)</option>
                    <option value="$$">$$ (Moderate)</option>
                    <option value="$$$">$$$ (High-end)</option>
                  </select>
                </div>
                
                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Search by name or description...">
                    <button class="btn btn-primary" type="button" id="search-button">
                      <i class="fas fa-search"></i> Search
                    </button>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <button type="button" class="btn btn-outline-secondary w-100" id="reset-filters">
                    <i class="fas fa-undo"></i> Reset Filters
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Restaurants Listing Section -->
  <section class="listings-section py-5">
    <div class="container">
      <div class="row g-4" id="restaurants-container">
        <?php foreach ($restaurants as $restaurant): ?>
          <div class="col-md-4 venue-item" 
               data-cuisine="<?php echo $restaurant['cuisine']; ?>" 
               data-location="<?php echo $restaurant['location']; ?>" 
               data-price="<?php echo $restaurant['price_range']; ?>">
            <div class="card venue-card h-100">
              <!-- Restaurant Image Gallery Slider -->
              <div class="swiper restaurant-gallery-slider">
                <div class="swiper-wrapper">
                  <!-- Main image slide -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('<?php echo $restaurant['image_url']; ?>')"></div>
                  </div>
                  <!-- Additional image slides -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/restaurants/<?php echo strtolower(str_replace(' ', '-', $restaurant['name'])); ?>-interior.jpg')"></div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/restaurants/<?php echo strtolower(str_replace(' ', '-', $restaurant['name'])); ?>-dish.jpg')"></div>
                  </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Navigation buttons -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
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
                <p class="card-text small venue-description"><?php echo $restaurant['description']; ?></p>
                <div class="mt-3">
                  <?php if (!empty($restaurant['specialties'])): ?>
                    <p class="card-text small mb-1"><strong>Specialties:</strong></p>
                    <div class="mb-2">
                      <?php foreach ($restaurant['specialties'] as $specialty): ?>
                        <span class="badge bg-light text-dark me-1 mb-1"><?php echo $specialty; ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
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
      
      <!-- Empty Results Message -->
      <div id="no-results" class="col-12 text-center py-5 d-none">
        <div class="no-results-container">
          <i class="fas fa-utensils fa-3x mb-3 text-muted"></i>
          <h3>No restaurants found</h3>
          <p>Try adjusting your filters or search criteria</p>
          <button class="btn btn-primary" id="clear-filters">Clear Filters</button>
        </div>
      </div>
      
      <!-- Pagination -->
      <?php if ($pagination['totalPages'] > 1): ?>
      <div class="row mt-4">
        <div class="col-12">
          <nav aria-label="Restaurant pagination">
            <ul class="pagination justify-content-center">
              <?php if ($pagination['hasPrevPage']): ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?php echo $pagination['currentPage'] - 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
              <?php else: ?>
                <li class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
              <?php endif; ?>
              
              <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?php echo ($i == $pagination['currentPage']) ? 'active' : ''; ?>">
                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>
              
              <?php if ($pagination['hasNextPage']): ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?php echo $pagination['currentPage'] + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              <?php else: ?>
                <li class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </nav>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<script src="js/search.js"></script>

<?php include 'includes/footer.php'; ?>
