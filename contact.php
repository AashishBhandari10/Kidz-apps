<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $recaptcha = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $secretKey = "your_recaptcha_secret_key";
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$recaptcha);
    $responseData = json_decode($verifyResponse);

    if($responseData->success) {
        $stmt = $pdo->prepare("INSERT INTO enquiries (name, email, message, enquiry_date) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$name, $email, $message]);

        // Send email notification
        $to = "admin@kidz-apps.com";
        $subject = "New Enquiry from Kidz-Apps";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        mail($to, $subject, $body);

        echo "<div class='alert alert-success'>Thank you for your enquiry. We'll get back to you soon!</div>";
    } else {
        echo "<div class='alert alert-danger'>reCAPTCHA verification failed. Please try again.</div>";
    }
}
?>

<h1 class="text-center">Contact Us</h1>

<div class="row">
    <div class="col-md-6">
        <form method="post" class="mt-4">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Your Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="g-recaptcha mb-3" data-sitekey="your_recaptcha_site_key"></div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
    <div class="col-md-6">
        <h3>Our Location</h3>
        <div id="map" style="height: 400px;"></div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAPS_API_KEY ?>&callback=initMap" async defer></script>
<script>
function initMap() {
    var location = {lat: 25.276987, lng: 55.296249}; // Dubai, UAE coordinates
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: location
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}
</script>


<?php include 'footer.php'; ?>