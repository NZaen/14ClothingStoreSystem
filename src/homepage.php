<?php
    include_once 'header.php';
?>

    <!-- Carousel Images -->
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="Assets/bg-img/bg-img1.jpg" class="d-block w-100 vh-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="Assets/bg-img/bg-img4.jpg" class="d-block w-100 vh-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="Assets/bg-img/bg-img3.jpg" class="d-block w-100 vh-100" alt="...">
            </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

        <!-- Image Showcases-->
        <section class="showcase" id="about">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img"><img class="d-block w-100" src="Assets/bg-img/bg-img2.jpg" alt="..."></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text text-center">
                        <h2 class="display-5">A Style For Every Story</h2>
                        <p class="lead mb-0">Life is too short for bad fashion, Our styles are both refined and fashion-forward, Find a nice outfit for any occasion, Keep the styles exclusive and the prices fair.</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white showcase-img"><img class="d-block w-100" src="Assets/bg-img/bg-img5.jpg" alt="..."></div>
                    <div class="col-lg-6 my-auto showcase-text text-center">
                        <h2 class="display-5">Fresh Styles. Fresh Look.</h2>
                        <p class="lead mb-0">The style shouldn’t be dictated by a price tag, we crave exclusivity, We offer the latest trends, hand-picked by our designers.</p>
                    </div>
                </div>
                <div class="row g-0 shadow">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img"><img class="d-block w-100" src="Assets/bg-img/bg-img6.jpg" alt="..."></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text text-center">
                        <h2 class="display-4">Just Feels Right</h2>
                        <p class="lead mb-0">Adorn yourself with gorgeous pieces and accessories, Find a style for every taste and budget, Affordable fashion that fits your lifestyle, Find your fit, Find your style, Find it here!</p>
                    </div>
                </div>
            </div>
        </section>

<?php
    include_once 'footer.php'
?>