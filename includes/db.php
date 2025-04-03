<?php
/**
 * Database functions for Nairobi Pulse
 * Uses JSON files for data storage
 */

/**
 * Get all restaurants from JSON file
 * 
 * @return array Restaurant data
 */
function getRestaurants() {
    $filePath = __DIR__ . '/../data/restaurants.json';
    
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $restaurants = json_decode($jsonData, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $restaurants;
        }
    }
    
    // Return default data if JSON file is unavailable or invalid
    return [
        [
            'id' => 1,
            'name' => 'Carnivore Restaurant',
            'cuisine' => 'African',
            'location' => 'Langata Road',
            'description' => 'Iconic Nairobi restaurant known for its game meat experience, serving an all-you-can-eat meat feast featuring traditional and exotic meats roasted on Maasai swords over a charcoal pit.',
            'price_range' => '$$$',
            'rating' => 4.5,
            'reviews' => 856,
            'hours' => '12:00 PM - 10:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?restaurant,african',
            'specialties' => ['Game Meat', 'Nyama Choma', 'Dawa Cocktail']
        ],
        [
            'id' => 2,
            'name' => 'Talisman',
            'cuisine' => 'Fusion',
            'location' => 'Karen',
            'description' => 'A beloved restaurant in the leafy Karen suburb, offering a fusion of African, Asian, and European flavors in a bohemian-chic setting with an expansive garden and art-filled interiors.',
            'price_range' => '$$',
            'rating' => 4.7,
            'reviews' => 732,
            'hours' => '10:00 AM - 10:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?restaurant,fusion',
            'specialties' => ['Feta & Coriander Samosas', 'Moroccan Cigars', 'Teriyaki Beef Fillet']
        ],
        [
            'id' => 3,
            'name' => 'Mama Oliech',
            'cuisine' => 'Kenyan',
            'location' => 'Kilimani',
            'description' => 'Renowned for its authentic Kenyan dishes, particularly the legendary fried fish (tilapia) served with ugali and traditional vegetables. A favorite among locals, celebrities, and international visitors.',
            'price_range' => '$',
            'rating' => 4.6,
            'reviews' => 521,
            'hours' => '11:00 AM - 9:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?kenyan,food',
            'specialties' => ['Fried Tilapia', 'Ugali', 'Sukuma Wiki']
        ],
        [
            'id' => 4,
            'name' => 'About Thyme',
            'cuisine' => 'Mediterranean',
            'location' => 'Westlands',
            'description' => 'Charming restaurant set in a serene garden offering Mediterranean-inspired cuisine with vegetarian options and an extensive wine list, perfect for a romantic dinner or special occasion.',
            'price_range' => '$$',
            'rating' => 4.4,
            'reviews' => 385,
            'hours' => '12:00 PM - 9:30 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?mediterranean,food',
            'specialties' => ['Seafood Platter', 'Risotto', 'Chocolate Fondant']
        ],
        [
            'id' => 5,
            'name' => 'Diamond Plaza Food Court',
            'cuisine' => 'Indian',
            'location' => 'Parklands',
            'description' => 'A bustling food court featuring multiple Indian street food stalls, offering authentic flavors from different regions of India at affordable prices. Famous for its chaats, grilled sandwiches, and curries.',
            'price_range' => '$',
            'rating' => 4.3,
            'reviews' => 612,
            'hours' => '10:00 AM - 8:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?indian,street-food',
            'specialties' => ['Bhel Puri', 'Pani Puri', 'Butter Chicken']
        ],
        [
            'id' => 6,
            'name' => 'Honey & Dough',
            'cuisine' => 'Bakery & Cafe',
            'location' => 'Gigiri',
            'description' => 'Artisanal bakery and cafe serving freshly baked bread, pastries, cakes, and light meals in a cozy atmosphere. Popular for breakfast meetings and afternoon coffee breaks.',
            'price_range' => '$$',
            'rating' => 4.5,
            'reviews' => 329,
            'hours' => '7:00 AM - 7:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?bakery,pastry',
            'specialties' => ['Sourdough Bread', 'Almond Croissants', 'Avocado Toast']
        ],
        [
            'id' => 7,
            'name' => 'Java House',
            'cuisine' => 'Cafe',
            'location' => 'Various Locations',
            'description' => 'Kenya\'s famous coffee house chain offering quality Kenyan coffee and a diverse menu of breakfast items, sandwiches, burgers, and local dishes in a casual setting.',
            'price_range' => '$$',
            'rating' => 4.2,
            'reviews' => 974,
            'hours' => '6:30 AM - 9:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?cafe,coffee',
            'specialties' => ['Kenyan Coffee', 'Java Wings', 'Nyama Choma Wrap']
        ],
        [
            'id' => 8,
            'name' => 'Habesha',
            'cuisine' => 'Ethiopian',
            'location' => 'Kilimani',
            'description' => 'Authentic Ethiopian restaurant offering traditional dishes served on injera (sourdough flatbread). Known for its communal dining experience and vibrant flavors.',
            'price_range' => '$$',
            'rating' => 4.6,
            'reviews' => 247,
            'hours' => '11:00 AM - 10:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?ethiopian,food',
            'specialties' => ['Doro Wat', 'Tibs', 'Injera']
        ],
        [
            'id' => 9,
            'name' => 'Roadhouse Grill',
            'cuisine' => 'BBQ & Grill',
            'location' => 'Karen',
            'description' => 'Rustic steakhouse specializing in grilled meats, burgers, and barbecue dishes. Popular for its generous portions, family-friendly atmosphere, and weekend live music.',
            'price_range' => '$$',
            'rating' => 4.3,
            'reviews' => 415,
            'hours' => '12:00 PM - 11:00 PM',
            'image_url' => 'https://source.unsplash.com/800x600/?grill,steak',
            'specialties' => ['T-bone Steak', 'Beef Ribs', 'Bacon Burger']
        ]
    ];
}

