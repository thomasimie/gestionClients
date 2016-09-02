<?php 
$login = $this->session->userdata("login"); // Affectation à la variable "$login" de la SESSION ouverte depuis la page de Login
$admin = $this->session->userdata("admin"); // Affectation à la variable "$admin" de la SESSION ouverte depuis la page de Login
if(isset($login)) // Si il y a bien une session "$login" d'ouverte afficher la div de la page 
{
	?>
	<div id="clientsTable" class="container">
		<table id="myTable" class="table table-hover table-responsive table-bordered">
			<thead>
				<tr>
					<?php
				if($mesClients==0) // Si il n'y a pas de clients dans la BDD
				{
					echo 'Liste vide'; 
				}
				else
				{
					?>
					<th>Entreprise<br/><a data-toggle="tooltip" data-placement="auto" title="Tri par ordre alphabétique" href="<?php echo base_url().'entrAZ';?>">
						<span class="glyphicon glyphicon-sort-by-alphabet"></span></a>
					</th>
					<th>Produit<br/><span class="glyphicon glyphicon-shopping-cart"></span></th>
					<th>Commentaire<br/><span class="glyphicon glyphicon-comment"></span></th>
					<th>Devis € <br/><a data-toggle="tooltip" data-placement="auto" title="Tri croissant" href="<?php echo base_url().'devisCroiss';?>">
						<span class="glyphicon glyphicon-sort-by-order"></span></a>
						<a data-toggle="tooltip" data-placement="auto" title="Tri décroissant" href="<?php echo base_url().'devisDecroiss';?>">
							<span class="glyphicon glyphicon-sort-by-order-alt"></span></th></a>
							<th>Contact<br/><span class="glyphicon glyphicon-user"></span></th>
							<th>E-mail<br/><span class="glyphicon glyphicon-envelope"></span></th>
							<th>Téléphone<br/><span class="glyphicon glyphicon-phone"></span></th>
							<th>Date<br/><a data-toggle="tooltip" data-placement="auto" title="+ récent au + ancien" href="<?php echo base_url().'dateCroiss';?>">
						<span class="glyphicon glyphicon-sort-by-order"></span></a><a data-toggle="tooltip" data-placement="auto" title="+ ancien au + récent" href="<?php echo base_url().'dateDecroiss';?>">
							<span class="glyphicon glyphicon-sort-by-order-alt"></span></a></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($mesClients as $object) // Pour chaque client dans la BDD comme objet 
						{
							?>	
							<tr id="<?php echo $object->id_client ;?>" name="<?php echo $object->entreprise; ?>">
								<td><?php echo $object->entreprise; ?></td>
								<td>
									<?php
									// Affectation à "$prod" du resultat de la fonction "getProduitById($id)"
									$prod = $this->produits->getProduitById($object->produit);
									if ($prod==0) 
									{
										echo '(vide)';
									}else
									{
									foreach ($prod as $key) // Pour le produit associé au client 
									{
										echo $key->nom; // Afficher le nom du produit
									}
								}
									?>
								</td>
								<td>
									<?php
									// Affectation à "$comment" du resultat de la fonction "getDernierCommentaire($id)"
									$comment = $this->comm->getDernierCommentaire($object->id_client);
									if ($comment==0) 
									{
										echo '(vide)';
									}
									else{
									foreach ($comment as $key2) // Pour le/les commentaire(s) associé(s) au client
									{
										echo $key2->commentaire; // Afficher le/les commentaire(s)

									}
								}
								?>
							</td>
							<td><?php echo $object->devis.' €'; ?></td>
							<td><?php echo $object->contact; ?></td>
							<td><?php echo $object->email; ?></td>
							<td><?php echo $object->telephone; ?></td>
							<td><?php
								$originalDate = $object->date;
								$newDate = date("d-m-Y", strtotime($originalDate));
								echo $newDate; ?>
							 </td>
							<td class="glyphTd"><a class="eyeLink" href="<?php echo base_url().
								'detailsClient'.'?id='.$object->id_client;?>">
								<span id="eyeGlyph" data-toggle="tooltip" title="Consulter" 
								class="glyphicon glyphicon-eye-open"></span></a></td>
								<?php
									if($admin==true) // Si admin connecté, alors afficher les icônes/liens pour modifier et supprimer
									{
										?>
										<td class="glyphTd">
											<a href="<?php echo base_url().'modifClient'.'?id='.$object->id_client;?>">
												<span id="pencilGlyph" data-toggle="tooltip" title="Modifier" 
												class="glyphicon glyphicon-pencil"></span>
											</a>
										</td>
										<td class="supprTd">
											<span id="trashGlyph" data-toggle="tooltip" title="Supprimer" 
											class="glyphicon glyphicon-trash"></span>
										</td>
									</tr>
									<?php
								}
							}
						}
						?>
					</tbody>
				</table>
				<table id="myMobileTable" class="table table-responsive table-bordered">
					<thead>
						<tr>
							<?php
							if($mesClients==0)
							{
								echo 'Vide';
							}
							else
							{
								?>
								<th>Entreprise</th>
								<th>Contact</th>
								<th>Téléphone</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($mesClients as $object) 
							{
								?>	
								<tr id="<?php echo $object->id_client ;?>" name="<?php echo $object->entreprise; ?>">
									<td><?php echo $object->entreprise; ?></td>
									<td><?php echo $object->contact; ?></td>
									<td><a id="click2call" href="tel:<?php echo $object->telephone; ?>">
										<?php echo $object->telephone; ?></a></td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
				<div id="confModal"	style="display:none" class="modal-dialog modal-sm">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Confirmer</button>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>