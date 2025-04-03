<?php
  include 'includes/header.php';
  include 'includes/db.php';
  
  // Get all events
  $allEvents = getEvents();
  
  // Sort events by date
  usort($allEvents, function($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
  });
  
  // Get current page from URL parameter
  $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
  
  // Get paginated events data
  $paginatedData = getPaginatedData($allEvents, $currentPage, 6);
  $events = $paginatedData['data'];
  $pagination = $paginatedData['pagination'];
  
  // Get unique categories for filter
  $categories = [];
  foreach ($allEvents as $event) {
    if (!in_array($event['category'], $categories)) {
      $categories[] = $event['category'];
    }
  }
  sort($categories);
?>
<br>
<br>
<br>
<main>
  <!-- Hero Section -->
  <section class="category-hero-section py-5" style="background-image: url('https://source.unsplash.com/1600x900/?nairobi,event');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center text-white">
          <h1 class="display-4 fw-bold">Nairobi Events</h1>
          <div class="separator my-3"></div>
          <p class="lead">Discover upcoming festivals, concerts, exhibitions and cultural happenings</p>
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
              <h5 class="card-title mb-3">Filter Events</h5>
              <form id="filter-form" class="row g-3">
                <div class="col-md-4">
                  <select class="form-select" id="category-filter">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                      <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="month-filter">
                    <option value="">Any Month</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="price-filter">
                    <option value="">Any Price Range</option>
                    <option value="Free">Free</option>
                    <option value="1000">Under 1000 KSh</option>
                    <option value="3000">Under 3000 KSh</option>
                    <option value="5000">Under 5000 KSh</option>
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

  <!-- Events Calendar Section -->
  <section class="calendar-section py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Upcoming Events Calendar</h2>
      <div class="row">
        <div class="col-md-12">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Events Listing Section -->
  <section class="listings-section py-5">
    <div class="container">
      <h2 class="text-center mb-4">Featured Events</h2>
      <div class="row g-4" id="events-container">
        <?php foreach ($events as $event): ?>
          <?php 
            // Extract month from date for filtering
            $eventMonth = date('m', strtotime($event['date']));
            
            // Extract max price from price range
            preg_match('/(\d+)/', $event['price_range'], $matches);
            $maxPrice = !empty($matches) ? intval($matches[0]) : 0;
          ?>
          <div class="col-md-4 venue-item" 
               data-category="<?php echo $event['category']; ?>" 
               data-month="<?php echo $eventMonth; ?>" 
               data-price="<?php echo $maxPrice; ?>"
               data-date="<?php echo $event['date']; ?>"
               data-lat="<?php echo $event['coordinates']['lat']; ?>"
               data-lng="<?php echo $event['coordinates']['lng']; ?>"
               data-name="<?php echo $event['name']; ?>">
            <div class="card venue-card h-100">
              <!-- Event Image Gallery Slider -->
              <div class="swiper event-gallery-slider">
                <div class="swiper-wrapper">
                  <!-- Main image slide -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('<?php echo $event['image_url']; ?>')"></div>
                  </div>
                  <!-- Additional image slides -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/events/<?php echo strtolower(str_replace(' ', '-', $event['name'])); ?>-scene.jpg')"></div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/events/<?php echo strtolower(str_replace(' ', '-', $event['name'])); ?>-people.jpg')"></div>
                  </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Navigation buttons -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
              <div class="event-date-badge">
                <span class="day"><?php echo date('d', strtotime($event['date'])); ?></span>
                <span class="month"><?php echo date('M', strtotime($event['date'])); ?></span>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0"><?php echo $event['name']; ?></h5>
                  <span class="badge bg-primary"><?php echo $event['category']; ?></span>
                </div>
                <p class="card-text small text-muted">
                  <i class="fas fa-map-marker-alt me-1"></i> <?php echo $event['venue']; ?>, <?php echo $event['location']; ?>
                </p>
                <p class="card-text small text-muted">
                  <i class="fas fa-calendar-alt me-1"></i> 
                  <?php echo date('F j, Y', strtotime($event['date'])); ?>
                  <?php if (!empty($event['end_date']) && $event['date'] !== $event['end_date']): ?>
                    - <?php echo date('F j, Y', strtotime($event['end_date'])); ?>
                  <?php endif; ?>
                </p>
                <p class="card-text small text-muted">
                  <i class="fas fa-clock me-1"></i> <?php echo $event['time']; ?>
                </p>
                
                <p class="card-text small venue-description"><?php echo $event['description']; ?></p>
                
                <div class="mt-3">
                  <?php if (!empty($event['highlights'])): ?>
                    <p class="card-text small mb-1"><strong>Highlights:</strong></p>
                    <div class="mb-2">
                      <?php foreach ($event['highlights'] as $highlight): ?>
                        <span class="badge bg-light text-dark me-1 mb-1"><?php echo $highlight; ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  
                  <?php if (!empty($event['recurring'])): ?>
                    <p class="card-text small text-muted">
                      <i class="fas fa-sync-alt me-1"></i> <?php echo $event['recurring']; ?> event
                    </p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-success small"><?php echo $event['price_range']; ?></span>
                  <?php if (!empty($event['website'])): ?>
                    <a href="<?php echo $event['website']; ?>" class="text-primary small" target="_blank">
                      <i class="fas fa-external-link-alt me-1"></i> Website
                    </a>
                  <?php endif; ?>
                </div>
                <!-- Map Button -->
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-primary w-100 view-map">
                    <i class="fas fa-map-marker-alt"></i> View on Map
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      
      <!-- Empty Results Message -->
      <div id="no-results" class="col-12 text-center py-5 d-none">
        <div class="no-results-container">
          <i class="fas fa-calendar-times fa-3x mb-3 text-muted"></i>
          <h3>No events found</h3>
          <p>Try adjusting your filters or search criteria</p>
          <button class="btn btn-primary" id="clear-filters">Clear Filters</button>
        </div>
      </div>
      
      <!-- Pagination -->
      <?php if ($pagination['totalPages'] > 1): ?>
      <div class="row mt-4">
        <div class="col-12">
          <nav aria-label="Events pagination">
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
  
  <!-- Map Modal -->
  <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mapModalLabel">Event Location</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="map" style="height: 400px;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="#" id="get-directions" class="btn btn-primary" target="_blank">Get Directions</a>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Include FullCalendar and Google Maps scripts -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDefaultKeyForExamplePurposes&callback=initMap" async defer></script>