/**
 * Get all nightlife venues from JSON file
 * 
 * @return array Nightlife venue data
 */
function getNightlifeVenues() {
    $filePath = __DIR__ . '/../data/nightlife.json';
    
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $venues = json_decode($jsonData, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $venues;
        }
    }
    
    // Return default data if JSON file is unavailable or invalid
    return [
        [
            'id' => 1,
            'name' => 'Alchemist',
            'type' => 'Bar & Club',
            'location' => 'Westlands',
            'description' => 'A trendy outdoor venue with multiple bars, food trucks, and a dance floor. Features street art, repurposed shipping containers, and hosts local and international DJs playing electronic and hip-hop music.',
            'vibe_rating' => 5,
            'hours' => '5:00 PM - 3:00 AM',
            'music' => 'Electronic & Hip-Hop',
            'image_url' => 'https://source.unsplash.com/800x600/?nightclub,outdoor',
            'features' => ['Outdoor Space', 'Food Trucks', 'Live DJs', 'Craft Cocktails'],
            'entry_fee' => 'Free - 1000 KSh (event dependent)',
            'dress_code' => 'Casual'
        ],
        [
            'id' => 2,
            'name' => 'Mercury Lounge',
            'type' => 'Rooftop Bar',
            'location' => 'Kilimani',
            'description' => 'Upscale rooftop bar and lounge offering panoramic views of Nairobi\'s skyline. Known for its sophisticated ambiance, premium cocktails, and weekend DJ sets featuring house and afrobeats.',
            'vibe_rating' => 4,
            'hours' => '4:00 PM - 2:00 AM',
            'music' => 'House & Afrobeats',
            'image_url' => 'https://source.unsplash.com/800x600/?rooftop,bar',
            'features' => ['Skyline Views', 'VIP Sections', 'Signature Cocktails', 'Hookah'],
            'entry_fee' => 'Free (may have minimum spend)',
            'dress_code' => 'Smart Casual'
        ],
        [
            'id' => 3,
            'name' => 'Havana',
            'type' => 'Nightclub',
            'location' => 'Westlands',
            'description' => 'Legendary nightclub that has been a cornerstone of Nairobi\'s nightlife for years. Multiple dance floors playing different music genres, with a focus on African and Latin beats. Known for its energetic atmosphere.',
            'vibe_rating' => 5,
            'hours' => '9:00 PM - 4:00 AM',
            'music' => 'Afrobeats & Latin',
            'image_url' => 'https://source.unsplash.com/800x600/?nightclub,dance',
            'features' => ['Multiple Dance Floors', 'VIP Bottle Service', 'Theme Nights', 'Ladies\' Night Wednesdays'],
            'entry_fee' => '500-1000 KSh',
            'dress_code' => 'Smart Casual'
        ],
        [
            'id' => 4,
            'name' => 'Brew Bistro & Lounge',
            'type' => 'Craft Beer Bar',
            'location' => 'Westlands',
            'description' => 'Popular microbrewery and bar offering house-brewed craft beers, gourmet food, and regular live music. The rooftop setting creates a perfect urban oasis for after-work drinks and weekend socializing.',
            'vibe_rating' => 4,
            'hours' => '12:00 PM - 1:00 AM',
            'music' => 'Live Bands & DJ Sets',
            'image_url' => 'https://source.unsplash.com/800x600/?craft,beer',
            'features' => ['House-brewed Beer', 'Live Music', 'Food Menu', 'Sports Screenings'],
            'entry_fee' => 'Free (Sometimes cover for events)',
            'dress_code' => 'Casual'
        ],
        [
            'id' => 5,
            'name' => 'Kiza Lounge',
            'type' => 'African Lounge & Club',
            'location' => 'Kilimani',
            'description' => 'Upscale Pan-African lounge and nightclub showcasing the best of African entertainment, cuisine, and culture. Features top DJs and occasionally hosts African celebrities and artists.',
            'vibe_rating' => 5,
            'hours' => '5:00 PM - 3:00 AM',
            'music' => 'Afrobeats & African Fusion',
            'image_url' => 'https://source.unsplash.com/800x600/?lounge,luxury',
            'features' => ['African Cuisine', 'VIP Areas', 'Celebrity Performances', 'Themed Nights'],
            'entry_fee' => '500-2000 KSh (depending on event)',
            'dress_code' => 'Smart & Stylish'
        ],
        [
            'id' => 6,
            'name' => 'Gipsy Bar',
            'type' => 'Bar & Club',
            'location' => 'Westlands',
            'description' => 'Long-standing bar and nightclub popular with locals and expats alike. Known for its unpretentious vibe, affordable drinks, and dance floor that gets packed on weekends with a mix of international hits and African beats.',
            'vibe_rating' => 4,
            'hours' => '6:00 PM - 3:00 AM',
            'music' => 'Mixed International & African',
            'image_url' => 'https://source.unsplash.com/800x600/?bar,dancing',
            'features' => ['Dance Floor', 'Pool Tables', 'Outdoor Seating', 'Classic Cocktails'],
            'entry_fee' => 'Free - 500 KSh',
            'dress_code' => 'Casual'
        ],
        [
            'id' => 7,
            'name' => 'J\'s Fresh Bar & Kitchen',
            'type' => 'Bar & Restaurant',
            'location' => 'Karen',
            'description' => 'Laid-back bar and restaurant with a beautiful garden setting. Offers craft cocktails, an extensive food menu, and regular events including quiz nights, live acoustic sets, and weekend DJ performances.',
            'vibe_rating' => 3,
            'hours' => '11:00 AM - 12:00 AM',
            'music' => 'Varied - Jazz, Acoustic, DJ Sets',
            'image_url' => 'https://source.unsplash.com/800x600/?garden,bar',
            'features' => ['Garden Seating', 'Craft Cocktails', 'Full Menu', 'Live Music'],
            'entry_fee' => 'Free',
            'dress_code' => 'Casual'
        ],
        [
            'id' => 8,
            'name' => 'Milan',
            'type' => 'Nightclub',
            'location' => 'CBD',
            'description' => 'Vibrant downtown nightclub across multiple floors, playing everything from local Kenyan hits to international chart-toppers. Known for its energetic crowd and themed nights.',
            'vibe_rating' => 4,
            'hours' => '8:00 PM - 4:00 AM',
            'music' => 'Mixed - Top 40, Bongo, Genge',
            'image_url' => 'https://source.unsplash.com/800x600/?nightclub,party',
            'features' => ['Multiple Floors', 'Ladies\' Night', 'Birthday Packages', 'Late-night Food'],
            'entry_fee' => '300-500 KSh',
            'dress_code' => 'Smart Casual'
        ],
        [
            'id' => 9,
            'name' => 'The Alchemist Bar',
            'type' => 'Art & Music Venue',
            'location' => 'Westlands',
            'description' => 'Creative hub combining art, music, food, and drinks in a repurposed industrial space. Hosts local and international artists, workshops, markets, and themed events alongside everyday drinking and dining.',
            'vibe_rating' => 5,
            'hours' => '12:00 PM - 1:00 AM',
            'music' => 'Eclectic - Afro House, Hip-Hop, Alternative',
            'image_url' => 'https://source.unsplash.com/800x600/?art,bar',
            'features' => ['Art Installations', 'Multiple Bars', 'Food Court', 'Markets & Events'],
            'entry_fee' => 'Free (Events may have cover)',
            'dress_code' => 'Creative Casual'
        ]
    ];
}

