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
						<a href="#"><span class="logo_colour">gestion de matériels</span> </a>
					</h1>
				</div>
			</div>
			<?php require '../include/cssmenu_admin2.php'; ?>
			<div id="site_content">
			<?php require_once '../include/side_bar_gammes.php'; ?>
				<div id="content">
					<a href="ajouter_direction.php">ajouter direction</a><br/>
					<a href="afficher_direction.php?n=1">afficher direction (<?php echo Direction::nb(); ?>)</a><br />
					<a href="rechercher_direction.php">rechercher direction</a><br />
					<a href="../include/telecharger_liste.php?table=directions" target="_blank">télécharger liste des directions</a><br />
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!-- Footer -->

 <footer class="page-footer font-small blue" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->