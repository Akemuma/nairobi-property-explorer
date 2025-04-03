<?php
  $pageTitle = "Fun Things To Do in Nairobi";
  include 'includes/header.php';
  include 'includes/db.php';
  
  // Get fun things data
  $funThings = getFunThingsData();
  $totalItems = count($funThings);
  
  // Pagination
  $itemsPerPage = 6;
  $totalPages = ceil($totalItems / $itemsPerPage);
  $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  
  if ($currentPage < 1) {
    $currentPage = 1;
  } elseif ($currentPage > $totalPages) {
    $currentPage = $totalPages;
  }
  
  $startIndex = ($currentPage - 1) * $itemsPerPage;
  $funThingsPage = array_slice($funThings, $startIndex, $itemsPerPage);
  
  // Categories for filtering
  $categories = [];
  foreach ($funThings as $item) {
    if (!in_array($item['category'], $categories)) {
      $categories[] = $item['category'];
    }
  }
  sort($categories);
?>
<br>
<br>
<br>
<main>
  <!-- Hero Section -->
  <section class="hero-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('assets/images/fun/nairobi-national-park.jpg');">
    <div class="container">
      <div class="hero-content text-center animate__animated animate__fadeIn">
        <h1 class="display-4 fw-bold text-white mb-4">Fun Things To Do in Nairobi</h1>
        <p class="lead text-white mb-5">Discover exciting activities and experiences in the vibrant capital of Kenya</p>
        
        <!-- Search Box -->
        <div class="search-container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="input-group">
                <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Search for fun activities...">
                <button class="btn btn-warning btn-lg" type="button" id="searchButton">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Fun Things List Section -->
  <section class="fun-things-section py-5">
    <div class="container" data-aos="fade-up">
      <div class="row mb-4">
        <div class="col-md-8">
          <h2 class="section-title">Explore Fun Activities</h2>
          <p class="text-muted">Discover <?php echo $totalItems; ?> exciting activities to enjoy in Nairobi</p>
        </div>
        <div class="col-md-4">
          <div class="filter-container">
            <select id="categoryFilter" class="form-select">
              <option value="">All Categories</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category; ?>"><?php echo ucfirst($category); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
      
      <div class="fun-things-grid">
        <div class="row" id="funThingsContainer">
          <?php if (empty($funThingsPage)): ?>
            <div class="col-12 text-center">
              <p>No fun activities found. Please try a different search.</p>
            </div>
          <?php else: ?>
            <?php foreach ($funThingsPage as $index => $funThing): ?>
              <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="card fun-thing-card h-100">
                  <div class="card-img-container">
                    <img src="<?php echo $funThing['image']; ?>" class="card-img-top" alt="<?php echo $funThing['name']; ?>">
                    <div class="category-badge"><?php echo ucfirst($funThing['category']); ?></div>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $funThing['name']; ?></h5>
                    <div class="rating mb-2">
                      <span class="text-warning"><?php echo $funThing['rating']; ?></span>
                      <?php 
                        $rating = floatval($funThing['rating']);
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.5;
                        
                        for ($i = 0; $i < $fullStars; $i++) {
                          echo '<i class="fas fa-star text-warning"></i>';
                        }
                        
                        if ($halfStar) {
                          echo '<i class="fas fa-star-half-alt text-warning"></i>';
                          $emptyStars = 4 - $fullStars;
                        } else {
                          $emptyStars = 5 - $fullStars;
                        }
                        
                        for ($i = 0; $i < $emptyStars; $i++) {
                          echo '<i class="far fa-star text-warning"></i>';
                        }
                      ?>
                    </div>
                    <p class="card-text"><?php echo $funThing['description']; ?></p>
                  </div>
                  <div class="card-footer bg-white">
                    <?php if(isset($funThing['website']) && !empty($funThing['website'])): ?>
                      <a href="<?php echo $funThing['website']; ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="fas fa-globe"></i> Visit Website
                      </a>
                    <?php endif; ?>
                    <a href="#" class="btn btn-sm btn-outline-secondary ms-2">
                      <i class="fas fa-map-marker-alt"></i> View on Map
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
      
      <!-- Pagination -->
      <?php if ($totalPages > 1): ?>
        <div class="pagination-container mt-5">
          <nav aria-label="Fun things pagination">
            <ul class="pagination justify-content-center">
              <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>
              
              <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      <?php endif; ?>
    </div>
  </section>
  
  <!-- Fun Facts Section -->
  <section class="fun-facts-section py-5 bg-light">
    <div class="container" data-aos="fade-up">
      <div class="text-center mb-5">
        <h2 class="section-title">Fun Facts About Nairobi</h2>
        <p class="text-muted">Interesting tidbits about Kenya's vibrant capital</p>
      </div>
      
      <div class="row">
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="fun-fact-card text-center p-4">
            <i class="fas fa-leaf fa-3x text-success mb-3"></i>
            <h4>Green City in the Sun</h4>
            <p>Nairobi is known as the "Green City in the Sun" due to its mild climate and many parks and green spaces throughout the city.</p>
          </div>
        </div>
        
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="fun-fact-card text-center p-4">
            <i class="fas fa-paw fa-3x text-warning mb-3"></i>
            <h4>Only Capital with a Safari Park</h4>
            <p>Nairobi is the only capital city in the world with a safari park within its borders, where you can see lions, giraffes, and rhinos.</p>
          </div>
        </div>
        
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
          <div class="fun-fact-card text-center p-4">
            <i class="fas fa-coffee fa-3x text-danger mb-3"></i>
            <h4>Coffee Capital</h4>
            <p>Kenya produces some of the world's finest coffee, and Nairobi is home to numerous specialty coffee shops serving locally grown beans.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>