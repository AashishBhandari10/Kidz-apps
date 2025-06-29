<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    header('Location: products.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$_GET['id']]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: products.php');
    exit();
}

// Function to get video details from YouTube API
function getYouTubeVideoDetails($videoId, $apiKey) {
    $apiUrl = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$videoId}&key={$apiKey}";
    
    $response = @file_get_contents($apiUrl);
    if ($response === false) {
        return null;
    }
    
    $data = json_decode($response, true);
    
    if (isset($data['items'][0]['snippet'])) {
        return $data['items'][0]['snippet'];
    }
    
    return null;
}

// Get video details if YouTube ID is available
$videoDetails = null;
if (!empty($product['youtube_id'])) {
    $videoDetails = getYouTubeVideoDetails($product['youtube_id'], YOUTUBE_API_KEY);
}

// Prepare image path
$imagePath = 'images/' . strtolower(str_replace(' ', '_', $product['name'])) . '.png';
$imageUrl = file_exists($imagePath) ? $imagePath : 'images/placeholder.png';
?>

<h1><?= htmlspecialchars($product['name']) ?></h1>

<div class="row">
    <div class="col-md-6">
        <img src="<?= htmlspecialchars($imageUrl) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="col-md-6">
        <p><?= htmlspecialchars($product['description']) ?></p>
        <p><strong>Price: $<?= number_format($product['price'], 2) ?></strong></p>
        <a href="order.php?product_id=<?= $product['id'] ?>" class="btn btn-primary">Order Now</a>
    </div>
</div>

<?php if ($videoDetails): ?>
<div class="row mt-5">
    <div class="col-md-12">
        <h2>App Demo Video</h2>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= htmlspecialchars($product['youtube_id']) ?>" allowfullscreen></iframe>
        </div>
        <h3><?= htmlspecialchars($videoDetails['title']) ?></h3>
        <p><?= htmlspecialchars($videoDetails['description']) ?></p>
    </div>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>