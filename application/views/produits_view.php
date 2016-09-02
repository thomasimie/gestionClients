<?php 
$admin = $this->session->userdata("admin"); // Affectation à la variable "$admin" de la SESSION ouverte depuis la page de Login
$login = $this->session->userdata("login"); // Affectation à la variable "$login" de la SESSION ouverte depuis la page de Login
if(isset($login)) // Si il y a bien une session "$login" d'ouverte afficher la div de la page
{
	?>
	<div id="detailsDiv" class="container">
		<?php
		if($admin==true)
	{ // Si admin connecté, alors afficher la div de la page
		?>
		<h2>Produits <span id="produitsGlyph" class="glyphicon glyphicon-shopping-cart"></span></h2>
		<?php
		if($mesProduits==0)
		{
			echo 'Liste vide';
		}
		else
		{
			foreach ($mesProduits as $object) 
			{

				?>
				<div id="<?php echo $object->id_produit ;?>" name="produit" 
					contenteditable="true" class="editableDiv"><?php echo $object->nom ;?>
					<span name="<?php echo $object->nom ;?>" class="trashProd glyphicon glyphicon-trash"></span>
				</div>
				<?php
			}
		}
		?>
		<div class="form-group">
			<div class="input-group col-sm-7">
				<span class="input-group-addon">Ajouter</span>
				<input id="nouveauProd" type="text" class="form-control" placeholder="nouveau produit" size="35">
				<span class="input-group-btn">
					<button id="ajoutProd" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"></span></button>
				</span>
			</div>
		</div>
		<?php
	}
	else
	{ // Si un utilisateur essaie d'accéder à la page afficher message
?>
<p class="msgErr"><span class="glyphicon glyphicon-ban-circle"></span> Accès réservé à l'administrateur</p>
<?php
}
?>
</div>
<?php
}
?>