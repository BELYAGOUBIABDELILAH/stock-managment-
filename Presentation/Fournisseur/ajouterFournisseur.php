    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Header                                           -->
    <!-- ----------------------------------------------------------------------------------------- -->

    <?php $title = "Fournisseurs" ;include "../templates/header.php" ?>
    

    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Container                                        -->
    <!-- ----------------------------------------------------------------------------------------- -->

    <div id="main">
        <br>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Fournisseurs</h3>
                        <!-- <p class="text-subtitle text-muted">Ajout d'un client </p> -->
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Fournisseurs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                <script>
        function allowLettersAndSpaces(event) {
            let inputValue = event.target.value;
            inputValue = inputValue.replace(/[^A-Za-z ]/g, '');
            event.target.value = inputValue;
        }
    </script>


                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ajout d'un fournisseur</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <?php
                        if(isset($_SESSION['succes'])){
                          echo '<div class="alert alert-light-success color-success">
                          <i class="bi bi-check-circle"></i> Fournisseur ajouté.
                        </div>';
                        }
                        unset($_SESSION['succes']);
                    ?>
                                <form class="form form-vertical" method="post" action="ajout.php">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Nom</label>
                                                    <input type="text" id="first-name-vertical" class="form-control"
                                                        name="nom" placeholder="Nom"oninput="allowLettersAndSpaces(event)" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">Adresse</label>
                                                    <input type="text" id="password-vertical" class="form-control"
                                                        name="adresse" placeholder="Adresse" required >
                                                </div>
                                            </div>
                                            <script>
                                                function validatePhoneNumber(event) {
                                                    const input = event.target.value;
                                                    const regex = /^\d{10}$/; // Permet exactement 10 chiffres
                                                    if (!regex.test(input)) {
                                                        event.target.setCustomValidity("Le numéro de téléphone doit contenir exactement 10 chiffres.");
                                                    } else {
                                                        event.target.setCustomValidity("");
                                                    }
                                                }
                                            </script>
                                            <div class="col-12">
                                            <script>
                                                function validatePhoneNumber(event) {
                                                    const input = event.target;
                                                    const inputValue = input.value;
                                                    input.value = inputValue.replace(/\D/g, ''); // Remplacer tous les caractères non numériques par une chaîne vide
                                                }
                                            </script>
                                            <div class="form-group">
                                                    <label for="contact-info-vertical">Téléphone</label>
                                                    <input type="tel" id="contact-info-vertical" class="form-control" name="telephone" placeholder="Téléphone" minlength="10" maxlength="10" oninput="validatePhoneNumber(event)" oninput="validatePhoneNumber(event)" required>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Email</label>
                                                    <input type="email" id="email-id-vertical" class="form-control"
                                                        name="email" placeholder="Email" required >
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <input type="submit" value="Ajouter" class="btn btn-primary me-1 mb-1"
                                                    name="submit">
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>




                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2024 &copy;BELYAGOUBI & MAI</p>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/app.js"></script>

</body>

</html>