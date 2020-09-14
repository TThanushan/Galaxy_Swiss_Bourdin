<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Galaxy Swiss Bourdin | Index </title>
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
				<ul class="navbar-nav ml-auto" >
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
			<h1 class="display-4"> Medecine. Innovation. Avenir</h1>
			<p class="lead"> Le laboratoire Galaxy Swiss Bourdin (GSB) est issu de la fusion entre le géant américain Galaxy (spécialisé dans le secteur des maladies virales dont le SIDA et les hépatites) et le conglomérat européen Swiss Bourdin. </p>

			<p class="lead"> 
				<a class="btn btn-primary btn-lg" href="#" role="button">En savoir plus</a>
			</p>
		</div>
 
		<div id="slides" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#slides" data-slide-to="0" class="active"></li>
				<li data-target="#slides" data-slide-to="1"></li>
				<li data-target="#slides" data-slide-to="2"></li>
			</ul>


			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="../Ressources/slide1.png" style="width:100%;">
				</div>

				<div class="carousel-item">
					<img src="../Ressources/slide2.png" style="width:100%;">
				</div>

				<div class="carousel-item">
					<img src="../Ressources/slide3.png" style="width:100%;">
				</div>
			</div>

			<!-- Left and right controls 
				
				<a class="carousel-control-prev" href="#slides" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
				</a>
				<a class="carousel-control-next" href="#slides" data-slide="next">
					<span class="carousel-control-next-icon"></span>
				</a>

			<footer class="bg-primary">
				<div class="text-center ">
					<span class="text-muted">Place sticky footer content here.</span>
				</div>
			</footer>
		<footer class="footer bg-primary mt-3 pt-2 pb-2">
		  <div class="container text-center align-middle ">
		    <span class=" text-light ">Galaxy Swiss Bourdin, Copyright &copy; 2018</span>
		  </div>
		</footer>
			-->
		</div>

		<div class="row mt-5">
			<div class="col-12 mb-3"> <h2 class="text-center"> Actualités </h2> </div>
			<div class="col-sm-12 col-md-4">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h5 class="card-title">Qui sommes nous</h5>
						<p class="cart-text"> Au cours des dernières années, Galaxy Swiss Bourdin a su accompagner les médecins dans leurs choix de médicaments. De par son analyse de marché et ses compétences acquises, elle est le compagnons idéale.</p>
						<a href="#" class="card-link">Plus d'infos</a>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-4">
				<div class="card mb-4">
					<div class="	card-body text-center">
						<h5 class="card-title">Nouveau partenariat : Harchtung</h5>
						<p class="cart-text"> Galaxy Swiss Bourdin est fier d'annoncer publiquement sont partenariat officiel avec la marque Harchtung. Il s'agit d'une entreprise de renom international dans le domaine de la neurologie.</p>
						<a href="#" class="card-link">Plus d'infos</a>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-4">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h5 class="card-title">Inauguration du site nouveau site GSB</h5>
						<p class="cart-text"> Après de long mois à travailler dans le silence, nous sommes fier d'annoncer aujourd'hui l'ouverture de notre site GSB. Il agira en tant que lien entre les clients et l'entreprise afin de parvenir au besoins de sa clientèle.</p>
						<a href="#" class="card-link">Plus d'infos</a>
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