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

if (isset($_SESSION['userinfo'])) {
    header("Location: protected.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Application de test / Accueil</title>

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
            </div>
        </nav>

        <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Accueil</h1>
                <p>Cette application vous permet de tester l'API des droits de l'assurance maladie via France Connect.</p>
                <p>
                    <form action='authentication.php' method='post'>
                        <input type="submit" value="S'identifier avec France Connect" style="background:url(img/fc_bouton_alt1_v2.png) no-repeat; width:224px; height:56px; font-size:0; border:0; cursor:pointer;"/>
                    </form>
                </p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-6">
                    <h2>Fournisseur de service</h2>
                    <p>En tant que fournisseur de service France Connect, cette application vous permet de tester l'authentification de vos utilisateurs via le protocole OpenID Connect (Authorization code flow).</p>
                    <p><a class="btn btn-secondary" href="https://partenaires.franceconnect.gouv.fr/" role="button">Détail &raquo;</a></p>
                </div>
                <div class="col-md-6">
                    <h2>API des droits</h2>
                    <p>En tant que fournisseur de service conventionné avec la Cnam, cette application vous permet de tester l'accès à l'API des droits des assurés de l'assurance maladie.</p>
                </div>
                <div class="col-md-12">
                    <h2>Démo</h2>
                    <p>Vous pouvez tester cette application en choisissant le bouchon <strong>ameli.fr</strong> de la mire d'authentification France Connect.</p>
                    <ul>
                        <li>Login : 2780246102043</li>
                        <li>Mot de passe : 1234</li>
                    </ul>
                    <p><img src="img/demo-fc-api.gif" width="100%"/></p>
                </div>
                <div class="col-md-12">
                    <h2>Source</h2>
                    <p>Le code source de cette application est disponible sur github.</p>
                    <ul>
                        <li><a href="https://github.com/assurance-maladie-digital/api-droits-fs-exemple-php">https://github.com/assurance-maladie-digital/api-droits-fs-exemple-php</a> </li>
                    </ul>
                </div>

            </div>
            <hr>
        </div> <!-- /container -->
    </main>

        <footer class="container">
        <p>Cnam Digital 2018</p>
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
