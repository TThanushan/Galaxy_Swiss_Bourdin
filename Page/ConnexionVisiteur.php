<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Connexion Visiteur</title>
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
							<a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Visiteur </a>
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
			<h1 class="display-3 text-center"> Connexion Visiteur</h1>
		</div>


	<?php
		if(isset($_POST["ok"])&&($_POST["ok"]!="") && $_POST["password"] != "")
		{
			
			$login=$_POST["login"];
	     	$password=$_POST["password"];
		
		 try
		 {

				$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');
				

				$radioValue = "visiteur";
				
				$requete="select mdp from $radioValue where login=\"$login\"  and mdp=\"$password\"";
				$execution=$connexion->query($requete);
				if($execution != "")
				{

					$ligne=$execution->fetch();
					if ($ligne['mdp'] == $password)
					{ 
						$requeteNomPrenomId = "select nom, prenom, id from $radioValue where login=\"$login\" and mdp=\"$password\"";

						$executionDonneeUtilisateur = $connexion->query($requeteNomPrenomId);

						$donneeUtilisateur = $executionDonneeUtilisateur->fetch();



						$_SESSION["autoriser"]="oui";
						$_SESSION["nom"]=$donneeUtilisateur['nom'];
						$_SESSION["prenom"]=$donneeUtilisateur['prenom'];
						$_SESSION["id"]=$donneeUtilisateur['id'];

				    	header ("location:AccueilVisiteur.php");

					}
					else
					{ 
						
						
						echo '<div class=" card-body text-center alert alert-dismissible alert-danger ">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Erreur d\'identifiant ou de mot de passe !
						</div>';


				
					}
					
				}
				else
				{
					echo '<div class=" card-body text-center alert alert-dismissible alert-danger ">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  Erreur à la connexion de la base de donnée !
					</div>';
				}
		 }
		 catch(PDOEeption $e)
		 {
		 	afficherMessage('Erreur de connexion au serveur', 0);
   		    die();
		 }
			
		}

	?>
		<div class="modal-dialog text-center">

			<div class="col-11 modal-content">
				<div class="col-12 mb-5">
					<i style="font-size: 150px; margin-top: -20px;"class="fas fa-user"></i>
					<p class="lead text-center"> Visiteur </p>

				</div>

				<form class="col-12" id="formVisiteur"  method="post">
					<div class="form-group">
						<i style="font-size: 25px; padding-top: 6px; position: absolute; left: 20px;"class="fas fa-user"></i>
						<input style="padding-left: 35px;" type="text" class="form-control" placeholder="Entrer l'identifiant" name="login">
					</div>

					<div class="form-group">
						<i style="font-size: 25px; padding-top: 6px; position: absolute; left: 20px;"class="fas fa-lock"></i>
						<input style="padding-left: 35px;" type="password" class="form-control" placeholder="Entrer le mot de passe" name="password">
					</div>

					<button type="submit" form="formVisiteur" class="btn btn-success mb-3 mt-3" name="ok" value ="Valider"><i class="fas fa-sign-in-alt"></i> Connexion</button>

				</form>
			</div>
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