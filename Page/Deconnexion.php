<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Déconnexion </title>
	<link rel="icon" href="../Ressources/Logo.png"/>
	<!-- css -->
	<link rel="stylesheet"  href="css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initale-scale=1.0">

</head>

<body>

	<div class="container">

		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="index.php">Galaxy Swiss Bourdin</a>


			<!-- Allow to change the navBar on mobile Devices -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			    <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto" ">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Accueil</a>
					</li>


					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
							Connexion
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="ConnexionVisiteur.php"><i class="fas fa-user mr-2"></i>Visiteur </a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="ConnexionComptable.php"><i class="fas fa-user-tie mr-2"></i>Comptable</a> 
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="ConnexionAdministrateur.php"><i class="fas fa-user-secret mr-2"></i>Administrateur</a> 
						</div>


					</li>

					<li class="nav-item">
						<a class="nav-link" href="Contact.php">Contact</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="APropos.php">A propos</a>
					</li>

				</ul>
			</div>
		</nav>


		<!-- Hero Section -->
		<div class="jumbotron">
			<h1 class="display-3 text-center"> À bientôt !</h1>

		</div>



		<!-- Footer -->
		<div class="card-body text-center bg-primary mt-2 ">
		    <span class=" text-light ">Galaxy Swiss Bourdin, Copyright &copy; Thanushan Tharmabalan 2018</span>
		</div>	
	</div>

			
	<?php
		session_start();
		session_unset();
		session_destroy();
	?>

    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>


</html>