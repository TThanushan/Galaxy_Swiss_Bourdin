<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Inscription Administrateur</title>
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
			echo '<a class="navbar-text text-success" ><i class="fas fa-user-secret  mr-1"></i> Admin : '.$_SESSION["nom"].' '.$_SESSION["prenom"]. '</a';


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
			<h1 class="display-4 text-center"> Inscription de Visiteur ou de Comptable</h1>

		</div>

		<?php 
			//Partie inscription du visiteur.
			if(isset($_POST["okVisiteur"]) && $_POST["okVisiteur"] != "")
			{
				$nom = $_POST["VisiteurNom"];
				$prenom = $_POST["VisiteurPrenom"];
				$login = $_POST["VisiteurLogin"];
				$mdp = $_POST["VisiteurMdp"];
				$adresse = $_POST["VisiteurAdresse"];
				$codePostal = $_POST["VisiteurCodePostal"];
				$ville = $_POST["VisiteurVille"];
				$dateEmbauche = $_POST["VisiteurDateEmbauche"];
				if($nom != '' and  $prenom != '' and $login != '' and $mdp != '' and $adresse != '' and $codePostal != '' and $ville != '' and $dateEmbauche != '')
				{

					//On vérifie que les champs de frais au forfait ne possèdent pas de lettres.
					if(preg_match("/[0-9]/", $nom) or preg_match("/[0-9]/", $prenom) or preg_match("/[0-9]/", $ville))
					{
						echo '<div class=" card-body text-center alert alert-dismissible alert-warning ">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  Attention certain champs ne peuvent contenir que des lettres
							</div>';
					} 
					else
					{
						try
						{

							//Variable pour la BDD
							$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');

							
							// Genére un id non existant de façon aléatoire.
							$newId = genererUnIdUnique($connexion, 'visiteur');

							$requete1 = "insert ignore into visiteur(id, nom, prenom, login, mdp, adresse, cp, ville, dateEmbauche) values('$newId', '$nom', '$prenom', '$login', '$mdp', '$adresse', $codePostal, '$ville', $dateEmbauche)";

							//afficherMessage($requete1);

							$execution = $connexion->query($requete1);
							
							if($execution == true)
							{
								echo '<div class=" card-body text-center alert alert-dismissible alert-success ">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  Le <i class="fas fa-user mr-2 ml-2"></i>visiteur à bien été inscrit !
									</div>';
							}
							else
							{
								echo '<div class=" card-body text-center alert alert-dismissible alert-warning ">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>Veuillez respecter le format de chaque champ !</div>';
							}
							

						}
						catch(PDOEeption $e)
						 {
						 	echo '<div class=" card-body text-center alert alert-dismissible alert-danger ">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  Erreur de connexion !
									</div>';
							die();
						 }
					}
				}
				else
				{
					echo '<div class=" card-body text-center alert alert-dismissible alert-warning ">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Veuillez remplir tous les champs !
								</div>';
				}
			}

			//Partie inscription du comptable.
			if(isset($_POST["okComptable"]) && $_POST["okComptable"] != "")
			{
				$nom = $_POST["ComptableNom"];
				$prenom = $_POST["ComptablePrenom"];
				$login = $_POST["ComptableLogin"];
				$mdp = $_POST["ComptableMdp"];
				$adresse = $_POST["ComptableAdresse"];
				$codePostal = $_POST["ComptableCodePostal"];
				$ville = $_POST["ComptableVille"];
				$dateEmbauche = $_POST["ComptableDateEmbauche"];

				if($nom != '' and  $prenom != '' and $login != '' and $mdp != '' and $adresse != '' and $codePostal != '' and $ville != '' and $dateEmbauche != '')
				{

					//On vérifie que les champs de frais au forfait ne possèdent pas de lettres.
					if(preg_match("/[0-9]/", $nom) or preg_match("/[0-9]/", $prenom) or preg_match("/[0-9]/", $ville))
					{
						echo '<div class=" card-body text-center alert alert-dismissible alert-warning ">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  Attention certain champs ne peuvent contenir que des lettres
							</div>';
					} 
					else
					{
						try
						{

							//Variable pour la BDD
							$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');

							
							// Genére un id non existant de façon aléatoire.
							$newId = genererUnIdUnique($connexion, 'Comptable');
							$requete1 = "insert ignore into Comptable(id, nom, prenom, login, mdp, adresse, cp, ville, dateEmbauche) values('$newId', '$nom', '$prenom', '$login', '$mdp', '$adresse', $codePostal, '$ville', $dateEmbauche)";
							

							$execution = $connexion->query($requete1);
							if($execution == true)
							{
								echo '<div class=" card-body text-center alert alert-dismissible alert-success ">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Le <i class="fas fa-user-tie mr-2 ml-2"></i>comptable à bien été inscrit !
								</div>';
							}
							else
							{
								echo '<div class=" card-body text-center alert alert-dismissible alert-warning ">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>Veuillez respecter le format de chaque champ !</div>';								
							}

							

						}
						catch(PDOEeption $e)
						 {
						 	echo '<div class=" card-body text-center alert alert-dismissible alert-danger ">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Erreur à la connexion !
								</div>';
							die();
						 }
					}
				}
				else
				{
					echo '<div class=" card-body text-center alert alert-dismissible alert-warning ">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  Veuillez remplir tous les champs !
							</div>';
				}
			}
		?>

		<!-- Formulaire -->
		<div class="row">
	
			<div class="col-sm-12 col-md-6">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h3 class="card-title"><i class="fas fa-user mr-2"></i>Visiteur</h3>

						<form name="formVisiteur" id="formVisiteur" method="post" action="">
							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Nom</span>
						      </div>

						      <input form="formVisiteur" type="text" class="form-control" name="VisiteurNom" required >

						    </div>
							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Prénom</span>
						      </div>

						      <input form="formVisiteur" type="text" class="form-control" name="VisiteurPrenom" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Login</span>
						      </div>

						      <input form="formVisiteur" type="text" class="form-control" name="VisiteurLogin" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Mot de passe</span>
						      </div>

						      <input form="formVisiteur" type="password" class="form-control" name="VisiteurMdp" required pattern=".{4,}" title="Saisir plus de 4 caractère" >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Adresse</span>
						      </div>

						      <input form="formVisiteur" type="text" class="form-control" name="VisiteurAdresse" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Code Postal</span>
						      </div>

						      <input form="formVisiteur" type="text" class="form-control" name="VisiteurCodePostal" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Ville</span>
						      </div>

						      <input form="formVisiteur" type="text" class="form-control" name="VisiteurVille" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Date d'embauche</span>
						      </div>

						      <input placeholder="AAAA-MM-JJ" form="formVisiteur" type="text" class="form-control" name="VisiteurDateEmbauche" required pattern=".{10,10}" title="Respecter le format AAAA-MM-JJ !">

						    </div>



							<button type="reset" class="btn btn-warning mb-3 mt-3"><i class=" fas fa-times"></i> Annuler</button>
							<button type="submit" form="formVisiteur" class="btn btn-success mb-3 mt-3"  name="okVisiteur" value="Valider"><i class=" fas fa-plus"></i> Ajouter</button>

						</form>
					</div>
				</div>

			</div>

			<div class="col-sm-12 col-md-6">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h3 class="card-title"><i class="fas fa-user-tie mr-2"></i>Comptable</h3>

						<form name="formComptable" id="formComptable" method="post" action="">
							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Nom</span>
						      </div>

						      <input form="formComptable" type="text" class="form-control" name="ComptableNom" required >

						    </div>
							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Prénom</span>
						      </div>

						      <input form="formComptable" type="text" class="form-control" name="ComptablePrenom" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Login</span>
						      </div>

						      <input form="formComptable" type="text" class="form-control" name="ComptableLogin" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Mot de passe</span>
						      </div>

						      <input form="formComptable" type="password" class="form-control" name="ComptableMdp" required pattern=".{4,}" title="Saisir plus de 4 caractère">

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Adresse</span>
						      </div>

						      <input form="formComptable" type="text" class="form-control" name="ComptableAdresse" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Code Postal</span>
						      </div>

						      <input form="formComptable" type="text" class="form-control" name="ComptableCodePostal" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Ville</span>
						      </div>

						      <input form="formComptable" type="text" class="form-control" name="ComptableVille" required >

						    </div>

							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Date d'embauche</span>
						      </div>

						      <input placeholder="AAAA-MM-JJ" form="formComptable" type="text" class="form-control" name="ComptableDateEmbauche" required >

						    </div>



							<button type="reset" class="btn btn-warning mb-3 mt-3"><i class=" fas fa-times"></i> Annuler</button>
							<button type="submit" form="formComptable" class="btn btn-success mb-3 mt-3"  name="okComptable" value="Valider"><i class=" fas fa-plus"></i> Ajouter</button>

						</form>
					</div>
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