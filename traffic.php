<?php
  include 'includes/header.php';
  include 'includes/db.php';
?>
<br>
<br>
<br>
<main>
  <!-- Hero Section -->
  <section class="category-hero-section py-5" style="background-image: url('assets/images/jam.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center text-white">
          <h1 class="display-4 fw-bold">Nairobi Traffic</h1>
          <div class="separator my-3"></div>
          <p class="lead">Stay updated with real-time traffic conditions and plan your journey around the city</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Traffic Map Section -->
  <section class="py-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <h2 class="h4 mb-3">Live Traffic Map</h2>
              <p>
                Check real-time traffic conditions across Nairobi. The map below shows current traffic flow, 
                incidents, and construction zones to help you plan your route.
                </p>
                <p>The Traffic Map API is still in development
              </p>
              <div id="traffic-map" style="height: 500px; width: 100%; border-radius: 8px;"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <!-- Traffic Tips Card -->
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h3 class="h5 mb-3">Traffic Tips for Nairobi</h3>
              <ul class="list-unstyled">
                <li class="mb-3">
                  <i class="fas fa-clock text-primary me-2"></i>
                  <strong>Avoid Rush Hours:</strong> Peak traffic is typically between 6:30-9:00 AM and 4:30-7:30 PM on weekdays.
                </li>
                <li class="mb-3">
                  <i class="fas fa-route text-primary me-2"></i>
                  <strong>Use Alternative Routes:</strong> Main highways like Thika Road and Mombasa Road often experience heavy congestion.
                </li>
                <li class="mb-3">
                  <i class="fas fa-subway text-primary me-2"></i>
                  <strong>Consider Public Transport:</strong> The BRT system and matatus can sometimes be faster during peak hours.
                </li>
                <li class="mb-3">
                  <i class="fas fa-umbrella text-primary me-2"></i>
                  <strong>Weather Awareness:</strong> During rainy seasons, allow extra time as flooding can significantly slow traffic.
                </li>
                <li>
                  <i class="fas fa-mobile-alt text-primary me-2"></i>
                  <strong>Use Traffic Apps:</strong> Apps like Waze and Google Maps provide real-time updates about traffic conditions.
                </li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Common Traffic Areas -->
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h3 class="h5 mb-3">Known Traffic Hotspots</h3>
              <div class="list-group list-group-flush">
                <a href="https://www.google.com/maps/search/?api=1&query=Thika+Road+Nairobi" target="_blank" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Thika Road</h5>
                    <small class="text-danger">High congestion</small>
                  </div>
                  <p class="mb-1">Major highway connecting CBD to northeastern suburbs including Kasarani and Thika</p>
                  <small class="text-danger">View traffic</small>
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query=Mombasa+Road+Nairobi" target="_blank" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Mombasa Road</h5>
                    <small class="text-danger">High congestion</small>
                  </div>
                  <p class="mb-1">Main highway connecting CBD to JKIA airport and southern industrial area</p>
                  <small class="text-danger">View traffic</small>
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query=Waiyaki+Way+Nairobi" target="_blank" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Waiyaki Way</h5>
                    <small class="text-warning">Moderate congestion</small>
                  </div>
                  <p class="mb-1">Main road connecting CBD to western suburbs including Westlands and Kangemi</p>
                  <small class="text-danger">View traffic</small>
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query=Ngong+Road+Nairobi" target="_blank" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Ngong Road</h5>
                    <small class="text-warning">Moderate congestion</small>
                  </div>
                  <p class="mb-1">Major road connecting CBD to southwestern areas including Kilimani and Karen</p>
                  <small class="text-danger">View traffic</small>
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query=Langata+Road+Nairobi" target="_blank" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Langata Road</h5>
                    <small class="text-warning">Moderate congestion</small>
                  </div>
                  <p class="mb-1">Main road connecting to Langata, Rongai, and Karen areas</p>
                  <small class="text-danger">View traffic</small>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h3 class="h5 mb-3">Get Directions</h3>
              <form id="directions-form" class="row g-3">
                <div class="col-md-5">
                  <label for="origin" class="form-label">Starting Point</label>
                  <input type="text" class="form-control" id="origin" placeholder="Enter starting location">
                </div>
                <div class="col-md-5">
                  <label for="destination" class="form-label">Destination</label>
                  <input type="text" class="form-control" id="destination" placeholder="Enter destination">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="button" id="get-directions-btn" class="btn btn-primary w-100">Get Directions</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Google Maps JavaScript -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8pHndk87LGPh--IaD6Dq8AO4OuZU-ihw&libraries=places&callback=initMap" async defer></script>

<script>
  // Variables for the map
  let map;
  let trafficLayer;
  let directionsService;
  let directionsRenderer;
  
  // Initialize the map
  function initMap() {
    // Center on Nairobi
    const nairobi = { lat: -1.286389, lng: 36.817223 };
    
    // Create map
    map = new google.maps.Map(document.getElementById("traffic-map"), {
      center: nairobi,
      zoom: 12,
      mapTypeId: "roadmap",
      mapTypeControl: true,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.TOP_RIGHT,
      },
    });
    
    // Add traffic layer
    trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
    
    // Initialize directions service
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
      map: map,
      panel: null
    });
    
    // Set up event listener for directions form
    document.getElementById('get-directions-btn').addEventListener('click', calculateAndDisplayRoute);
  }
  
  // Calculate and display route
  function calculateAndDisplayRoute() {
    const origin = document.getElementById('origin').value;
    const destination = document.getElementById('destination').value;
    
    if (!origin || !destination) {
      alert('Please enter both starting point and destination');
      return;
    }
    
    directionsService.route(
      {
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        region: 'ke'
      },
      (response, status) => {
        if (status === "OK") {
          directionsRenderer.setDirections(response);
        } else {
          alert("Directions request failed due to " + status);
        }
      }
    );
  }
  
  // For mobile responsiveness
  window.addEventListener('resize', function() {
    // Center the map
    const center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
  });
</script>

<?php include 'includes/footer.php'; ?>