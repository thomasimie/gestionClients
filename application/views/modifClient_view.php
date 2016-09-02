<?php 
$admin = $this->session->userdata("admin"); // Affectation à la variable "$admin" de la SESSION ouverte depuis la page de Login
$login = $this->session->userdata("login"); // Affectation à la variable "$login" de la SESSION ouverte depuis la page de Login
if(isset($login)) // Si il y a bien une session "$login" d'ouverte afficher la div de la page
{
	?>
	<div id="detailsDiv" class="container">
		<?php
	if($admin==true){ // Si admin connecté, alors afficher la div de la page
		?>
		<h2>Modifier <span id="pencilGlyph" class="glyphicon glyphicon-pencil"></span></h2>
		<?php
		foreach ($monClient as $object) 
		{
			?>
			<table id="editableTable" class="table table-responsive table-striped">
				<tbody>
					<tr>
						<th>Identifiant : </th>
						<td	class="editableTd"><?php echo $object->id_client ;?></td>
					</tr>
					<tr>
						<th>Entreprise : </th>
						<td id="<?php echo $object->id_client ;?>" name="entreprise" contenteditable="true" 
							class="editableTd"><?php echo $object->entreprise ;?></td>
						</tr>
						<tr>
							<th>Produit : </th>
							<td>
								<select id="<?php echo $object->id_client ;?>" name="produit" class="form-control editableTd" contenteditable="true">
									<?php 
									if ($produits==0) 
									{
										echo '(vide)';
									}else
									{
										?>
										<option selected="selected">
											<?php
											if ($prod==0) 
											{
												echo 'vide';
											}
											else
											{
												foreach ($prod as $object1) 
												{
													echo $object1->nom;
												}
											}
											?>
										</option>
										<?php
										foreach ($produits as $object2) 
										{
											?>
											<option >
												<?php echo $object2->nom; ?>
											</option>
											<?php
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th>Commentaire : </th>
							<td class="tdComment" id="<?php echo $object->id_client ;?>" name="commentaire" contenteditable="false" 
								class="editableTd">
								<?php
								if ($lastComm==0) 
								{
									echo 'vide';
								}else
								{
									foreach ($lastComm as $object3) 
									{
										echo $object3->commentaire;
									}
								}
								?><span id="upDownSpan" class="glyphicon glyphicon-menu-down"></span>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="commDiv">
									<table class="table">
										<thead>
											<tr>
												<th>Commentaire :</th>
												<th>Date :</th>
												<th>Par :</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if ($lastComm==0) 
											{
												echo '';
											}else
											{
												foreach ($comm as $object4) 
												{
													?>
													<tr class="myComments">
														<td>
															<?php
															echo $object4->commentaire;
															?>
														</td>
														<td>
															<?php
															echo $object4->date;
															?>
														</td>
														<td>
															<?php
															$utilisateur = $this->user->getUtilisateurById($object4->utilisateur);
															foreach ($utilisateur as $key) 
															{
																echo $key->prenom.' '.$key->nom;
															}
															?>
														</td>
														<?php
														if($admin==true)
														{
															?>
															<td id="<?php echo $object4->id_comm; ?>" class="supprComm"> 
																<span class="glyphicon glyphicon-trash"></span>
															</td>
															<?php
														}
														?>
													</tr>
													<?php
												}
											}
											?>
											<tr>
												<td>
													<span id="newComm" class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Ajouter commentaire"></span>
												</td>
												<td></td>
												<td id="commUp">
													<span class="glyphicon glyphicon-menu-up" data-toggle="tooltip" title="Réduire"></span>
												</td>
											</tr>
											<tr class="newCommTr">
												<td colspan="2">
													<textarea class="newComment" placeholder="commentaire"></textarea>
												</td>
												<?php 
												$user = $this->user->getUtilisateurByLogin($login);
												foreach ($user as $key) 
												{
													?>
													<td id="<?php echo $object->id_client ;?>" class="<?php echo $key->id_user ;?>">
														<button id="submitComm" class="btn btn-primary" type="button">
															Ajouter</button>
														</td>
														<?php
													}
													?>
												</tr>
											</tbody>
										</table>
									</div>
								</td>
							</tr>
							<tr>
								<th>Devis : </th>
								<td id="<?php echo $object->id_client ;?>"  name="devis" contenteditable="true" 
									class="editableTd"><?php echo $object->devis.' €' ;?></td>
								</tr>
								<tr>
									<th>Contact : </th>
									<td id="<?php echo $object->id_client ;?>"  name="contact" contenteditable="true" 
										class="editableTd"><?php echo $object->contact ;?></td>
									</tr>
									<tr>
										<th>E-mail : </th>
										<td id="<?php echo $object->id_client ;?>"  name="email" contenteditable="true" 
											class="editableTd"><?php echo $object->email ;?></td>
										</tr>
										<tr>
											<th>Téléphone : </th>
											<td id="<?php echo $object->id_client ;?>"  name="telephone" contenteditable="true" 
												class="editableTd"><?php echo $object->telephone ;?></td>
											</tr>
											<tr>
												<th>Adresse : </th>
												<td id="<?php echo $object->id_client ;?>"  name="adresse" contenteditable="true" 
													class="editableTd"><?php echo $object->adresse ;?></td>
												</tr>	
											</tbody>				
										</table>
										<?php
									}
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