<?php
	require_once '../include/include.php';
	$nb_sorties = Sortie::nb();	//on sauvegarde dans une variable pour ne pas consulter la base une deuxiéme fois
	if (!Utilisateur::utilisateurConnecte())://si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>BonLivraison</title>
	  <link href="../style/custom.style.css" rel="stylesheet">
  	<link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">

</head>
<body>

	/<!-- <body style="font-family: times new roman"> -->
	<div class=" text-center ">
		<br/><br/>
		<h1>Bon de livraison</h1>
		<br/>
		<div class=""> 

			<div class="container ">

  <div class="row justify-content-center">
    <div class="col-2">Numéro de bon :</div>
    <div class="col-2"><?php echo $_GET['bon']; ?></div>

</div><br/>
  <div class="row justify-content-center">
        <div class="col-2">Date de sortie en stock :</div>
    <div class="col-2">	<?php echo $_GET['date_sortie']; ?></div>
</div>	<br/>
  <div class="row justify-content-center">

        <div class="col-2">Quantité sortie :</div>
    <div class="col-2"><?php echo $_GET["quantite"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
  	<div class="col-2">Désignation :</div>
    <div class="col-2"><?php echo $_GET["id_produit"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
<div class="col-2">Référence :</div>
    <div class="col-2"><?php echo $_GET["id_produit"] ?></div>
</div>	<br/>
</div>
</div>


</div>
</br> </br> </br>

<div class="container ">
	
	  <div class="row text-center justify-content-center">
		  <div class="col-2">traité par : </div>
		  
    <div class="col-2"><?php echo $_SESSION['prenom'] ?> <?php echo $_SESSION['nom'] ?></div>
  
  </div>

</div>

</div>	<br/><br/><br/>

<div class="row text-center justify-content-center">
		  
    <div class="col-3">Signature de l'intervenant </div>
    <div class="col-3">Signature du titulaire </div>





<br/><br/><br/>
<div class="text-center">
 <button type="submit" onClick="window.print()" name="btn_submit" value="Fiche" class=""><i class="fas fa-print" font-size: 25px;"></i></button> 
</div>
</body>
</html> </br> </br> </br>
<!-- Footer -->

 <footer class="page-footer font-small default-color" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->