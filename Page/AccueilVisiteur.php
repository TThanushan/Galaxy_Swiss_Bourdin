<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Accueil Visiteur</title>
	<link rel="icon" href="../Ressources/Logo.png"/>
	<!-- css -->
	<link rel="stylesheet"  href="css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initale-scale=1.0">

</head>

<body>

	<div class="container">

		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="AccueilVisiteur.php">Galaxy Swiss Bourdin</a>

			<!-- Afficher le nom et prenom de l'utilisateur -->
			<?php
			
			session_start();
			if($_SESSION["autoriser"] != "oui")
			{
				header("location:index.php");
				exit();
			}
			echo '<a class="navbar-text text-info" ><i class="fas fa-user  mr-1"></i> Visiteur : '.$_SESSION["nom"].' '.$_SESSION["prenom"]. '</a';


			?>
			<!-- Permet de change la navBar sur les smartphones -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			    <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto" ">
					<li class="nav-item">
						<a class="nav-link " href="#"><strong>Accueil</strong></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-warning" href="SaisirVisiteur.php"><strong>Saisir</strong></a>
					</li>

					<li class="nav-item">
						<a class="nav-link text-warning" href="ConsulterVisiteur.php"><strong>Consulter</strong></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a>
					</li>
				</ul>
			</div>
		</nav>


		<!-- Hero Section -->
		<div class="jumbotron">
			<h1 class="display-3 text-center"> Bienvenue Visiteur !</h1>

		</div>



		<!-- Footer -->
		<div class="card-body text-center bg-primary mt-2 ">
		    <span class=" text-light ">Galaxy Swiss Bourdin, Copyright &copy; Thanushan Tharmabalan 2018</span>
		</div>	

	</div>



    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>


</html>