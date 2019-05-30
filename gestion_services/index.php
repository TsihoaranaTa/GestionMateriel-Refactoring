<?php
	$title = 'gestionServices';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):
		Application::redir('../login/');
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
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
					<h1><a href="#"><span class="logo_colour">gestion de matériels</span></a></h1>
				</div>
			</div>
			<?php require '../include/cssmenu_admin2.php'; ?>
			<div id="site_content">
				<?php require_once '../include/side_bar_services.php'; ?>
				<div id="content">
					<a href="ajouter_service.php">ajouter service</a><br />
					<a href="afficher_service.php?n=1">afficher services (<?php echo Service::nb(); ?>)</a><br />
					<a href="rechercher_service.php">rechercher service</a><br />
					
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