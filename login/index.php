
<?php
	$title = 'login';
	require_once '../include/include.php';
	if(Utilisateur::utilisateurConnecte()) {
		Application::redir((Utilisateur::getUtilisateurConnecte()->estAdmin())? Application::$PAGE_ADMIN : Application::$PAGE_USER);
	}
	$error = Utilisateur::pasDelements();
	$afficheMsgErr = false;
	if(isset($_POST['submit'])):	//bouton cliqué
		$login = $_POST['login'];	//le login est unique
		$pw = $_POST['password'];
		$u = new Utilisateur(null, null, $login, $pw, null, null);
		if(Utilisateur::peutConnecter($u)):	//utilisateur existe
			$u = Utilisateur::connecter($u);
			Application::redir(($u->estAdmin())? Application::$PAGE_ADMIN : Application::$PAGE_USER);
		else:
			$afficheMsgErr = true;
		endif;
	endif;
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  .modal-header, h4, .close {
    background-color: #5cb85c;
    color:white !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }
  </style>-->
    <link href="../style/custom.style.css" rel="stylesheet">
    <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
        <link href="../style/fontawesome/css/all.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
</head>
<body class="login-back">

<div class="">
  <br/><br/><br/>
  <h2 class="text-center" style=" color:white;">Suivi de maintenances des matériels informatique</h2>

  <!-- Modal -->
      <div class="modal-dialog cascading-modal " style="  margin-top: 75px;" role="document">

      <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-header default-color white-text login">
                <h4 class="title">
                    <i class="fa fa-lock"></i> Login</h4>
            </div>
        

        	<?php
      		if(!$error):
      	?>
          <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login">
            <div class="modal-body">
            <div class="md-form form-sm form-group">

            	<!-- *****************Username ************** -->
              <i class="fa fa-user prefix"></i>
              <input type="text" class="form-control form-control-sm " name="login" id="login" required>
                <label for="materialFormNameModalEx1">Nom d'utilisateur</label>
            </div>

            <!--******************* Password *****************-->
            <div class="md-form form-sm form-group">
              <i class="fa fa-lock prefix"></i>
              <input type="password" class="form-control form-control-sm" id="psw" name="password" required>
              <label for="aterialFormNameModalEx1"> Mot de passe</label>
            </div>
                        <div class="text-center mt-4 mb-2">
              <button type="submit" name="submit" class="btn btn-default">Login</button>
            </div>
          </div>
            <div class="panel-footer">
              <!--<label><input type="checkbox" value="" checked>Remember me</label>-->
            </div>

          </form>

          <?php
			else:
				echo "Aucun utilisateur trouvé!, l'application doit avoir au moins un administrateur!";
			endif;
		?>
          <!--<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
          <p>Forgot <a href="#">Password?</a></p>
          <br/> <br/> <br/>-->
      
      </div>
  </div> 
</div>
 
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>
      <script type="text/javascript" src="../style/mdb4/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../style/mdb4/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../style/mdb4/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../style/mdb4/js/mdb.min.js"></script>
</body>
</html>
<?php
	if($afficheMsgErr) {
		Application::alert('utilisateur introuvable !');
	}
?>