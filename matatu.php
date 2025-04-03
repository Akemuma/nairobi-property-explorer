<?php
  include 'includes/header.php';
  include 'includes/db.php';
  
  // Get all matatu content
  $allMatatus = getMatatuCulture();
  
  // Get current page from URL parameter
  $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
  
  // Get paginated matatus data
  $paginatedData = getPaginatedData($allMatatus, $currentPage, 6);
  $matatus = $paginatedData['data'];
  $pagination = $paginatedData['pagination'];
  
  // Get unique routes and art styles for filter
  $routes = [];
  $artStyles = [];
  foreach ($allMatatus as $matatu) {
    if (!in_array($matatu['route'], $routes)) {
      $routes[] = $matatu['route'];
    }
    
    if (!in_array($matatu['art_style'], $artStyles)) {
      $artStyles[] = $matatu['art_style'];
    }
  }
  sort($routes);
  sort($artStyles);
?>
<br>
<br>
<br>
<main>
  <!-- Hero Section -->
  <section class="category-hero-section matatu-hero py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center text-white">
          <h1 class="display-4 fw-bold">Matatu Culture</h1>
          <div class="separator my-3"></div>
          <p class="lead">Experience Nairobi's iconic mobile art galleries and cultural phenomenon</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Introduction Section -->
  <section class="matatu-intro py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2>The Moving Art of Nairobi</h2>
          <p>Matatus are more than just transportation in Nairobi—they're a cultural institution and mobile art galleries that showcase Kenya's vibrant creative expression.</p>
          <p>With custom paint jobs, elaborate sound systems, and interior designs that range from hip-hop culture to anime influences, matatus transform daily commutes into immersive artistic experiences.</p>
          <p>Each matatu has its own personality, often reflecting popular culture, music, sports icons, or political statements. The culture surrounding these vehicles has created an entire ecosystem of designers, artists, DJs, and entrepreneurs.</p>
        </div>
        <div class="col-md-6">
          <div class="matatu-intro-image"></div>
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
              <h5 class="card-title mb-3">Filter Matatus</h5>
              <form id="filter-form" class="row g-3">
                <div class="col-md-4">
                  <select class="form-select" id="route-filter">
                    <option value="">All Routes</option>
                    <?php foreach ($routes as $route): ?>
                      <option value="<?php echo $route; ?>"><?php echo $route; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="art-filter">
                    <option value="">All Art Styles</option>
                    <?php foreach ($artStyles as $style): ?>
                      <option value="<?php echo $style; ?>"><?php echo $style; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="year-filter">
                    <option value="">Any Year</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="older">2019 & Older</option>
                  </select>
                </div>
                
                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Search by name or description...">
                    <button class="btn btn-success" type="button" id="search-button">
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

  <!-- Matatu Listing Section -->
  <section class="listings-section py-5">
    <div class="container">
      <div class="row g-4" id="matatus-container">
        <?php foreach ($matatus as $matatu): ?>
          <div class="col-md-4 venue-item" 
               data-route="<?php echo $matatu['route']; ?>" 
               data-art="<?php echo $matatu['art_style']; ?>" 
               data-year="<?php echo $matatu['year']; ?>">
            <div class="card venue-card h-100">
              <!-- Matatu Image Gallery Slider -->
              <div class="swiper matatu-gallery-slider">
                <div class="swiper-wrapper">
                  <!-- Main image slide -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('<?php echo $matatu['image_url']; ?>')"></div>
                  </div>
                  <!-- Additional image slides (for demo purposes) -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/matatu/<?php echo strtolower(str_replace(' ', '-', $matatu['name'])); ?>-interior.jpg')"></div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/matatu/<?php echo strtolower(str_replace(' ', '-', $matatu['name'])); ?>-detail.jpg')"></div>
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
                  <h5 class="card-title mb-0"><?php echo $matatu['name']; ?></h5>
                  <span class="badge bg-success"><?php echo $matatu['route']; ?></span>
                </div>
                <p class="card-text small text-muted"><i class="fas fa-road me-1"></i> <?php echo $matatu['route_description']; ?></p>
                
                <div class="mb-3">
                  <span class="badge bg-secondary me-1"><?php echo $matatu['art_style']; ?></span>
                  <span class="badge bg-secondary"><?php echo $matatu['music_system']; ?></span>
                </div>
                
                <p class="card-text small venue-description"><?php echo $matatu['description']; ?></p>
                
                <?php if (!empty($matatu['art_features'])): ?>
                  <div class="mt-3">
                    <p class="card-text small mb-1"><strong>Art Features:</strong></p>
                    <div class="mb-2">
                      <?php foreach ($matatu['art_features'] as $feature): ?>
                        <span class="badge bg-light text-dark me-1 mb-1"><?php echo $feature; ?></span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>
                
                <?php if (!empty($matatu['notable_for'])): ?>
                  <p class="card-text small"><strong>Notable For:</strong> <?php echo $matatu['notable_for']; ?></p>
                <?php endif; ?>
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
      
      <!-- Empty Results Message -->
      <div id="no-results" class="col-12 text-center py-5 d-none">
        <div class="no-results-container">
          <i class="fas fa-bus-alt fa-3x mb-3 text-muted"></i>
          <h3>No matatus found</h3>
          <p>Try adjusting your filters or search criteria</p>
          <button class="btn btn-success" id="clear-filters">Clear Filters</button>
        </div>
      </div>
      
      <!-- Pagination -->
      <?php if ($pagination['totalPages'] > 1): ?>
      <div class="row mt-4">
        <div class="col-12">
          <nav aria-label="Matatu pagination">
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
  
  <!-- Matatu Culture History Section -->
  <section class="matatu-history py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto">
          <h2 class="text-center mb-4">The History of Matatu Culture</h2>
          
          <div class="timeline">
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h4>1960s</h4>
                <p>The term "matatu" emerged, derived from the Swahili word "tatu" (meaning three), referencing the three-shilling fare charged in the early days of these informal transport options.</p>
              </div>
            </div>
            
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h4>1970s - 1980s</h4>
                <p>Matatus evolved from simple vans to becoming an essential part of Nairobi's public transport system, filling gaps left by formal transit options.</p>
              </div>
            </div>
            
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h4>1990s</h4>
                <p>The artistic customization trend began, with operators using bold designs to distinguish their vehicles and attract passengers in the competitive market.</p>
              </div>
            </div>
            
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h4>2000s</h4>
                <p>Matatu art evolved to include elaborate graffiti, portraits of celebrities, and impressive sound systems. Government regulations sometimes attempted to standardize matatus, leading to periods of artistic restriction.</p>
              </div>
            </div>
            
            <div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                <h4>2010s - Present</h4>
                <p>Matatu culture has become recognized globally as a unique form of urban art and cultural expression. The designs now feature digital printing techniques alongside traditional airbrushing, with themes ranging from global pop culture to local political commentary.</p>
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
