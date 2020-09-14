<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Valider Fiche Frais Comptable</title>
	<link rel="icon" href="../Ressources/Logo.png"/>
	<!-- css -->
	<link rel="stylesheet"  href="css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initale-scale=1.0">

</head>

<body>

	<div class="container">

		<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="AccueilComptable.php">Galaxy Swiss Bourdin</a>
			<!-- Afficher le nom et prenom de l'utilisateur -->
			<?php
			
			session_start();
			if($_SESSION["autoriser"] != "oui")
			{
				header("location:index.php");
				exit();
			}
			echo '<a class="navbar-text text-warning" ><i class="fas fa-user-tie  mr-1"></i> Comptable : '.$_SESSION["nom"].' '.$_SESSION["prenom"]. '</a';


			?>
			<!-- Allow to change the navBar on mobile Devices -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			    <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto" ">

					<li class="nav-item">
						<a class="nav-link " href="AccueilComptable.php"><strong>Accueil</strong></a>
					</li>

					<li class="nav-item">
						<a class="nav-link text-warning" href="#"><strong>Valider les Fiches</strong></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a>
					</li>
				</ul>
			</div>
		</nav>

		<!-- Hero Section -->
		<div class="jumbotron">
			<h1 class="display-4 text-center"> Valider les fiches de frais des visiteurs </h1>

		</div>

		<!-- Formulaire -->
		<div class="row">
	
			<div class="col-sm-12 col-md-4">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h3 class="card-title">Période & Visiteur à selectionner</h3>
						<form name="validationForm" id="validationForm" method="post" action="">
							
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span  class="input-group-text">Période</span>
						      </div>

						      	<!-- Choix de la période de la fiche frais a afficher. -->
								<select class="custom-select" name="periode" >

									<?php
										$yearArray = range(date('Y'), 2010);
										$monthArray = array(
											'01' => 'Janvier', '02' => 'Février', '03' => 'Mars',
											'04' => 'Avril', '05' => 'Mai', '06' => 'Juin',
											'07' => 'Juillet', '08' => 'Août', '09' => 'Septembre',
											'10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre', 
											);


										foreach ($yearArray as $year) {
											foreach ($monthArray as $month) {

												echo '<option>'.$month.' '.$year.'</option>';
											}
										}
									?>
								</select>

						    </div>
						    <div class="input-group mb-3">

						      <div class="input-group-prepend">
						        <span  class="input-group-text">Visiteur</span>
						      </div>

						      	<!-- Choix du visiteur. -->
								<select class="custom-select" name="nomPrenomVisiteur">
									<?php
										$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8', 'root', '');		
											
										$requete = 'select nom, prenom from visiteur';
											
										$execution = $connexion->query($requete);

										while($ligne = $execution->fetch())
										{
											echo '<option>'.$ligne['nom'].' '.$ligne['prenom'];
										}
										

									?>
								</select>

						    </div>
							<button type="reset" class="btn btn-warning mb-3 mt-3"><i class=" fas fa-times"></i> Annuler</button>
							<button type="submit" form="validationForm" class="btn btn-success mb-3 mt-3"  name="okPeriode" value="Valider"><i class=" fas fa-check"></i> Valider</button>
						</form>
					</div>
				</div>

			</div>



			<?php
				if(isset($_POST['okPeriode']) and $_POST['okPeriode'] != '')
				{
					

					try
					{
						$periode = $_POST['periode'];
						$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');


						$month = 'null';
						$year = 'null';
						// Je découpe le mois et l'année dans les deux variables month et year.
						foreach ($monthArray as $value => $_month) {
							if(strpos($periode, $_month) !== false) // !== empêche la conversion du type de la variable, donc ici 0 n'est pas égale à false.
								$month = $value;
						}

						foreach ($yearArray as $_year )
						{
							if(strpos($periode, (string)$_year) !== false)
							{
								$year = $_year;
							}
						}

						
						$_SESSION['periode'] = $year.$month;

						$nomVisiteur = '';
						$prenomVisiteur = '';
						$nomPrenomVisiteur = $_POST['nomPrenomVisiteur'];

						// On découpe le nom et le prénom que l'on met dans deux variables distinctes.
						for ($i = 0; $i < strlen($nomPrenomVisiteur) ; $i++) {
							if ($nomPrenomVisiteur[$i] == ' ') 
								break;

							$nomVisiteur = $nomVisiteur.$nomPrenomVisiteur[$i];
							
						}

						for ($i=strlen($nomVisiteur) + 1; $i < strlen($nomPrenomVisiteur); $i++) { 
							$prenomVisiteur = $prenomVisiteur.$nomPrenomVisiteur[$i];
						}
						$requete = 'select id from visiteur where nom =\''.$nomVisiteur.'\' and prenom =\''.$prenomVisiteur.'\'';
						$execution = $connexion->query($requete);

						$ligne = $execution->fetch();

						$_SESSION['id'] = $ligne['id'];
						
						// Requete pour la fiche frais.
						$requete = 'select * 
									from fichefrais 
									where idVisiteur = \''.$_SESSION['id'].'\' and mois = '.$year.$month;


						//echo '<br />'.$requete.'<br />';
						
						$execution = $connexion->query($requete) or die('La requete à planté !');
						$ligne = $execution->fetch();

						// Requete pour le libelle de l'état.
						$requete = 'select libelle from etat where id = \''.$ligne['idEtat'].'\'';
						//echo $requete;
						$execution = $connexion->query($requete) or die('La requete à planté !');
						$etat = $execution->fetch();
						
						// Requete pour ligneFraisForfait Forfait Etape.
						$requete = 'select * from lignefraisforfait where idVisiteur = \''.$_SESSION['id'].'\' and mois = '.$year.$month.' and idFraisForfait = \'ETP\'';
						$execution = $connexion->query($requete) or die('La requete à planté !');
						
						$forfaitEtape = $execution->fetch();

						// Requete pour ligneFraisForfait Frais Kilométrique.
						$requete = 'select * from lignefraisforfait where idVisiteur = \''.$_SESSION['id'].'\' and mois = '.$year.$month.' and idFraisForfait = \'KM\'';
						$execution = $connexion->query($requete) or die('La requete à planté !');
						
						$fraisKilometrique = $execution->fetch();

						// Requete pour ligneFraisForfait Nuitée Hôtel.
						$requete = 'select * from lignefraisforfait where idVisiteur = \''.$_SESSION['id'].'\' and mois = '.$year.$month.' and idFraisForfait = \'NUI\'';
						$execution = $connexion->query($requete) or die('La requete à planté !');
						
						$nuiteeHotel = $execution->fetch();

						// Requete pour ligneFraisForfait Repas Restaurant.
						$requete = 'select * from lignefraisforfait where idVisiteur = \''.$_SESSION['id'].'\' and mois = '.$year.$month.' and idFraisForfait = \'REP\'';
						$execution = $connexion->query($requete) or die('La requete à planté !');
						
						$repasRestaurant = $execution->fetch();

						// Requete pour ligne_frais_HORS_forfait.select date, libelle, montant from lignefraishorsforfait where idVisiteur = 666 and mois = 201001 

						$requete = 'select * from lignefraishorsforfait where idVisiteur =\''.$_SESSION['id'].'\' and mois = '.$year.$month;
						$execution = $connexion->query($requete) or die('La requete à planté !');
						
						if(isset($ligne['idEtat']))
						{
							echo'<div class="col-md-8">
									 <div class="card text-white bg-success mb-4" >
										 <div class="card-header"><h4>Fiche de frais du mois de '.$periode.' | '.$nomVisiteur.' '.$prenomVisiteur.'</h4></div>

										 <div class="card-body">
											 <div align=\'left\'> <li> <strong> Etat : </strong>'.$etat['libelle'].'</li>  	
											 <li> <strong> Dernière modification le : </strong>'.$ligne['dateModif'].'</li>
											 <li> <strong> Montant validé : </strong>'.$ligne['montantValide'].'</li> </div>
											 <div class="text-primary"><h4 class="card-title mt-4 ">Quantités des éléments forfaitisés</h4>
										 	 

											<table class="table table-responsive " >
												<thead>
													<tr>
														<th> Forfait Etape</th>
														<th>Frais Kilométrique</th>
														<th>Nuitée Hôtel </th>
														<th> Repas Restaurant </th>
													<tr>
												</thead>
												<tbody>
													<tr> 
														<td align=\'center\'>'. $forfaitEtape['quantite'] .'</td>
														<td align=\'center\'>'. $fraisKilometrique['quantite'] .'</td>
														<td align=\'center\'>'. $nuiteeHotel['quantite'] .'</td>
														<td align=\'center\'>'. $repasRestaurant['quantite'] .'</td>
													</tr>
												</tbody>
										  	</table>
										  	</div>
										  	<h4 class="card-title mt-4">Descriptif des éléments hors forfait - '.$ligne['nbJustificatifs'].' justificatif reçus </h4>


											<table class="table table-responsive">
												<thead>
													<tr>
														<td align=\'center\'><strong>Date</strong></td>
														<td align=\'center\'><strong>Libellé</strong></td>
														<td align=\'center\'><strong>Montant </strong></td>
													<tr>
												</thead>';
											while ($donnee = $execution->fetch()) {
											
													echo '<tbody> <tr>
														<td class="align-middle" align=\'center\'>'.$donnee['date'].'</td>
														<td class="align-middle" align=\'center\'>'.$donnee['libelle'].'</td>
														<td class="align-middle" align=\'center\'>'.$donnee['montant'].'</td>';
														if($ligne['idEtat'] == 'CR')
														{
															echo '<form id="HorsForfaitForm" name="HorsForfaitForm" method="post" action="">

																	<input type="hidden" name=\'supprimerHorsForfait\' value='.$donnee['id'].'>

																	<td align=\'center\'><button type="submit" form="HorsForfaitForm" class="btn btn-danger mb-3 mt-3"  name="okPeriode"><i class=" fas fa-times"></i> Supprimer</button></td>
																</form>';
														}
													echo '</tr></tbody>';

											}
										  	echo '</table>

										 </div></div>';
										if($ligne['idEtat'] == 'CL')
										{
											echo '<form id="ValidationForm" name="ValidationForm" method="post" action="" class="text-center">
												  <button type="submit" form="ValidationForm" class="btn btn-info mb-3"  name="ValiderFiche" value="ValiderFiche"><i class=" fas fa-check-circle"></i> Valider la fiche</button>

												  </form>';
										}

							


						}
						else
						{
							echo '<div class="col-md-8"><div class=" card-body text-center alert alert-dismissible alert-warning">
							  <button type="button" class="close" data-dismiss="alert">&times;</button><h4>
							   Aucune fiche de frais pour le mois de '.$periode.'</h4>
							</div></div>';
						}
					}

					catch ( PDOEeption $e)
					{
						echo ('Erreur de connexion !');
						die();
					}
				}
				
				if(isset($_POST['supprimerHorsForfait']) and $_POST['supprimerHorsForfait'] != '')
				{
					$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');

					//$requeteSupprimer = 'delete from lignefraishorsforfait where id ='.$_POST['supprimerHorsForfait'];
					$requeteRecuperer = 'select libelle from lignefraishorsforfait where id ='.$_POST['supprimerHorsForfait'];
					
					$execution = $connexion->query($requeteRecuperer);
					$libelle = $execution->fetch();
					$requeteSupprimer = 'update lignefraishorsforfait set libelle = \'REFUSE_'.$libelle['libelle'].'\' where id ='.$_POST['supprimerHorsForfait'];
					$connexion->query($requeteSupprimer);
					echo '<div class="col-md-8"><div class=" card-body text-center alert alert-dismissible alert-success">
							  <button type="button" class="close" data-dismiss="alert">&times;</button><h4>
							  La ligne de frais hors forfait à bien été supprimer !</h4>
							</div></div>';
				}

				if(isset($_POST['ValiderFiche']) and $_POST['ValiderFiche'] != '')
				{
					$connexion=new PDO('mysql:host=localhost;dbname=gsbbdd;charset=utf8','root', '');

					$requeteSupprimer = 'update fichefrais set idEtat = \'VA\' where idVisiteur ='.$_SESSION['id'].' and mois ='.$_SESSION['periode'];
					//echo $requeteSupprimer;
					$connexion->query($requeteSupprimer);
					echo '<div class="col-md-8"><div class=" card-body text-center alert alert-dismissible alert-success">
							  <button type="button" class="close" data-dismiss="alert">&times;</button><h4>
							  la fiche de frais à bien été validé !</h4>
							</div></div>';
				}
			?>	

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