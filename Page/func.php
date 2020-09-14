<?php
	//Si $type = 0 alors rouge sinon 1 pour vert.
	function afficherMessage($texte, $type = 1)
	{
		if($texte == '')
			return false;

		if($type == 2)
			echo '<div class="message" style=\'background-color:#ff9933;\'> '.$texte.' </div> <br />';
		elseif ($type) {
			echo '<div class="message" style=\'background-color:#00b300;\'> '.$texte.' </div> <br />';
		}
		else
			
			echo '<div class=" card-body text-center alert alert-dismissible alert-danger ">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  '.$texte.'
						</div>';
		return true;
	}
	function insertLigneFraisForfait($bdd, $idFraisForfait, $fraParametre)
	{
		if($fraParametre == '')
			return;

		$requeteType='replace into lignefraisforfait(idVisiteur, mois, idFraisForfait, quantite) values(\''.$_SESSION["id"].'\','.date("Ym").',\''.$idFraisForfait.'\','.$fraParametre.')';

		$execution = $bdd->query($requeteType) or die('');
		//$execution = $bdd->query($requeteType) or die('La requete a planté !'.'  '.$requeteType);

		return $execution;
	}

	function insertFicheFrais($bdd, $id, $idEtat)
	{

			$requete = 'insert ignore into fichefrais(idVisiteur, mois, idEtat) value (\''.$id.'\','.date("Ym").',\''.$idEtat.'\')';

			$execution = $bdd->query($requete) or die('la requete fichefrais a planté ! <br />'.$requete);
			
	}

	function genererUnIdUnique($bdd, $nomTable)
	{
		$resultat = 'a';
		$newId = '';
		while ($resultat != '') {
			
			$newId = generateRandomString(4);
			$requete = 'select id from '.$nomTable.' where id=\''.$newId.'\'';
			

			$execution = $bdd->query($requete) or die('La requete à planté !');

			if($execution != '')
				$resultat = $execution->fetch();

		}

		return $newId;
	
	}

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $randomString = '';

	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

?>