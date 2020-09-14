<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Utilisateurs Administrateur</title>
	<link rel="icon" href="../Ressources/Logo.png"/>
	<!-- css -->
	<link rel="stylesheet"  href="css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initale-scale=1.0">

</head>

<body>
	<?php include('func.php'); ?>

	<div class="container">

		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="AccueilAdministrateur.php">Galaxy Swiss Bourdin</a>
			<!-- Afficher le nom et prenom de l'utilisateur -->
			<?php

			session_start();
			if($_SESSION["autoriser"] != "oui")
			{
				header("location:index.php");
				exit();
			}
			echo '<a class="navbar-text text-success" ><i class="fas fa-user-secret mr-1"></i>  Admin : '.$_SESSION["nom"].' '.$_SESSION["prenom"]. '</a';


			?>
			<!-- Permet de change la navBar sur les smartphones -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			    <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto" ">
					<li class="nav-item">
						<a class="nav-link " href="AccueilAdministrateur.php"><strong>Accueil</strong></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-warning" href="InscriptionAdministrateur.php"><strong>Inscription</strong></a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-warning" href="#" id="navbarDropdown" data-toggle="dropdown">
							Utilisateurs
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="ListeVisiteursAdministrateur.php"><i class="fas fa-user mr-2"></i>Visiteur </a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="ListeComptablesAdministrateur.php"><i class="fas fa-user-tie mr-2"></i>Comptable</a> 
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="ListeAdministrateursAdministrateur.php"><i class="fas fa-user-secret mr-2"></i>Administrateur</a> 
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a>
					</li>
				</ul>
			</div>
		</nav>
		
		
		<!-- Hero Section -->
		<div class="jumbotron">
			<h1 class="display-4 text-center"> Liste des <i class="fas fa-user-tie mr-3"></i>Comptables </h1>

		<?php 
			$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');

			$requeteCount = "select count('id') total from comptable ";
			
			$executionCount = $connexion->query($requeteCount);

			$count = $executionCount->fetch();

			echo '<div style="font-size: 250%; margin-right: 10%;" class=" text-center">('.$count['total'].') </div>';
		?>
		</div>

		<?php 


			$requete = "select * from comptable";
			$execution = $connexion->query($requete);
			

			echo '<table class="table table-responsive">
					<thead class="bg-dark text-light">
						<tr>
							<th class="align-middle">Nom</th>
							<th class="align-middle">Prénom</th>
							<th class="align-middle">Login</th>
							<th class="align-middle">Mot de passe</th>
							<th class="align-middle">Adresse</th>
							<th class="align-middle">Code Postal</th>
							<th class="align-middle">Ville</th>
							<th class="align-middle">Date d\'embauche</th>
						</tr>
					</thead>';

			$i = 1;
			while($ligne = $execution->fetch())
			{
				if($i%2 == 0)
					echo '<tr class="table-active">';
				else	
					echo '<tr>';

					echo	'<td>'.$ligne['nom'].'</td>
							<td>'.$ligne['prenom'].'</td>
							<td>'.$ligne['login'].'</td>
							<td>'.$ligne['mdp'].'</td>
							<td>'.$ligne['adresse'].'</td>
							<td>'.$ligne['cp'].'</td>
							<td>'.$ligne['ville'].'</td>
							<td>'.$ligne['dateEmbauche'].'</td>'

					.'</tr>';
				$i++;
			}
			echo "</table>";

			
		?>



		<!-- Footer -->
		<div class="card-body text-center bg-primary mt-2 ">
		    <span class=" text-light ">Galaxy Swiss Bourdin, Copyright &copy; 2018</span>
		</div>	

	</div>



    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>


</html>