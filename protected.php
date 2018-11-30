<?php
#    This file is part of the PHP example for FranceConnect and API des Droits Cnam
#
#    Copyright (C) 2015-2019 Eric Pommateau, Maxime Reyrolle, Arnaud Bétrémieux, Nicolas Krzyzanowski
#
#    This example is free software: you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    This example is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this example.  If not, see <http://www.gnu.org/licenses/>.

require_once("init.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Fournisseur de service France-Connect</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-8733929-16"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-8733929-16');
        </script>
    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Application de test</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <p class="navbar-nav navbar-text mr-auto">Fournisseur de service France Connect & API des droits</p>

                <p class="navbar-nav navbar-text navbar-right" id="user">
                    <?php echo $_SESSION['userinfo']['given_name']." ".$_SESSION['userinfo']['family_name'] ?>
                </p>
                <form class="form-inline my-2 my-lg-0" action="logout.php">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Déconnexion</button>
                </form>
            </div>
        </nav>

        <main role="main">
            <div class="container">
                <h1>Ma démarche en ligne</h1>
                <p>Réalisez votre démarche en ligne grâce à France Connect et aux données de l'Assurance Maladie.</p>
                <p>En tant que fournisseur de service vous avez accès à ces données via France Connect et l'API des droits.</p>
                        <h2>France Connect</h2>
                        <div class="accordion" id="accordionFC">
                            <div class="card">
                                <div class="card-header" id="headingToken">
                                    <span class="badge badge-pill badge-success">POST</span>
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseToken" aria-expanded="true" aria-controls="collapseToken">
                                            <?php echo $france_connect_base_url ?>token
                                        </button>
                                </div>
                                <div id="collapseToken" class="collapse" aria-labelledby="collapseToken" data-parent="#accordionFC">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['full_access_token'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingUserinfo">
                                    <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseUserinfo" aria-expanded="false" aria-controls="collapseUserinfo">
                                            <?php echo $france_connect_base_url ?>userinfo
                                        </button>
                                </div>
                                <div id="collapseUserinfo" class="collapse" aria-labelledby="headingUserinfo" data-parent="#accordionFC">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['userinfo'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2>API des droits assurés de l'Assurance Maladie</h2>
                        <div class="accordion" id="accordionCnam">
                            <div class="card">
                                <div class="card-header" id="headingChecktoken">
                                    <span class="badge badge-pill badge-success">POST</span>
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseChecktoken" aria-expanded="true" aria-controls="collapseChecktoken">
                                        <?php echo $france_connect_base_url ?>checktoken
                                    </button>
                                </div>

                                <div id="collapseChecktoken" class="collapse" aria-labelledby="headingChecktoken" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['checktoken_info'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingMe">
                                        <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseMe" aria-expanded="false" aria-controls="collapseMe">
                                            <?php echo $api_cnam_base_url ?>me
                                        </button>
                                </div>
                                <div id="collapseMe" class="collapse" aria-labelledby="headingMe" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['api_cnam']['me'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingMeBeneficaires">

                                        <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseMeBeneficaires" aria-expanded="false" aria-controls="collapseMeBeneficaires">
                                            <?php echo $api_cnam_base_url ?>me/beneficiaires
                                        </button>

                                </div>
                                <div id="collapseMeBeneficaires" class="collapse" aria-labelledby="headingMeBeneficaires" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['api_cnam']['meBeneficiaires'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingBeneficairesNir">

                                        <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseBeneficairesNir" aria-expanded="false" aria-controls="collapseBeneficairesNir">
                                            <?php echo $api_cnam_base_url ?>
                                        </button>
                                        <span class="badge badge-secondary">NIR</span>

                                </div>
                                <div id="collapseBeneficairesNir" class="collapse" aria-labelledby="headingBeneficairesNir" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['api_cnam']['beneficiairesNir'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingBeneficiairesNirCaisse">

                                        <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseBeneficiairesNirCaisse" aria-expanded="false" aria-controls="collapseBeneficiairesNirCaisse">
                                            <?php echo $api_cnam_base_url ?>caisse
                                        </button>
                                        <span class="badge badge-secondary">NIR</span>

                                </div>
                                <div id="collapseBeneficiairesNirCaisse" class="collapse" aria-labelledby="headingBeneficiairesNirCaisse" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['api_cnam']['beneficiairesNirCaisse'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingBeneficiairesNirContrats">

                                        <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseBeneficiairesNirContrats" aria-expanded="false" aria-controls="collapseBeneficiairesNirContrats">
                                            <?php echo $api_cnam_base_url ?>contrats
                                        </button>
                                    <span class="badge badge-secondary">NIR</span>

                                </div>
                                <div id="collapseBeneficiairesNirContrats" class="collapse" aria-labelledby="headingBeneficiairesNirContrats" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['api_cnam']['beneficiairesNirContrats'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingBeneficiairesNirExonerations">

                                        <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseBeneficiairesNirExonerations" aria-expanded="false" aria-controls="collapseBeneficiairesNirExonerations">
                                            <?php echo $api_cnam_base_url ?>exonerations
                                        </button>
                                    <span class="badge badge-secondary">NIR</span>

                                </div>
                                <div id="collapseBeneficiairesNirExonerations" class="collapse" aria-labelledby="headingBeneficiairesNirExonerations" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['api_cnam']['beneficiairesNirExonerations'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingBeneficiairesNirMedecinTraitant">

                                        <span class="badge badge-pill badge-primary">GET</span>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseBeneficiairesNirMedecinTraitant" aria-expanded="false" aria-controls="collapseBeneficiairesNirMedecinTraitant">
                                            <?php echo $api_cnam_base_url ?>medecin-traitant
                                        </button>
                                    <span class="badge badge-secondary">NIR</span>

                                </div>
                                <div id="collapseBeneficiairesNirMedecinTraitant" class="collapse" aria-labelledby="headingBeneficiairesNirMedecinTraitant" data-parent="#accordionCnam">
                                    <div class="card-body">
                                        <pre><?php print_r(json_encode($_SESSION['api_cnam']['beneficiairesNirMedecinTraitant'], JSON_PRETTY_PRINT));?></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                <hr>

            </div> <!-- /container -->

        </main>

        <footer class="container">
            <p>Cnam 2018</p>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>
</html>
