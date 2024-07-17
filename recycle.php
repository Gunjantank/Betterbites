<?php include 'donateheader.php'; ?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <button class="btn btn-primary btn-lg" id="requestPickupButton">Request for a Pickup</button>
    </div>

    <div class="info-section mb-5 text-center">
        <h2 class="mb-4">Recycle Your Food</h2>
        <p>Not only can you donate food, but you can also contribute to environmental sustainability by recycling food. Contact fertilizing companies or organizations that specialize in converting food waste into valuable resources such as compost. This helps reduce food waste and supports eco-friendly practices.</p>
        <p>For more information on how you can recycle food, please reach out to:</p>
        <ul class="list-unstyled">
            <li><strong>Eco Compost Solutions:</strong> info@ecocompost.com | +1-800-123-4567</li>
            <li><strong>Green Fertilizers Co:</strong> contact@greenfertilizers.org | +1-800-765-4321</li>
            <li><strong>Nature's Waste Management:</strong> support@natureswaste.org | +1-800-555-5555</li>
        </ul>
    </div>

    <div class="ngos-list">
        <h2 class="text-center">Our Partner NGOs</h2>
        <div class="row">
            <?php
            // Example NGOs list
            $ngos = [
                ['name' => 'Green Earth Foundation', 'contact' => '123-456-7890', 'email' => 'info@greenearth.org'],
                ['name' => 'Save The Environment', 'contact' => '987-654-3210', 'email' => 'contact@savetheenv.org'],
                ['name' => 'Eco Warriors', 'contact' => '555-555-5555', 'email' => 'support@ecowarriors.org'],
            ];

            foreach ($ngos as $ngo) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($ngo['name']) . '</h5>
                            <p class="card-text"><strong>Contact:</strong> ' . htmlspecialchars($ngo['contact']) . '</p>
                            <p class="card-text"><strong>Email:</strong> <a href="mailto:' . htmlspecialchars($ngo['email']) . '">' . htmlspecialchars($ngo['email']) . '</a></p>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

<?php include 'webfooter.php'; ?>

<!-- CSS Styles for the Recycle Page -->
<style>
    .container {
        max-width: 1200px;
    }
    .btn-primary {
        background-color: #ff7e5f;
        border-color: #ff7e5f;
    }
    .btn-primary:hover {
        background-color: #ff6f4e;
        border-color: #ff6f4e;
    }
    .info-section {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 30px;
        margin-bottom: 50px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .info-section h2 {
        font-size: 2rem;
        color: #333;
    }
    .info-section p {
        font-size: 1.2rem;
        color: #666;
    }
    .info-section ul {
        list-style: none;
        padding: 0;
    }
    .info-section li {
        font-size: 1.1rem;
        color: #444;
    }
    .ngos-list {
        margin-top: 50px;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-body {
        padding: 20px;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }
    .card-text {
        font-size: 1rem;
    }
    a {
        color: #007bff;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
