<?php
	$title = 'gestionDirections';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):
		Application::redir('../login/');
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
	<link rel="stylesheet" type="text/css" href="../include/style/cssmenu.css" />
</head>
<body>
	<?php require_once '../include/login_info.php'; ?>
	<div id="main">
		<div id="header">
			<div id="logo">
				<div id="logo_text">
					<h1>
						<a href="#"><span class="logo_colour">gestion d'interventions</span> </a>
					</h1>
				</div>
			</div>
			<?php require '../include/cssmenu_admin3.php'; ?>
			<div id="site_content">
			<?php require_once '../include/side_bar_etats.php'; ?>
				<div id="content">
					<a href="ajouter_etat.php">ajouter statu</a><br/>
					<a href="afficher_etat.php?n=1">afficher statu (<?php echo Etat::nb(); ?>)</a><br />
					<a href="rechercher_etat.php">rechercher statu</a><br />
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!-- Footer -->

 <footer class="page-footer font-small secondary-color" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->