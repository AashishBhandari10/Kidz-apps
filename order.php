<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_email, product_id, quantity, order_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$customer_name, $customer_email, $product_id, $quantity]);

    echo "<div class='alert alert-success'>Your order has been placed successfully!</div>";
}

$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
$product = null;
if ($product_id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
}
?>

<h1 class="text-center">Place an Order</h1>

<form method="post" class="mt-4">
    <div class="mb-3">
        <label for="customer_name" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
    </div>
    <div class="mb-3">
        <label for="customer_email" class="form-label">Your Email</label>
        <input type="email" class="form-control" id="customer_email" name="customer_email" required>
    </div>
    <div class="mb-3">
        <label for="product_id" class="form-label">Select Product</label>
        <select class="form-control" id="product_id" name="product_id" required>
            <?php
            $stmt = $pdo->query("SELECT id, name FROM products");
            while ($row = $stmt->fetch()) {
                $selected = ($row['id'] == $product_id) ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
    </div>
    <button type="submit" class="btn btn-primary">Place Order</button>
</form>

<?php include 'footer.php'; ?>