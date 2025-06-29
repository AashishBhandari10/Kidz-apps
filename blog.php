<?php
include 'header.php';

$stmt = $pdo->query("SELECT * FROM blog_posts ORDER BY post_date DESC LIMIT 5");
$blog_posts = $stmt->fetchAll();
?>

<h1 class="text-center">Kidz-Apps Blog</h1>

<div class="text-center mb-4">
    <a href="post_blog.php" class="btn btn-primary">Post Your Blog</a>
</div>

<div class="row">
    <?php foreach ($blog_posts as $post): ?>
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Posted on <?= date('F j, Y', strtotime($post['post_date'])) ?></h6>
                <p class="card-text"><?= substr(htmlspecialchars($post['content']), 0, 200) ?>...</p>
                <a href="blog_post.php?id=<?= $post['id'] ?>" class="card-link">Read More</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