/**
 * Get all matatu culture content from JSON file
 * 
 * @return array Matatu culture data
 */
function getMatatuCulture() {
    $filePath = __DIR__ . '/../data/matatu.json';
    
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $matatus = json_decode($jsonData, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $matatus;
        }
    }
    
    // Return default data if JSON file is unavailable or invalid
    return [
        [
            'id' => 1,
            'name' => 'Matwana Matatu Culture',
            'route' => 'Route 105',
            'route_description' => 'Kikuyu to CBD',
            'art_style' => 'Urban Graffiti',
            'music_system' => 'Premium Sound',
            'description' => 'More than just public transport, this matatu celebrates urban youth culture with elaborate graffiti featuring global hip-hop icons, powerful sound systems, and LED lighting throughout the interior and exterior.',
            'designer' => 'Moha Graff',
            'year' => '2022',
            'image_url' => 'https://source.unsplash.com/800x600/?bus,graffiti',
            'art_features' => ['Celebrity Portraits', 'LED Lighting', 'Custom Seats'],
            'notable_for' => 'Won "Best Design" at the 2022 Nairobi Matatu Awards'
        ],
        [
            'id' => 2,
            'name' => 'Hot Rod',
            'route' => 'Route 46',
            'route_description' => 'Ngong Road to CBD',
            'art_style' => 'Motorsport Themed',
            'music_system' => 'Booming Bass',
            'description' => 'Racing-inspired matatu with flame decals, racing stripes, and automotive imagery. Interior features race-car style seats, Formula 1 memorabilia, and screens playing motorsport highlights.',
            'designer' => 'SpeedMods Garage',
            'year' => '2021',
            'image_url' => 'https://source.unsplash.com/800x600/?racing,bus',
            'art_features' => ['Racing Stripes', 'Custom Exhaust', 'Race-inspired Interior'],
            'notable_for' => 'Holds record for most subwoofers installed in a Nairobi matatu (12)'
        ],
        [
            'id' => 3,
            'name' => 'Marvel Universe',
            'route' => 'Route 23',
            'route_description' => 'Rongai to CBD',
            'art_style' => 'Superhero Comics',
            'music_system' => 'Theater Quality',
            'description' => 'Comic book lovers\' dream, featuring hand-painted Marvel superheroes across its exterior. Interior designed like a mobile cinema with multiple screens playing superhero movies and a premium sound system.',
            'designer' => 'ComicArt Collective',
            'year' => '2023',
            'image_url' => 'https://source.unsplash.com/800x600/?comics,superhero',
            'art_features' => ['Airbrushed Characters', 'Movie Screens', 'Comic Book Interior'],
            'notable_for' => 'Featured in Marvel\'s promotional campaign for Black Panther: Wakanda Forever'
        ],
        [
            'id' => 4,
            'name' => 'Wakanda Express',
            'route' => 'Route 125',
            'route_description' => 'Kasarani to CBD',
            'art_style' => 'Afrofuturism',
            'music_system' => 'Digital Surround',
            'description' => 'Celebrating African excellence with Black Panther-inspired artwork combined with traditional Kenyan symbolism. Features Afrobeats playlists and screens showcasing African innovation and technology.',
            'designer' => 'Afri-Designs',
            'year' => '2020',
            'image_url' => 'https://source.unsplash.com/800x600/?africa,technology',
            'art_features' => ['Wakandan Symbols', 'Tribal Patterns', 'Black Panther Tribute'],
            'notable_for' => 'Collaborated with local tech startups to showcase Kenyan innovation'
        ],
        [
            'id' => 5,
            'name' => 'Reggae Roots',
            'route' => 'Route 58',
            'route_description' => 'Eastleigh to CBD',
            'art_style' => 'Jamaican Inspired',
            'music_system' => 'Bass Heavy',
            'description' => 'Tribute to reggae culture with Bob Marley portraits, Jamaican flag colors, and lion of Judah imagery. Interior features wooden panels, reggae memorabilia, and exclusive reggae and dancehall playlists.',
            'designer' => 'RastaCreations',
            'year' => '2019',
            'image_url' => 'https://source.unsplash.com/800x600/?reggae,jamaica',
            'art_features' => ['Rasta Colors', 'Bob Marley Portraits', 'Lion of Judah Symbols'],
            'notable_for' => 'Official transport for reggae festivals in Nairobi'
        ],
        [
            'id' => 6,
            'name' => 'Nairobi Hustler',
            'route' => 'Route 35',
            'route_description' => 'Kawangware to CBD',
            'art_style' => 'Street Life',
            'music_system' => 'Urban Beats',
            'description' => 'Celebrates Nairobi\'s entrepreneurial spirit with urban landscape murals depicting city hustle and iconic landmarks. Features motivational quotes and success stories of Kenyan entrepreneurs.',
            'designer' => 'Street Dreams Collective',
            'year' => '2021',
            'image_url' => 'https://source.unsplash.com/800x600/?urban,city',
            'art_features' => ['City Skyline', 'Entrepreneur Portraits', 'Motivational Quotes'],
            'notable_for' => 'Runs a mentorship program for young entrepreneurs among its regular passengers'
        ],
        [
            'id' => 7,
            'name' => 'Game On',
            'route' => 'Route 111',
            'route_description' => 'Kitengela to CBD',
            'art_style' => 'Video Game Themed',
            'music_system' => 'Arcade Quality',
            'description' => 'Gaming-inspired matatu with artwork featuring popular video game characters from Fortnite, Call of Duty, and FIFA. Interior includes actual gaming consoles for passengers to play during their commute.',
            'designer' => 'Gamer\'s Garage',
            'year' => '2022',
            'image_url' => 'https://source.unsplash.com/800x600/?videogame,gaming',
            'art_features' => ['Game Characters', 'Console Stations', 'Gaming Sound Effects'],
            'notable_for' => 'Hosts mobile gaming tournaments during traffic jams'
        ],
        [
            'id' => 8,
            'name' => 'Kenya Pride',
            'route' => 'Route 44',
            'route_description' => 'Thika Road to CBD',
            'art_style' => 'Kenyan Heritage',
            'music_system' => 'Traditional Fusion',
            'description' => 'Celebrates Kenyan culture with artwork featuring the Big Five animals, Maasai warriors, and national symbols. Interior decorated with traditional fabrics and plays a mix of contemporary and traditional Kenyan music.',
            'designer' => 'Heritage Arts Kenya',
            'year' => '2020',
            'image_url' => 'https://source.unsplash.com/800x600/?kenya,wildlife',
            'art_features' => ['Wildlife Murals', 'Maasai Patterns', 'National Flag Colors'],
            'notable_for' => 'Official partner for tourism campaigns and cultural events'
        ],
        [
            'id' => 9,
            'name' => 'Bongo Flava',
            'route' => 'Route 14',
            'route_description' => 'South B to CBD',
            'art_style' => 'East African Music',
            'music_system' => 'Studio Quality',
            'description' => 'Dedicated to East African music culture with portraits of famous artists from Kenya, Tanzania, and Uganda. Features exclusive playlists, occasional live performances, and music memorabilia from the region.',
            'designer' => 'BongoArt Studios',
            'year' => '2021',
            'image_url' => 'https://source.unsplash.com/800x600/?music,african',
            'art_features' => ['Artist Portraits', 'Instrument Motifs', 'Record Graphics'],
            'notable_for' => 'Regular venue for new music releases by local artists'
        ]
    ];
}

