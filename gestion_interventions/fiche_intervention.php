<?php
	require_once '../include/include.php';
	$nb_interventions = Intervention::nb();	//on sauvegarde dans une variable pour ne pas consulter la base une deuxiéme fois
	if (!Utilisateur::utilisateurConnecte())://si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fiche d'Intervention</title>
  <link href="../style/custom.style.css" rel="stylesheet">
  	<link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/fontawesome/css/all.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
</head>
<body style="font-family: times new roman">
	<div class=" text-center ">
		<br/><br/><br/><br/><br/><br/>
		<h1>Fiche d'intervention</h1>
		<br/>
		<div class="">

			<div class="container ">

  <div class="row justify-content-center">
    <div class="col-2">Nom :</div>
    <div class="col-2"><?php echo $_GET["nom"] ?></div>
    	
</div><br/>
  <div class="row justify-content-center">
        <div class="col-2">Tickets :</div>
    <div class="col-2"><?php echo $_GET["ticket"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">

        <div class="col-2">Cout d'intervention :</div>
    <div class="col-2"><?php echo $_GET["cout"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
        <div class="col-2">Fin d'intervention :</div>
    <div class="col-2"><?php echo $_GET["temps"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
        <div class="col-2">état :</div>
    <div class="col-2"><?php echo $_GET["id_etat"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
        <div class="col-2">Materiel :</div>
    <div class="col-2"><?php echo $_GET["id_materiel"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
        <div class="col-2">Référence :</div>
    <div class="col-2"><?php echo $_GET["id_materiel"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
        <div class="col-2">Direction :</div>
    <div class="col-2"><?php echo $_GET["id_direction"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
         <div class="col-2">Département :</div>
    <div class="col-2"><?php echo $_GET["id_departement"] ?></div>
</div>	<br/>
  <div class="row justify-content-center">
		  <div class="col-2">Personnel :</div>
    <div class="col-2"><?php echo $_GET["id_personnel"] ?></div>
  </div>
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
</div>
<br/><br/><br/>
<div class="text-center">
<button type="submit" onClick="window.print()" name="btn_submit" value="Fiche" class="flex-fill btn btn-default">Imprimer</button> 
</div>
</body>
</html>
<!-- Footer -->

 <footer class="page-footer font-small secondary-color" style="width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->