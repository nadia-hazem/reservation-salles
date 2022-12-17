<!-- INDEX PAGE -->

<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?> <!--connexion à la base de données-->

    <main>
    
    <div class="hero-container">
        <div class="hero">            
        </div>
        <div class="hero-stuff">
            <img src="img/logo.png" width="60px" alt="logo">
            <h1 class="hero-title">SmartOffice</h1>
            <a class="btn" href="planning.php">Réservez maintenant</a>
        </div>
    </div>

    <div class="container">
        <div class="pitch">
            <h3>Réservez en ligne, une salle de réunion équipée, en fonction de vos besoins et de vos disponibilités. </h3>
        </div>
    </div>

    <div class="container">
        <div class="row  align-items-stretch">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="img/locate.svg" class="card-img-left" width="50px" alt="Le lieu idéal">
                        <h5 class="card-title">Trouvez votre lieu idéal</h5>
                        <p class="card-text">Trouvez la salle de réunion qui vous convient, équipée en fonction de vos besoins et de vos disponibilités.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="img/service.svg" class="card-img-left" width="50px" alt="Clé en main">
                        <h5 class="card-title">Profitez d'un service clé en main"</h5>
                        <p class="card-text">Nous nous occupons de tout, de la réservation à la mise à disposition de la salle.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="img/price.svg" class="card-img-left" width="50px" alt="Bénéficiez des meilleurs prix">
                        <h5 class="card-title">Bénéficiez des meilleurs prix</h5>
                        Profitez de tarifs négociés et dégressifs ainsi que du service de réservation gratuit en ligne. 
                    </div>
                </div>
            </div>
        </div> <!-- end row -->

        <h1 class="text-center mx-auto p-5 text-secondary">Ils nous font confiance</h1>
        <div class="brands_slider_container my-5">
            <div id="carousel-brands" class="carousel slide" id="transition"  data-ride="carousel">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">

                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                        <img src="img/apple.svg" class="img-fluid mx-auto d-block" alt="img1">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="img/amazon.svg" class="img-fluid mx-auto d-block" alt="img2">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="img/adidas.svg" class="img-fluid mx-auto d-block" alt="img3">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="img/fedex.svg" class="img-fluid mx-auto d-block" alt="img4">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="img/boeing.svg" class="img-fluid mx-auto d-block" alt="img5">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="img/gucci.svg" class="img-fluid mx-auto d-block" alt="img6">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="img/lexus.svg" class="img-fluid mx-auto d-block" alt="img7">
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="img/mo.svg" class="img-fluid mx-auto d-block" alt="img8">
                    </div>
                </div>

            </div>
        </div>

    </div> <!-- end container -->

    </main>

    <?php include("includes/footer.php")?>