/**
 * Save data to a JSON file
 * 
 * @param string $filename The name of the file
 * @param array $data The data to save
 * @return boolean True if successful, false otherwise
 */
function saveJsonData($filename, $data) {
    $filePath = __DIR__ . '/../data/' . $filename;
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    
    // Create directory if it doesn't exist
    if (!is_dir(dirname($filePath))) {
        mkdir(dirname($filePath), 0755, true);
    }
    
    $result = file_put_contents($filePath, $jsonData);
    return ($result !== false);
}

/**
 * Initialize default data if JSON files don't exist
 */
/**
 * Get all attractions from JSON file
 * 
 * @return array Attractions data
 */
function getAttractions() {
    $filePath = __DIR__ . '/../data/attractions.json';
    
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $attractions = json_decode($jsonData, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $attractions;
        }
    }
    
    // Return empty array if JSON file is unavailable or invalid
    return [];
}

/**
 * Get all events from JSON file
 * 
 * @return array Events data
 */
function getEvents() {
    $filePath = __DIR__ . '/../data/events.json';
    
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $events = json_decode($jsonData, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $events;
        }
    }
    
    // Return empty array if JSON file is unavailable or invalid
    return [];
}

/**
 * Get all news items from JSON file
 * 
 * @return array News data
 */
function getNews() {
    $filePath = __DIR__ . '/../data/news.json';
    
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $news = json_decode($jsonData, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $news;
        }
    }
    
    // Return empty array if JSON file is unavailable or invalid
    return [];
}

