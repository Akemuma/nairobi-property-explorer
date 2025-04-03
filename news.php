<?php
/**
 * Nairobi Pulse - News Page
 */

// Include database functions
require_once('includes/db.php');

// Get current page from query string
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Get news data
$allNews = getNews();

// Get search query and category filter if set
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Filter data based on search and category if provided
if (!empty($search) || !empty($category)) {
  $filteredNews = [];
  
  foreach ($allNews as $news) {
    $matchesSearch = empty($search) || 
                     stripos($news['title'], $search) !== false || 
                     stripos($news['content'], $search) !== false || 
                     stripos($news['summary'], $search) !== false;
                     
    $matchesCategory = empty($category) || 
                      ($news['category'] == $category);
    
    if ($matchesSearch && $matchesCategory) {
      $filteredNews[] = $news;
    }
  }
  
  $allNews = $filteredNews;
}

// Get unique categories for filter dropdown
$categories = [];
foreach (getNews() as $news) {
  if (!in_array($news['category'], $categories)) {
    $categories[] = $news['category'];
  }
}
sort($categories);

// Get paginated news
$result = getPaginatedData($allNews, $page);
$news = $result['data'];
$pagination = $result['pagination'];

// Include header
include('includes/header.php');
?>
<br>
<br>
<br>
<!-- Page Header -->
<div class="page-header" style="background-image: url('https://source.unsplash.com/1600x900/?nairobi,news');">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Nairobi News</h1>
        <p>Stay updated with the latest news and developments in Nairobi</p>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<section class="content-section">
  <div class="container">
    <!-- Filters Row -->
    <div class="row mb-4">
      <div class="col-md-8">
        <form id="search-form" class="d-flex flex-wrap gap-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search news..." name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
          </div>
          
          <select class="form-select" name="category" id="category-filter" style="max-width: 200px;">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo ($category == $cat) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($cat); ?>
              </option>
            <?php endforeach; ?>
          </select>
          
          <?php if (!empty($search) || !empty($category)): ?>
            <a href="news.php" class="btn btn-outline-secondary">Clear Filters</a>
          <?php endif; ?>
        </form>
      </div>
      <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <p class="mb-0">Showing <?php echo count($news); ?> of <?php echo $pagination['totalItems']; ?> news articles</p>
      </div>
    </div>
    
    <!-- News Grid -->
    <div class="row" id="news-grid">
      <?php if (count($news) > 0): ?>
        <?php foreach ($news as $item): ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card news-card h-100">
              <img src="<?php echo htmlspecialchars($item['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['title']); ?>">
              <div class="card-body">
                <div class="category-badge"><?php echo htmlspecialchars($item['category']); ?></div>
                <h3 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                <p class="card-text"><?php echo htmlspecialchars($item['summary']); ?></p>
                <div class="news-meta">
                  <span><i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($item['date']); ?></span>
                  <span><i class="far fa-user"></i> <?php echo htmlspecialchars($item['author']); ?></span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <button type="button" class="btn btn-link p-0 read-more" data-bs-toggle="modal" data-bs-target="#newsModal<?php echo $item['id']; ?>">
                  Read More <i class="fas fa-arrow-right ms-1"></i>
                </button>
              </div>
            </div>
          </div>
          
          <!-- News Modal -->
          <div class="modal fade" id="newsModal<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="newsModalLabel<?php echo $item['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="newsModalLabel<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['title']); ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <img src="<?php echo htmlspecialchars($item['image_url']); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($item['title']); ?>">
                  <div class="news-meta mb-3">
                    <span class="badge bg-primary"><?php echo htmlspecialchars($item['category']); ?></span>
                    <span><i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($item['date']); ?></span>
                    <span><i class="far fa-user"></i> <?php echo htmlspecialchars($item['author']); ?></span>
                  </div>
                  <p><?php echo nl2br(htmlspecialchars($item['content'])); ?></p>
                  
                  <?php if (!empty($item['tags'])): ?>
                  <div class="news-tags mt-4">
                    <strong>Tags:</strong>
                    <?php foreach ($item['tags'] as $tag): ?>
                      <span class="badge bg-secondary"><?php echo htmlspecialchars($tag); ?></span>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <a href="#" class="btn btn-primary share-news">Share</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      
      <?php else: ?>
        <!-- Empty Results Message -->
        <div id="no-results" class="col-12 text-center py-5">
          <div class="no-results-container">
            <i class="fas fa-newspaper fa-3x mb-3 text-muted"></i>
            <h3>No news found</h3>
            <p>Try adjusting your filters or search criteria</p>
            <a href="news.php" class="btn btn-primary">Clear Filters</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
    
    <!-- Pagination -->
    <?php if ($pagination['totalPages'] > 1): ?>
    <div class="row mt-4">
      <div class="col-12">
        <nav aria-label="News pagination">
          <ul class="pagination justify-content-center">
            <?php if ($pagination['hasPrevPage']): ?>
              <li class="page-item">
                <a class="page-link" href="news.php?page=<?php echo $pagination['currentPage'] - 1; ?><?php echo (!empty($search) ? '&search=' . urlencode($search) : ''); ?><?php echo (!empty($category) ? '&category=' . urlencode($category) : ''); ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
            <?php else: ?>
              <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
              <li class="page-item <?php echo ($i == $pagination['currentPage']) ? 'active' : ''; ?>">
                <a class="page-link" href="news.php?page=<?php echo $i; ?><?php echo (!empty($search) ? '&search=' . urlencode($search) : ''); ?><?php echo (!empty($category) ? '&category=' . urlencode($category) : ''); ?>">
                  <?php echo $i; ?>
                </a>
              </li>
            <?php endfor; ?>
            
            <?php if ($pagination['hasNextPage']): ?>
              <li class="page-item">
                <a class="page-link" href="news.php?page=<?php echo $pagination['currentPage'] + 1; ?><?php echo (!empty($search) ? '&search=' . urlencode($search) : ''); ?><?php echo (!empty($category) ? '&category=' . urlencode($category) : ''); ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            <?php else: ?>
              <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
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

<script>
  // Initialize filters
  document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when category changes
    document.getElementById('category-filter').addEventListener('change', function() {
      document.getElementById('search-form').submit();
    });
  });
</script>

<!-- Include footer -->
<?php include('includes/footer.php'); ?>