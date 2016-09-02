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
		<h2>Utilisateurs <span id="userGlyph" class="glyphicon glyphicon-user"></span></h2>
		<?php
				if($mesUtilisateurs==0) // Si il n'y a pas de clients dans la BDD
				{
					echo 'Vide'; 
				}
				else
				{
					?>
					<table id="userTable" class="table table-responsive">
						<thead>
							<th>Prénom</th>
							<th>Nom</th>
							<th>Identifiant</th>
							<!-- <th>Mot de passe</th> -->
							<th>Rôle</th>
						</thead>
						<?php
						foreach ($mesUtilisateurs as $object) 
						{
							?>
							<tbody>
								<tr id="<?php echo $object->id_user ;?>" class="editableTr">
									<td id="<?php echo $object->id_user ;?>" name="prenom" 
										contenteditable="true" class="editableTdUser"><?php echo $object->prenom ;?>
									</td>
									<td id="<?php echo $object->id_user ;?>" name="nom" 
										contenteditable="true" class="editableTdUser"><?php echo $object->nom ;?>
									</td>
									<td id="<?php echo $object->id_user ;?>" name="identifiant" 
										contenteditable="true" class="editableTdUser"><?php echo $object->login ;?>
									</td>
									<td id="<?php echo $object->id_user ;?>" name="role" 
										contenteditable="false" class="editableTdUser">
										<select class="form-control" name="role" id="selectRole">
											<?php 
											if($object->admin == 1)
											{
												?>
												<option value="1">Administrateur</option>
												<option value="0">Utilisateur</option>
												<?php
											}
											else
											{
												?>
												<option value="0">Utilisateur</option>
												<option value="1">Administrateur</option>
												<?php
											}
											?>
										</select>
									</td>
									<td><span name="<?php echo $object->prenom ;?>" class="trashUtil glyphicon glyphicon-trash">
									</span></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<?php
				}
				?>
				<div class="form-group">
					<div class="input-group col-sm-7">
						<span id="addUser" class="input-group-addon">Ajouter utilisateur</span>
						<span class="input-group-btn">
							<button id="ajoutUser" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"></span></button>
						</span>
					</div>
				</div>
				<div>
					<form id="formUser" action="" method="post" class="form-horizontal">
						<fieldset>
							<legend>Nouvel Utilisateur</legend>
							<div class="form-group">
								<label class="col-lg-4 control-label">Prénom</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" id="inputPrenom" name="prenom" placeholder="Prénom">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Nom</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" id="inputNom" name="nom" placeholder="Nom">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Identifiant</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" id="inputLogin" name="identifiant" placeholder="identifiant">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Mot de passe</label>
								<div class="col-lg-4">
									<input type="password" class="form-control" id="inputMdp" name="mdp" placeholder="mot de passe">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Rôle</label>
								<div class="col-lg-4">
									<select id="inputRole" class="form-control" name="role">
										<option value="0">Utilisateur</option>
										<option value="1">Administrateur</option>
									</select>
								</div>
							</div>
							<div class="input-group col-sm-7">
								<span class="input-group-addon">Valider</span>
								<span class="input-group-btn">
									<button id="btnNewUser" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"></span></button>
								</span>
							</div>
						</fieldset>
					</form>
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