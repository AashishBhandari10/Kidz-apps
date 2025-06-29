<?php 
include 'header.php';
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>
<h1 class="text-center">Our Apps</h1>
<div class="row">
    <?php foreach ($products as $product): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <?php
            $imagePath = 'images/' . strtolower(str_replace(' ', '_', $product['name'])) . '.png';
            $imageUrl = file_exists($imagePath) ? $imagePath : 'images/placeholder.png';
            ?>
            <img src="<?= htmlspecialchars($imageUrl) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                <p class="card-text"><strong>Price: $<?= number_format($product['price'], 2) ?></strong></p>
                <a href="product_detail.php?id=<?= $product['id'] ?>" class="btn btn-primary mt-auto">Purchase app</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php include 'footer.php'; ?>