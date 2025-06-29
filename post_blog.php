<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Prepare and execute the query to insert the new blog post
    $stmt = $pdo->prepare("INSERT INTO blog_posts (title, content, post_date) VALUES (?, ?, NOW())");
    $stmt->execute([$title, $content]);

    // Redirect to the blog page
    header('Location: blog.php');
    exit();
}
?>

<h1 class="text-center">Post Your Blog</h1>

<div class="row justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="post_blog.php">
            <div class="form-group">
                <label for="title">Blog Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Blog Content</label>
                <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Blog</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
