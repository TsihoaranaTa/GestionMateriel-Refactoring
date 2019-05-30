<?php
if(!isset($_GET['id']) || empty($_GET['id'])) die('error!');
	$title = 'modifierMouvement id = ' . $_GET['id'];
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	$message = (isset($_SESSION['message']) && !empty($_SESSION['message']))? $_SESSION['message']: '';
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
   <link href="../style/fontawesome/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../include/style/form.css" />
  <script type="text/javascript" src="../include/js/jquery-1.10.1.min.js"></script>
  <link rel="stylesheet" href="../include/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
  <script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
  <script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
  <script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
  <!--<link rel="stylesheet" href="../include/js/jquery-ui-1.10.3/demos/demos.css">-->
  <script type="text/javascript">
    $('document').ready(function(){
      $('#datefield').datepicker();
    });
  </script>
  <script type="text/javascript">
      //fonction qui change affiche l'article et la gamme qui correspond au produit sélectionné
      function updateInfo() {
        var list = document.getElementById('produit');
        var qte_stock = document.getElementById('qte_stock');
        var qte_stock_list = document.getElementById('qte_stock_list');
        var indice = list.selectedIndex;
        qte_stock.innerHTML = qte_stock_list.options[indice].text;
      }
  </script>
</head>
<body onLoad="updateInfo()">
<?php require_once '../include/login_info.php'; ?>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <h1><a href="#"><span class="logo_colour">gestion de stock</span></a></h1>
        </div>
      </div>
    <?php require '../include/cssmenu.php'; ?>
    <div id="site_content">
    <?php require_once '../include/side_bar_gestion_stock.php'; ?>
	<div id="content">
		<?php
			echo 'modifierMouvement id = ' . $_GET['id'] . '<br/>';
			//récupération du mouvement de la base
			$mouvement = Mouvement::get($_GET['id']);
			if($mouvement === Mouvement::$NO_MOUVEMENT) {
				echo 'mouvement introuvable!';
			} else {
				if($mouvement->getType() == 'sortie') {
					$s = Sortie::get($mouvement->getId());
					echo '<div style="border:1px solid #AAA;padding:5px;">';
					echo 'dateSortie: ' . $s->getDateSortie() . '<br/>';
					echo 'idProduit: ' . $s->getIdProduit() . '<br/>';			
					$p = Produit::get($s->getIdProduit());
					echo 'DesignationProduit: ' . $p->getDesignation() . '<br/>';
					echo 'quantitéLivré: ' . $s->getQuantite() . '<br/>';
					echo 'quantitéStock: ' . $p->getQuantite() . '<br/>';
					echo '</div>';
					?>
					<br/>
					<form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>">
					<fieldset>
						<legend>Bon de sortie:</legend>
						<div>
						  <label for="datefield">Date de sortie: </label>
						  <input type='text' id='datefield' required name="datefield" value="<?php echo $s->getDateSortie(); ?>"/><br />
						</div>
						<div>
						  <label for="produit">Produit: </label>
						  <select onChange="updateInfo()" id="produit" name="produit">
							<?php
							$produits = Produit::getAll();
							  foreach ($produits as $produit) {
								$qte_stock[] = $produit->getQuantite();
								?>
								  <option value="<?php echo $produit->getId(); ?>"><?php echo $produit->getDesignation(); ?></option>
								<?php
							  }
							?>
						  </select>
						</div>
						<div>
						  <label for="qte_stock">qte Stock: </label>
						  <span id="qte_stock"></span>
						</div>
						<div>
						  <label for="qte">Qantité livré:</label>
						  <input type="number" min="1" name="qte" required value="<?php echo $s->getQuantite(); ?>"/>
						</div>
						<div>
						  <!-- script pour sélectionner la premiére option des listes de produits et de clients -->
						  <script>
							var produit = document.getElementById('produit');
							produit.selectedIndex = 0;
						  </script>
						</div>
						<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
					  </fieldset>		
					  <select id="qte_stock_list" style="display:none">
						<?php
						  foreach ($qte_stock as $key => $value) { 
							?>
							  <option><?php echo $value; ?></option>
							<?php
						  }
						?>
					  </select>
					  <button type="submit" name="btn_modif">Modification</button>
					</form>
					<?php
				} else {
					$e = Entree::get($mouvement->getId());
					echo '<div style="border:1px solid #AAA;padding:5px;">';
					echo 'dateEntree: ' . $e->getDateEntree() . '<br/>';
					echo 'idProduit: ' . $e->getIdEntree() . '<br/>';			
					$p = Produit::get($e->getIdProduit());
					echo 'DesignationProduit: ' . $p->getDesignation() . '<br/>';
					echo 'quantitéReçu: ' . $e->getQuantite() . '<br/>';
					echo 'quantitéStock: ' . $p->getQuantite() . '<br/>';
					echo '</div>';
					?>
					<br/>
					<form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>">
						<fieldset>
					      <legend>Bon d'entrée:</legend>
					      <div>
					        <label for="datefield">Date d'entrée: </label>
					        <input type='text' id='datefield' name="datefield" required value="<?php echo $e->getDateEntree(); ?>"/>
					      </div>
					      <div>
					        <label for="produit">Produit: </label>
					        <select onChange="updateInfo()" id="produit" name="produit">
					          <?php
					          	$produits = Produit::getAll();
					            foreach ($produits as $produit) {
					              ?>
					                <option value="<?php echo $produit->getId(); ?>"><?php echo $produit->getDesignation(); ?></option>
					              <?php
					            }
					          ?>
					        </select>
					        <!-- script qui permet de sélectionner l'option de la liste précedante -->
					        <script>
					          var produit = document.getElementById('produit');
					          produit.selectedIndex = 0;
					        </script>
					      </div>
					      <div>
					        <label for="qte">Qantité reçu:</label>
					        <input type="number" min="1" name="qte" required value="<?php echo $e->getQuantite(); ?>"/>
					      </div>
					      <span><?php echo $message; $_SESSION['message'] = ''; ?></span>
					    </fieldset>
					    <button type="submit" name="btn_modif">Modification</button>
					</form>
					<?php
				}
			}
		?>
	</div>
    </div>
	</div>
	</div>
</body>
</html>