/**
 * Get paginated data from an array
 * 
 * @param array $data Full data array
 * @param int $page Current page number (1-based)
 * @param int $itemsPerPage Number of items per page
 * @return array Contains paginated data, pagination info, and total pages
 */
function getPaginatedData($data, $page = 1, $itemsPerPage = 6) {
    // Ensure page is at least 1
    $page = max(1, intval($page));
    
    // Calculate total pages
    $totalItems = count($data);
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Ensure page doesn't exceed total pages
    $page = min($page, max(1, $totalPages));
    
    // Get the slice of data for the current page
    $offset = ($page - 1) * $itemsPerPage;
    $paginatedData = array_slice($data, $offset, $itemsPerPage);
    
    // Return both the paginated data and pagination metadata
    return [
        'data' => $paginatedData,
        'pagination' => [
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
            'itemsPerPage' => $itemsPerPage,
            'hasNextPage' => $page < $totalPages,
            'hasPrevPage' => $page > 1
        ]
    ];
}

/**
 * Get all fun things to do from JSON file
 * 
 * @return array Fun Things data
 */
function getFunThingsData() {
    $filePath = __DIR__ . '/../data/fun-things.json';
    
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $funThings = json_decode($jsonData, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $funThings;
        }
    }
    
    // Return empty array if file doesn't exist or is invalid
    return [];
}

function initializeDefaultData() {
    // Initialize restaurants data
    if (!file_exists(__DIR__ . '/../data/restaurants.json')) {
        saveJsonData('restaurants.json', getRestaurants());
    }
    
    // Initialize nightlife venues data
    if (!file_exists(__DIR__ . '/../data/nightlife.json')) {
        saveJsonData('nightlife.json', getNightlifeVenues());
    }
    
    // Initialize matatu culture data
    if (!file_exists(__DIR__ . '/../data/matatu.json')) {
        saveJsonData('matatu.json', getMatatuCulture());
    }
    
    // Initialize attractions data
    if (!file_exists(__DIR__ . '/../data/attractions.json')) {
        saveJsonData('attractions.json', getAttractions());
    }
    
    // Initialize events data
    if (!file_exists(__DIR__ . '/../data/events.json')) {
        saveJsonData('events.json', getEvents());
    }
    
    // Initialize news data
    if (!file_exists(__DIR__ . '/../data/news.json')) {
        saveJsonData('news.json', getNews());
    }
    
    // Initialize fun things data
    if (!file_exists(__DIR__ . '/../data/fun-things.json')) {
        saveJsonData('fun-things.json', getFunThingsData());
    }
}

// Initialize default data when the file is included
initializeDefaultData();
