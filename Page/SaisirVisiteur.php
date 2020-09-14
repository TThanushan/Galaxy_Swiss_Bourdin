<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Saisir Visiteur</title>
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
						<a class="nav-link " href="AccueilVisiteur.php"><strong>Accueil</strong></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-warning" href="#"><strong>Saisir</strong></a>
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
			<h1 class="display-4 text-center"> Saisie de fiche de frais </h1>

		</div>

		<?php 
			//Partie Frais au forfait.
			if(isset($_POST["okFraisAuForfait"]) && $_POST["okFraisAuForfait"] != "")
			{

				if($_POST["FRA_REPAS"] != '' && $_POST["FRA_NUIT"] != '' && $_POST["FRA_ETAP"] != '' && $_POST["FRA_KM"] != '')
				{

					$FRA_REPAS = $_POST["FRA_REPAS"];
					$FRA_NUIT = $_POST["FRA_NUIT"];
					$FRA_ETAP = $_POST["FRA_ETAP"];
					$FRA_KM = $_POST["FRA_KM"];
					
					//On vérifie que les champs de frais au forfait ne possèdent pas de lettres.
					if(preg_match("/[a-z]/", $FRA_REPAS) or preg_match("/[a-z]/", $FRA_NUIT) or preg_match("/[a-z]/", $FRA_ETAP) or preg_match("/[a-z]/", $FRA_KM))
					{
							echo '<div class=" card-body text-center alert alert-dismissible alert-warning ">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  Attention les champs ne peuvent contenir que des chiffres !
							</div>';					
					} 
					else
					{

						try
						{
							//On créer un variable pour la BDD
							$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');

							//1 : On créer la fichefrais correspondante				
							insertFicheFrais($connexion, $_SESSION['id'], 'CR');

							//2 : créer la ligneFraisForfait pour chaque champs
							$requete1 = insertLigneFraisForfait($connexion, 'REP', $FRA_REPAS);
							$requete2 = insertLigneFraisForfait($connexion, 'NUI', $FRA_NUIT);
							$requete3 = insertLigneFraisForfait($connexion, 'ETP', $FRA_ETAP);
							$requete4 = insertLigneFraisForfait($connexion, 'KM', $FRA_KM);


							if($requete1 == true or $requete2 == true or $requete3 == true or $requete4 == true)
							{
								echo '<div class=" card-body text-center alert alert-dismissible alert-success ">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Les modifications de la fiche de frais ont bien été enregistrées !
								</div>';						
							}
							

						}
						catch(PDOEeption $e)
						{
							echo '<div class=" card-body text-center alert alert-dismissible alert-danger ">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  Erreur à la connexion de la base de donnée !
							</div>';
							die();
						}
					}
				}
			}

			//Partie Frais hors forfait.
			if(isset($_POST["okHorsForfait"]) && $_POST["okHorsForfait"] != "")
			{

					$FRA_DATE = $_POST["FRA_AUT_DAT1"];
					$FRA_LIBELLE = $_POST["FRA_AUT_LIB1"];
					$FRA_MONTANT = $_POST["FRA_AUT_MONT1"];

 				if($FRA_DATE != '' and $FRA_LIBELLE != '' and $FRA_MONTANT != '')
				{
						
					try
					{

						//On créer un variable pour la BDD
						$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');

						//1 : On créer la fichefrais correspondante
						insertFicheFrais($connexion, $_SESSION['id'], 'CR');

						//2 : Créer la ligneHorsFraisForfait.
						$requeteHorsForfait = 'insert into lignefraishorsforfait (idVisiteur, mois, libelle, date, montant) value(\''.$_SESSION["id"].'\','.date("Ym").',\''.$FRA_LIBELLE.'\',\''.$FRA_DATE.'\','.$FRA_MONTANT.')';
						$execution = $connexion->query($requeteHorsForfait);
						
						if($execution)
						{
							echo '<div class=" card-body text-center alert alert-dismissible alert-success ">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  Enregistrement hors forfait réussi !
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
							  Erreur à la connexion de la base de donnée !
							</div>';
						die();
					 }
				}
			}

		?>

		<!-- Formulaire -->
		<div class="row">
	
			<div class="col-sm-12 col-md-6">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h3 class="card-title">Frais Au Forfait</h3>

						<form name="formSaisieFrais" id="formSaisieFrais" method="post" action="">
							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Repas Restaurant</span>
						      </div>

						      <input type="text" class="form-control" name="FRA_REPAS" required >

						      <div class="input-group-append">
						        <span class="input-group-text">€</span>
						      </div>
						    </div>

						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Nuitée Restaurant</span>
						      </div>

						      <input type="text" class="form-control" name="FRA_NUIT" required>

						      <div class="input-group-append">
						        <span class="input-group-text">€</span>
						      </div>
						    </div>

						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Forfait Etape</span>
						      </div>

						      <input type="text" class="form-control" name="FRA_ETAP" required>

						      <div class="input-group-append">
						        <span class="input-group-text">€</span>
						      </div>
						    </div>

						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 170px;" class="input-group-text">Frais Kilométrique</span>
						      </div>

						      <input type="text" class="form-control" name="FRA_KM" required>

						      <div class="input-group-append">
						        <span class="input-group-text">€</span>
						      </div>
						    </div>

							<button type="reset" class="btn btn-warning mb-3 mt-3"><i class=" fas fa-times"></i> Annuler</button>
							<button type="submit" form="formSaisieFrais" class="btn btn-success mb-3 mt-3"  name="okFraisAuForfait" value="Valider"><i class=" fas fa-plus"></i> Ajouter</button>

						</form>
					</div>
				</div>

			</div>

			<div class="col-sm-12 col-md-6">
				<div class="card mb-4 pb-5">
					<div class="card-body text-center">
						<h3 class="card-title">Frais Hors Forfait</h3>
						<form method="POST" action="" id="fraisHorsForfaitForm" name="fraisHorsForfaitForm">
							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 110px;" class="input-group-text">Date</span>
						      </div>

						      <input name="FRA_AUT_DAT1" type="text" class="form-control" placeholder="AAAA-MM-JJ" required>
						    </div>
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 110px;" class="input-group-text">Libellé</span>
						      </div>

						      <input name="FRA_AUT_LIB1" type="text" class="form-control" required>


						    </div>
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span style="width: 110px;" class="input-group-text">Montant</span>
						      </div>

						      <input name="FRA_AUT_MONT1" type="text" class="form-control" required>

						      <div class="input-group-append">
						        <span class="input-group-text">€</span>
						      </div>
						    </div>
						    
							<button type="reset" class="btn btn-warning mb-3 mt-3"><i class=" fas fa-times"></i> Annuler</button>
							<button type="submit" form="fraisHorsForfaitForm" class="btn btn-success mb-3 mt-3"  name="okHorsForfait" value="Valider"><i class=" fas fa-plus"></i> Ajouter</button>
						</form>
					</div>
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