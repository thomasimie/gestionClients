<?php

class Commentaires extends CI_Model
{
	public function getAllCommentaires() // Fonction pour récupérer tous les commentaires dans la table 'commentaires'
	{
		$query = $this->db->get('commentaires');

		if($query->num_rows()>=1) // Si le nombre de commentaires trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des commentaires trouvés
		}
		else
		{
			return FALSE;
		}
	}

	// public function getCommById($id_comm)
	// {
	// 	$this->db->select('commentaire');

	// 	$query = $this->db->get_where('commentaires', array('id_comm' => $id_comm));  // Requête pour trouver le commentaire dans la table 'commentaires'
		
	// 	if($query->num_rows()>=1) // Si le nombre de commentaires trouvés est = ou > à 1
	// 	{
	// 		return $query->result(); // "return" des commentaires trouvés
	// 	}
	// 	else
	// 	{
	// 		return FALSE;
	// 	}
	// }

	public function getCommById($client) // Fonction pour trouver un produit par son id
	{

		$this->db->order_by('date', 'DESC');
		$query = $this->db->get_where('commentaires', array('client' => $client));

		if($query->num_rows()>=1)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	public function getCommentaire($client) // Fonction pour trouver un commentaire 
	{
		$this->db->select('commentaire');

		$query = $this->db->get_where('commentaires', array('client' => $client));  // Requête pour trouver le commentaire dans la table 'commentaires'
		
		if($query->num_rows()>=1) // Si le nombre de commentaires trouvés est = ou > à 1
		{
			return $query->result(); // "return" des commentaires trouvés
		}
		else
		{
			return FALSE;
		}
	}

	public function getDernierCommentaire($client) // Fonction pour trouver le dernier commentaire laissé sur un client
	{
		$this->db->select('commentaire');
		$this->db->from('commentaires');
		$this->db->where(array('client' => $client));
		$this->db->order_by('date', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		//$query = $this->db->get_where('commentaires', array('client' => $client));  // Requête pour trouver le client dans la table 'clients'
		
		if($query->num_rows()>=1) // Si le nombre de commentaires trouvés est = ou > à 1
		{
			return $query->result(); // "return" des commentaires trouvés
		}
		else
		{
			return FALSE;
		}
	}

	public function getCommUser($id_user)
	{
		$this->db->select('client');

		$query = $this->db->get_where('commentaires', array('client' => $id_user));

		if($query->num_rows()>=1) // Si le nombre de commentaires trouvés est = ou > à 1
		{
			return $query->result(); // "return" des commentaires trouvés
		}
		else
		{
			return FALSE;
		}

	}

	public function insertCommentaire($comm, $client, $user) // Fonction pour ajouter un commenaitre à la BDD
	{
		// Affectation des données reçues en paramètre dans un tableau "$data"
		$data = array(
			'commentaire' => $comm,
			'client' => $client,
			'utilisateur' => $user);

		$query = $this->db->insert('commentaires', $data); // Ajout à la table 'commentaires' 

		if($query)
		{
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

	public function updateCommentaire($id, $val)
	{
		$this->db->where('id_comm', $id); // Affectation du client dont l'id correspond à "$id"
		$this->db->update('commentaires', array('commentaire' => $val)); // Changement du nom de l'entreprise remplacé par "$val"
	}

	public function deleteCommentaire($id)
	{
		if($this->db->where('id_comm', $id)) // Si l'id est bien dans la BDD
		{
			$query = $this->db->delete('commentaires'); // Suppression de la BDD
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}
}