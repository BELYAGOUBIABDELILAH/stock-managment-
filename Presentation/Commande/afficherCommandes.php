    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Header                                           -->
    <!-- ----------------------------------------------------------------------------------------- -->

    <?php $title = "Commandes" ;include "../templates/header.php" ?>

    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Container                                        -->
    <!-- ----------------------------------------------------------------------------------------- -->

    <div id="main">
        <br>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Commandes</h3>
                        <!-- <p class="text-subtitle text-muted">Ajout d'un client </p> -->
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Commandes</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">



                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Affichage des Commandes</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="email-fixed-search flex-grow-1">
                                    <div class="form-group position-relative mb-0 has-icon-left">
                                        <input type="text" class="form-control" placeholder="Rechercher le nom..."
                                            id="search" onkeyup="FilterkeyWord()">
                                        <div class="form-control-icon">
                                            <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                <use xlink:href="../../assets/images/bootstrap-icons.svg#search"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-md table-striped" id="table">
                                        <thead>
                                            <tr>
                                                <th>Numero</th>
                                                <th>Date</th>
                                                <th>Client</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php
                                            include_once("C:xampp\htdocs\Mini\Metier\client.php");
                                            $tab = Commande::afficher();
                                            echo "<tr>";
                                            $dao = new DAO();
                                            foreach ($tab as $t) { 
                                                $client = $dao->getClient($t->get("i"));
                                            ?>
                                            <tr>
                                                <td><?= $t->get("n") ?></td>
                                                <td><?= $t->get("d") ?></td>
                                                <td><?= isset($client) ? $client->get("n") : "Client not available" ?></td>
                                                <td>
                                                    <span>
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#view<?=$t->get("n")?>">
                                                            <svg class="bi" width="1em" height="1em"
                                                                fill="currentColor">
                                                                <use
                                                                    xlink:href="../../assets/images/bootstrap-icons.svg#eye">
                                                                </use>
                                                            </svg>
                                                        </a>&#124;
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#supprimer<?=$t->get("n")?>">
                                                            <svg class="bi" width="1em" height="1em"
                                                                fill="currentColor">
                                                                <use
                                                                    xlink:href="../../assets/images/bootstrap-icons.svg#trash">
                                                                </use>
                                                            </svg>
                                                        </a>

                                                    </span>


                                                    <div class="modal fade bd-example-modal-lg"
                                                        id="view<?=$t->get("n")?>" tabindex="0" role="dialog"
                                                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Commande</h4>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal">&times;
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" id="<?=$t->get("n")?>">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-md " id="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Reference</th>
                                                                                    <th>Libelle</th>
                                                                                    <th>Quantite</th>
                                                                                    <th>Prix de Vente</th>
                                                                                </tr>

                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                            include_once("C:xampp\htdocs\Mini\Metier\ligneCmd.php");
                                                                            $tabl = LigneCmd::afficher($t->get("n"));
                                                                            
                                                                                $dao = new DAO();
                                                                                foreach($tabl as $l) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td><?=$l['reference']?></td>
                                                                                    <td><?=$l['libelle']?></td>
                                                                                    <td><?=$l['quantite']?></td>
                                                                                    <td><?=$l['prixVente']?></td>
                                                                                </tr>
                                                                                <?php } 
                                                                            
                                                                            ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="card-text font-bold d-flex justify-content-between"
                                                                        style="margin: 0 2rem">
                                                                        <div></div>
                                                                        <div>Total : <?=LigneCmd::total($t->get("n"))?>
                                                                            DA
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-success"
                                                                       onclick="print(<?=$t->get('n')?>)">Print</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ---------------------------Supprimer --------------------------- -->
                                                    <div class="modal fade bd-example-modal-sm"
                                                        id="supprimer<?=$t->get("n")?>" tabindex="0" role="dialog"
                                                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Alert
                                                                    </h4>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- <h4 class="modal-title">Alert</h4> -->
                                                                    <p>Vous etes sure de supprimer
                                                                        cette
                                                                        categorie?!</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <a
                                                                        href='supprimerCommande.php?id=<?=$t->get("n")?>'>
                                                                        <button type="button"
                                                                            class="btn btn-primary">Oui!
                                                                            Supprimer</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </tr>
                                            <?php } 
                                            echo"</tr>";
                                            ?>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <button type=" button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#mymodal">Small modal</button> -->





                </div>
            </section>
        </div>

        <!-- ----------------------------------------------------------------------------------------- -->
        <!--                                          Footer                                          -->
        <!-- ----------------------------------------------------------------------------------------- -->

        <?php include "../templates/footer.php" ?>
        <script>
            function print(ref){
            var mywindow = window.open(`http://localhost/Mini/Presentation/Commande/pdf.php?ref=${ref}`, 'PRINT', 'height=400,width=600');
            mywindow.focus(); 
            mywindow.print();
            }
        </script>