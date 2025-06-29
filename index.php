<?php include 'header.php'; ?>

<h1 class="text-center">Welcome to Kidz-Apps!</h1>
<p class="text-center">Discover our amazing educational and healthy eating apps for children.</p>

<div class="row mt-5">
    <div class="col-md-6">
        <h2>Featured App</h2>
        <div class="card">
            <img src="images/healthy_eats_adventure.png" class="card-img-top" alt="Healthy Eats Adventure">
            <div class="card-body">
                <h5 class="card-title">Healthy Eats Adventure</h5>
                <p class="card-text">Join Veggie Heroes on a journey to learn about nutritious foods!</p>
                <a href="products.php" class="btn btn-primary">Learn More</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h2>Latest News</h2>
        <ul class="list-group">
            <li class="list-group-item">New Math Wizard app coming soon!</li>
            <li class="list-group-item">Healthy Eats Adventure wins Parent's Choice Award</li>
            <li class="list-group-item">Summer sale: 30% off all apps!</li>
        </ul>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12">
        <h2>What Parents Say</h2>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <blockquote class="blockquote">
                        <p>"My kids love the Healthy Eats Adventure app! They're now excited about eating vegetables!"</p>
                        <footer class="blockquote-footer">Sarah, mother of two</footer>
                    </blockquote>
                </div>
                <div class="carousel-item">
                    <blockquote class="blockquote">
                        <p>"Math Wizard has made learning fun for my son. His grades have improved significantly!"</p>
                        <footer class="blockquote-footer">John, father of one</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>