<?php
include 'header.php';

if (!isset($_GET['id'])) {
    header('Location: blog.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
$stmt->execute([$_GET['id']]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: blog.php');
    exit();
}
?>

<h1><?= htmlspecialchars($post['title']) ?></h1>
<p class="text-muted">Posted on <?= date('F j, Y', strtotime($post['post_date'])) ?></p>

<div class="blog-content">
    <?= nl2br(htmlspecialchars($post['content'])) ?>
</div>

<div class="mt-4">
    <h3>Share this post</h3>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" class="btn btn-primary" target="_blank">Share on Facebook</a>
    <a href="https://twitter.com/intent/tweet?url=<?= urlencode('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>&text=<?= urlencode($post['title']) ?>" class="btn btn-info" target="_blank">Share on Twitter</a>
</div>

<?php include 'footer.php'; ?>