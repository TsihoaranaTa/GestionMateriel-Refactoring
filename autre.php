<?php
	require_once 'include/include.php';
	$title = 'Espace Utilisateur régulier';
	if(!Utilisateur::utilisateurConnecte()):
		Application::alert('vous devez connecter pour consulter cette page');
		Application::redir('login/');
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <!-- Bootstrap core CSS -->
  <link href="style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="style/custom.style.css" rel="stylesheet">
</head>
<body>

	<div id="main">
		<div id="header">
			<div id="logo">
				<div id="logo_text">
					<h1>
						<a href="#"><span class="logo_colour">gestion de stock</span></a>
					</h1>
					
				</div>
			</div>
			<?php require 'include/cssmenu_autre.php'; ?>
			<div id="site_content">
			<?php// require_once 'include/side_bar.php'; ?>
			</div>
			<div id="footer">
			</div>
		</div>
	</div>
	  <script type="text/javascript" src="style/mdb4/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="style/mdb4/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="style/mdb4/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="style/mdb4/js/mdb.min.js"></script>
</body>
</html>