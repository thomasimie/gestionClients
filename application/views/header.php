<?php // Affectation à la variable "$login" de la SESSION ouverte depuis la page de Login
$login = $this->session->userdata("login");
// Affectation à la variable "$login" de la SESSION ouverte depuis la page de Login
$admin = $this->session->userdata("admin");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clients Allen-Mail</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://bootswatch.com/superhero/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/my_css.css">
</head>
<body>
  <header>
   <nav class="navbar navbar-default">
    <div id="myNavBar" class="container-fluid">
      <div class="navbar-header">
        <button id="btnMenu" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a id="logoNav" class="navbar-brand" href="<?php echo base_url().'connexion'; ?>">
          <img id="logo" src="assets/img/logo-allenmailblue (1).png"></a>
        </div>
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
          <?php
        if(!empty($login)){ // Si le "$login" n'est PAS vide, ajout des liens dans la bar de navigation
        ?>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a id="clients" href="<?php echo base_url().'clients'; ?>" role="button" aria-expanded="false">CLIENTS  <span id="listGlyph" class="glyphicon glyphicon-th-list"></span></a>
          </li>
          <?php
        if($admin==true){ // Si l'utilisateur est admin alors on afficher les onglets de gestion
        ?>
        <li class="dropdown">
          <a id="ajouterClient" href="<?php echo base_url().'ajoutClient'; ?>" role="button" aria-expanded="false">AJOUTER  <span id="plusGlyph" class="glyphicon glyphicon-plus"></span></a>
        </li>
        <li class="dropdown">
          <a id="produitsMenu" href="<?php echo base_url().'ajoutProduit'; ?>" role="button" aria-expanded="false">PRODUITS  <span id="plusGlyph" class="glyphicon glyphicon-shopping-cart"></span></a>
        </li>
        <li class="dropdown">
          <a id="produitsMenu" href="<?php echo base_url().'utilisateurs'; ?>" role="button" aria-expanded="false">UTILISATEURS  <span id="plusGlyph" class="glyphicon glyphicon-user"></span></a>
        </li>
        <?php
      }
      ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a id="decoA" href="<?php echo base_url().'deconnexion';?>"><span class="glyphicon glyphicon-log-out"></span>  DECONNEXION</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a id="clientA" href="#">Bonjour <?php echo $login." ";?><span id="idGlyph" data-toggle="tooltip" title="<?php echo $login;?>" class="glyphicon glyphicon-user"></span>
          <?php
        if($admin==true){ // Si le "$login" n'est PAS vide, ajout des liens dans la bar de navigation
        ?>
        <span class=" glyphicon glyphicon-lock"></span>
        <?php
      }
      ?>
    </a>
  </li>
</ul>
<?php
        }else{ // Si "$login" est vide alors seulement afficher 
        ?>
          <!-- <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="<?php echo base_url().'connexion'; ?>"><span data-toggle="tooltip" title="CONNEXION" class="glyphicon glyphicon-log-int">CONNEXIONS</a>
            </li>
          </ul> -->
          <?php
        }
        ?>
      </div>
    </div>
  </nav>
</header>