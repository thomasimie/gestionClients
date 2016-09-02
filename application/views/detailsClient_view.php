<?php
$login = $this->session->userdata("login"); // Affectation à la variable "$login" de la SESSION ouverte depuis la page de Login
$admin = $this->session->userdata("admin"); // Affectation à la variable "$admin" de la SESSION ouverte depuis la page de Login
if(isset($login)) // Si il y a bien une session "$login" d'ouverte afficher la div de la page
{
	?>
	<div id="detailsDiv" class="container">
		<h2>Consulter <span id="eyeGlyph" data-toggle="tooltip" 
			title="Consulter" class="glyphicon glyphicon-eye-open"></span></h2>
			<?php
			foreach ($monClient as $object) 
			{
				?>
				<table id="detailsTable" class="table table-responsive table-striped">
					<tbody>
						<tr>
							<th>Identifiant : </th>
							<td	class="editableTd"><?php echo $object->id_client ;?></td>
						</tr>
						<tr>
							<th>Entreprise : </th>
							<td id="<?php echo $object->id_client ;?>" name="entreprise" contenteditable="false" 
								class="editableTd"><?php echo $object->entreprise ;?></td>
							</tr>
							<tr>
								<th>Produit : </th>
								<td id="<?php echo $object->id_client ;?>" name="produit" contenteditable="false" 
									class="editableTd">
									<?php 
									if ($prod==0) 
									{
										echo '(vide)';
									}else
									{
										foreach ($prod as $object2) 
										{
											echo $object2->nom;
										}
									}
									?>
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
									<td id="<?php echo $object->id_client ;?>"  name="devis" contenteditable="false" 
										class="editableTd"><?php echo $object->devis.' €' ;?></td>
									</tr>
									<tr>
										<th>Contact : </th>
										<td id="<?php echo $object->id_client ;?>"  name="contact" contenteditable="false" 
											class="editableTd"><?php echo $object->contact ;?></td>
										</tr>
										<tr>
											<th>E-mail : </th>
											<td id="<?php echo $object->id_client ;?>"  name="email" contenteditable="false" 
												class="editableTd"><?php echo $object->email ;?></td>
											</tr>
											<tr>
												<th>Téléphone : </th>
												<td id="<?php echo $object->id_client ;?>"  name="telephone" contenteditable="false" 
													class="editableTd"><?php echo $object->telephone ;?></td>
												</tr>
												<tr>
													<th>Adresse : </th>
													<td id="<?php echo $object->id_client ;?>"  name="adresse" contenteditable="false" 
														class="editableTd"><?php echo $object->adresse ;?></td>
													</tr>
													<tr>
														<th>Ajouté par : </th>
														<td id="<?php echo $object->id_client ;?>"  name="utilisateur" contenteditable="false" 
															class="editableTd">
															<?php 
															$utilisateur = $this->user->getUtilisateurById($object->utilisateur);
															if ($utilisateur==0) 
															{
																echo '';
															}else
															{
																foreach ($utilisateur as $key) 
																{
																	echo $key->prenom.' '.$key->nom;
																}
															}
															?>
														</td>
													</tr>	
													<tr>
														<th>Date d'ajout : </th>
														<td id="<?php echo $object->id_client ;?>"  name="adresse" contenteditable="false" 
															class="editableTd"><?php echo $object->date ;?></td>
														</tr>	
													</tbody>
												</table>
												<?php
											}
											?>
										</div>
										<?php
									}
									?>