<?php 
$admin = $this->session->userdata("admin"); // Affectation à la variable "$admin" de la SESSION ouverte depuis la page de Login
$login = $this->session->userdata("login"); // Affectation à la variable "$login" de la SESSION ouverte depuis la page de Login
if(isset($login)) // Si il y a bien une session "$login" d'ouverte afficher la div de la page 
{
?>
<div id="divAjouter" class="container">
	<?php
	if($admin==true){ // Si admin connecté, alors afficher la div de la page
		?>
		<form action="" method="post" class="form-horizontal">
			<fieldset>
				<legend>Nouveau Client</legend>
				<div class="form-group">
					<label for="inputEntreprise" class="col-lg-2 control-label">Entreprise</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="inputEntreprise" name="entreprise" placeholder="Entreprise" value="<?php echo set_value('entreprise'); ?>"><?php echo form_error('entreprise'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Produit</label>
					<div class="col-lg-10">
						<div class="radio">
							<?php
							foreach ($mesProduits as $object) 
							{
								?>	
								<label>
									<input type="radio" name="produit" id="inputProduit" value="<?php echo $object->id_produit." "; ?>" checked="">
									<?php echo $object->nom; ?>
								</label>
								<?php
							}
							?>    
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="inputCommentaire" class="col-lg-2 control-label">Commentaire</label>
					<div class="col-lg-5">
						<textarea class="form-control" rows="3" id="inputCommentaire" 
						name="commentaire" placeholder="Commentaire" value="<?php echo set_value('commentaire'); ?>"></textarea><?php echo form_error('commentaire'); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDevis" class="col-lg-2 control-label">Devis</label>
					<div class="col-lg-2">
						<input type="number" class="form-control" id="inputDevis" name="devis" placeholder="€">
					</div>
					<label>€</label>
				</div>
				<div class="form-group">
					<label for="inputContact" class="col-lg-2 control-label">Contact</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="inputContact" name="contact" placeholder="Contact">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-4">
						<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputTel" class="col-lg-2 control-label">Téléphone</label>
					<div class="col-lg-2">
						<input type="text" class="form-control" id="inputTel" name="telephone" placeholder="Téléphone">
					</div>
				</div>
				<div class="form-group">
					<label for="inputAdresse" class="col-lg-2 control-label">Adresse</label>
					<div class="col-lg-5">
						<input type="text" class="form-control" id="inputAdresse" name="adresse" placeholder="Adresse">
					</div>
				</div>			
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="reset" class="btn btn-default">Annuler</button>
						<input id="submit" type="submit" name="submit" value="Envoyer" class="btn btn-primary">
					</div>
				</div>
			</fieldset>
		</form>
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