<script>
  // Calendar initialization
  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listMonth'
      },
      events: [
        <?php foreach ($events as $event): ?>
        {
          title: '<?php echo addslashes($event['name']); ?>',
          start: '<?php echo $event['date']; ?>',
          <?php if (!empty($event['end_date']) && $event['date'] !== $event['end_date']): ?>
          end: '<?php echo date('Y-m-d', strtotime($event['end_date'] . ' +1 day')); ?>',
          <?php endif; ?>
          url: '#event-<?php echo $event['id']; ?>',
          backgroundColor: getEventColor('<?php echo $event['category']; ?>'),
          borderColor: getEventColor('<?php echo $event['category']; ?>')
        },
        <?php endforeach; ?>
      ],
      eventClick: function(info) {
        info.jsEvent.preventDefault();
        const eventId = info.event.url.replace('#event-', '');
        const eventElement = document.querySelector(`[data-id="${eventId}"]`);
        if (eventElement) {
          eventElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
          eventElement.classList.add('highlight-event');
          setTimeout(() => {
            eventElement.classList.remove('highlight-event');
          }, 3000);
        }
      }
    });
    calendar.render();
    
    // Event color based on category
    function getEventColor(category) {
      const colorMap = {
        'Arts & Culture': '#FF6B35',
        'Music & Entertainment': '#36A18B',
        'Business & Exhibition': '#2E4057',
        'Food & Drink': '#FFD166',
        'Technology & Innovation': '#4361EE',
        'Fashion & Design': '#F25F5C',
        'Sports & Fitness': '#00A896'
      };
      
      return colorMap[category] || '#FF6B35';
    }
  });
  
  // Map functionality
  let map;
  let marker;
  
  function initMap() {
    // Default center (Nairobi)
    const nairobi = { lat: -1.286389, lng: 36.817223 };
    
    // Initialize the map
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: nairobi,
    });
    
    // Initialize a marker but don't place it yet
    marker = new google.maps.Marker({
      map: map,
      animation: google.maps.Animation.DROP,
    });
    
    // Set up event listeners for map buttons
    document.querySelectorAll('.view-map').forEach(button => {
      button.addEventListener('click', function() {
        const parent = this.closest('.venue-item');
        const lat = parseFloat(parent.getAttribute('data-lat'));
        const lng = parseFloat(parent.getAttribute('data-lng'));
        const name = parent.getAttribute('data-name');
        
        showLocationOnMap(lat, lng, name);
      });
    });
  }
  
  function showLocationOnMap(lat, lng, name) {
    const position = { lat, lng };
    
    // Update map center and marker
    map.setCenter(position);
    marker.setPosition(position);
    marker.setTitle(name);
    
    // Update modal title and directions link
    document.getElementById('mapModalLabel').textContent = name + ' - Location';
    document.getElementById('get-directions').href = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&destination_place_id=${name}`;
    
    // Show the modal
    const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
    mapModal.show();
  }
  
  // Filtering functionality
  document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const categoryFilter = document.getElementById('category-filter');
    const monthFilter = document.getElementById('month-filter');
    const priceFilter = document.getElementById('price-filter');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const resetFiltersButton = document.getElementById('reset-filters');
    const clearFiltersButton = document.getElementById('clear-filters');
    const eventsContainer = document.getElementById('events-container');
    const noResults = document.getElementById('no-results');
    
    // Apply filters function
    function applyFilters() {
      const selectedCategory = categoryFilter.value;
      const selectedMonth = monthFilter.value;
      const selectedPrice = priceFilter.value ? parseInt(priceFilter.value) : '';
      const searchText = searchInput.value.toLowerCase();
      
      // Get all event items
      const events = eventsContainer.querySelectorAll('.venue-item');
      
      // Counter for visible items
      let visibleCount = 0;
      
      // Loop through each event
      events.forEach(event => {
        const category = event.dataset.category;
        const month = event.dataset.month;
        const price = parseInt(event.dataset.price);
        const text = event.textContent.toLowerCase();
        
        // Check if the event matches all criteria
        const matchesCategory = !selectedCategory || category === selectedCategory;
        const matchesMonth = !selectedMonth || month === selectedMonth;
        const matchesPrice = !selectedPrice || (price <= selectedPrice || price === 0);
        const matchesSearch = !searchText || text.includes(searchText);
        
        // Show or hide based on the filters
        if (matchesCategory && matchesMonth && matchesPrice && matchesSearch) {
          event.style.display = 'block';
          visibleCount++;
        } else {
          event.style.display = 'none';
        }
      });
      
      // Show or hide no results message
      if (visibleCount === 0) {
        noResults.classList.remove('d-none');
      } else {
        noResults.classList.add('d-none');
      }
    }
    
    // Reset filters function
    function resetFilters() {
      categoryFilter.value = '';
      monthFilter.value = '';
      priceFilter.value = '';
      searchInput.value = '';
      
      applyFilters();
    }
    
    // Event listeners
    categoryFilter.addEventListener('change', applyFilters);
    monthFilter.addEventListener('change', applyFilters);
    priceFilter.addEventListener('change', applyFilters);
    searchButton.addEventListener('click', applyFilters);
    searchInput.addEventListener('keyup', function(e) {
      if (e.key === 'Enter') {
        applyFilters();
      }
    });
    resetFiltersButton.addEventListener('click', resetFilters);
    clearFiltersButton.addEventListener('click', resetFilters);
  });
</script>

<!-- Custom styles for calendar and events -->
<style>
  /* Calendar styles */
  #calendar {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
  }
  
  .fc-daygrid-day-number, .fc-col-header-cell-cushion {
    color: var(--dark-color);
    text-decoration: none;
  }
  
  .fc-daygrid-day.fc-day-today {
    background-color: rgba(255, 107, 53, 0.1);
  }
  
  .fc-button-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
  }
  
  .fc-button-primary:hover {
    background-color: #eb5f2e;
    border-color: #eb5f2e;
  }
  
  /* Event date badge */
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
  
  /* Highlight effect for events */
  .highlight-event {
    box-shadow: 0 0 15px var(--primary-color);
    transform: scale(1.03);
    transition: all 0.3s ease;
  }
</style>

<?php include 'includes/footer.php'; ?>
