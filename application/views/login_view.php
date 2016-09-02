<div class="container">
	
	<form action="" method="post" class="form-horizontal">
	<?php echo validation_errors(); ?>
	<?php echo form_open('UserController'); ?>
		<fieldset>
			<legend>Authentification</legend>
			<div class="form-group">
				<label for="inputLogin" class="col-lg-2 control-label">Identifiant : </label>
				<div class="col-lg-5">
					<input type="text" class="form-control" id="inputLogin" name="login" placeholder="Login">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label">Mot de passe : </label>
				<div class="col-lg-5">
					<input type="password" class="form-control" id="inputPassword" name="mdp" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-default">Annuler</button>
					<button type="submit" name="submit" class="btn btn-primary">Valider</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>