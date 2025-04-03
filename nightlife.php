<?php
  include 'includes/header.php';
  include 'includes/db.php';
  
  // Get all nightlife venues
  $allVenues = getNightlifeVenues();
  
  // Get current page from URL parameter
  $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
  
  // Get paginated venues data
  $paginatedData = getPaginatedData($allVenues, $currentPage, 6);
  $venues = $paginatedData['data'];
  $pagination = $paginatedData['pagination'];
  
  // Get unique venue types and areas for filter
  $types = [];
  $areas = [];
  $music = [];
  foreach ($allVenues as $venue) {
    if (!in_array($venue['type'], $types)) {
      $types[] = $venue['type'];
    }
    
    if (!in_array($venue['location'], $areas)) {
      $areas[] = $venue['location'];
    }
    
    if (!in_array($venue['music'], $music)) {
      $music[] = $venue['music'];
    }
  }
  sort($types);
  sort($areas);
  sort($music);
?>
<br>
<br>
<br>
<main>
  <!-- Hero Section -->
  <section class="category-hero-section nightlife-hero py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center text-white">
          <h1 class="display-4 fw-bold">Nairobi Nightlife</h1>
          <div class="separator my-3"></div>
          <p class="lead">Discover the electrifying nightlife scene in Kenya's capital</p>
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
              <h5 class="card-title mb-3">Filter Venues</h5>
              <form id="filter-form" class="row g-3">
                <div class="col-md-3">
                  <select class="form-select" id="type-filter">
                    <option value="">All Venue Types</option>
                    <?php foreach ($types as $type): ?>
                      <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-3">
                  <select class="form-select" id="location-filter">
                    <option value="">All Locations</option>
                    <?php foreach ($areas as $area): ?>
                      <option value="<?php echo $area; ?>"><?php echo $area; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-3">
                  <select class="form-select" id="music-filter">
                    <option value="">All Music Types</option>
                    <?php foreach ($music as $genre): ?>
                      <option value="<?php echo $genre; ?>"><?php echo $genre; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-3">
                  <select class="form-select" id="rating-filter">
                    <option value="">Any Vibe Rating</option>
                    <option value="5">5 Stars - Legendary</option>
                    <option value="4">4+ Stars - Must Visit</option>
                    <option value="3">3+ Stars - Good Vibes</option>
                  </select>
                </div>
                
                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Search by name or description...">
                    <button class="btn btn-danger" type="button" id="search-button">
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

  <!-- Nightlife Listing Section -->
  <section class="listings-section py-5">
    <div class="container">
      <div class="row g-4" id="venues-container">
        <?php foreach ($venues as $venue): ?>
          <div class="col-md-4 venue-item" 
               data-type="<?php echo $venue['type']; ?>" 
               data-location="<?php echo $venue['location']; ?>" 
               data-music="<?php echo $venue['music']; ?>"
               data-rating="<?php echo $venue['vibe_rating']; ?>">
            <div class="card venue-card h-100">
              <!-- Nightlife Image Gallery Slider -->
              <div class="swiper nightlife-gallery-slider">
                <div class="swiper-wrapper">
                  <!-- Main image slide -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('<?php echo $venue['image_url']; ?>')"></div>
                  </div>
                  <!-- Additional image slides -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/nightlife/<?php echo strtolower(str_replace(' ', '-', $venue['name'])); ?>-interior.jpg')"></div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/nightlife/<?php echo strtolower(str_replace(' ', '-', $venue['name'])); ?>-crowd.jpg')"></div>
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
                <p class="card-text small venue-description"><?php echo $venue['description']; ?></p>
                
                <div class="mt-3">
                  <p class="card-text small mb-1"><strong>Features:</strong></p>
                  <div class="mb-2">
                    <?php foreach ($venue['features'] as $feature): ?>
                      <span class="badge bg-light text-dark me-1 mb-1"><?php echo $feature; ?></span>
                    <?php endforeach; ?>
                  </div>
                </div>
                
                <?php if (!empty($venue['entry_fee'])): ?>
                  <p class="card-text small"><strong>Entry Fee:</strong> <?php echo $venue['entry_fee']; ?></p>
                <?php endif; ?>
                
                <?php if (!empty($venue['dress_code'])): ?>
                  <p class="card-text small"><strong>Dress Code:</strong> <?php echo $venue['dress_code']; ?></p>
                <?php endif; ?>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-muted small"><i class="fas fa-clock me-1"></i> <?php echo $venue['hours']; ?></span>
                  <span class="text-info small"><i class="fas fa-music me-1"></i> <?php echo $venue['music']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      
      <!-- Empty Results Message -->
      <div id="no-results" class="col-12 text-center py-5 d-none">
        <div class="no-results-container">
          <i class="fas fa-glass-cheers fa-3x mb-3 text-muted"></i>
          <h3>No venues found</h3>
          <p>Try adjusting your filters or search criteria</p>
          <button class="btn btn-danger" id="clear-filters">Clear Filters</button>
        </div>
      </div>
      
      <!-- Pagination -->
      <?php if ($pagination['totalPages'] > 1): ?>
      <div class="row mt-4">
        <div class="col-12">
          <nav aria-label="Nightlife pagination">
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
  
  <!-- Safety Tips Section -->
  <section class="safety-tips-section py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center mb-4">Nightlife Safety Tips</h3>
          
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-taxi me-2 text-warning"></i>Transportation</h5>
                  <p class="card-text">Use trusted transportation services like Uber or Bolt when traveling at night. Always confirm your driver details before getting in.</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-user-friends me-2 text-warning"></i>Group Safety</h5>
                  <p class="card-text">Travel in groups when possible and keep an eye on each other throughout the night. Don't leave drinks unattended.</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-money-bill-wave me-2 text-warning"></i>Valuables</h5>
                  <p class="card-text">Keep minimal cash and valuables with you. Consider leaving extra credit cards and IDs at your accommodation.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="js/search.js"></script>

<?php include 'includes/footer.php'; ?>
