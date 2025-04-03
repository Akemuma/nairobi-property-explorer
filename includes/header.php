<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nairobi Pulse - Experience the Vibrant Culture of Nairobi</title>
  <meta name="description" content="Discover Nairobi's vibrant restaurant scene, electrifying nightlife, and iconic matatu culture with Nairobi Pulse - your ultimate guide to Kenya's capital.">
  
  <!-- Favicon -->
  <link rel="icon" href="assets/favicon.svg" type="image/svg+xml">
  <link rel="alternate icon" href="assets/favicon.png" type="image/png">
  <link rel="apple-touch-icon" href="assets/favicon.png">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Animation Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  
  <!-- Swiper Slider -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner"></div>
  </div>

  <!-- Header -->
  <header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="assets/logo.svg" alt="Nairobi Pulse Logo" class="logo">
          <span style="color: green;">Nairobi</span><span style="color: red;"> Pulse</span>
        </a> 
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle <?php echo (basename($_SERVER['PHP_SELF']) == 'attractions.php' || basename($_SERVER['PHP_SELF']) == 'restaurants.php' || basename($_SERVER['PHP_SELF']) == 'nightlife.php' || basename($_SERVER['PHP_SELF']) == 'matatu.php') ? 'active' : ''; ?>" href="#" id="nairobiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Nairobi
              </a>
              <ul class="dropdown-menu" aria-labelledby="nairobiDropdown">
                <li><a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'attractions.php') ? 'active' : ''; ?>" href="attractions.php">Attractions</a></li>
                <li><a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'restaurants.php') ? 'active' : ''; ?>" href="restaurants.php">Restaurants</a></li>
                <li><a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'nightlife.php') ? 'active' : ''; ?>" href="nightlife.php">Nightlife</a></li>
                <li><a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'matatu.php') ? 'active' : ''; ?>" href="matatu.php">Matatu Culture</a></li>
                <li><a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == 'fun-things.php') ? 'active' : ''; ?>" href="fun-things.php">Fun Things To Do</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'events.php') ? 'active' : ''; ?>" href="events.php">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'news.php') ? 'active' : ''; ?>" href="news.php">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'traffic.php') ? 'active' : ''; ?>" href="traffic.php">Traffic</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
