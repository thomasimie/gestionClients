<?php

class Clients extends CI_Model
{
	public function getAllClients() // Fonction pour récupérer tous les clients dans la table 'clients'
	{
		$query = $this->db->get('clients');

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE; 
		}
	}

	public function getClientById($id) // Fonction pour trouver un client par son id
	{
		$query = $this->db->get_where('clients', array('id_client' => $id));  // Requête pour trouver le client dans la table 'clients'

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE;
		}
	}

	public function insertClient($entreprise, $produit, $devis, $contact, $email, $tel, $adresse, $user) // Fonction pour ajouter un client à la BDD
	{
		// Affectation des données reçues en paramètre dans un tableau "$data"
		$data = array(
			'entreprise' => $entreprise,
			'produit' => $produit,
			'devis' => $devis,
			'contact' => $contact,
			'email' => $email,
			'telephone' => $tel,
			'adresse' => $adresse,
			'utilisateur' => $user
			);

		$query = $this->db->insert('clients', $data); // Ajout à la table 'clients' 

		if($query)
		{
			return TRUE; 
		}
		else
		{
			return FALSE;
		}

	}

	public function updateClient($col, $id, $val) // Fonction pour changer les caractéristiques du clients
	{	// Boucle SWITCH pour détécter quelle colonne doit être changée par le paramètre "$col"
		switch($col): 
		case 'entreprise': // Si la colonne correspond à 'entrprise'
		$this->db->where('id_client', $id); // Affectation du client dont l'id correspond à "$id"
		$this->db->update('clients', array('entreprise' => $val)); // Changement du nom de l'entreprise remplacé par "$val"
		break;
		case 'produit':
		$this->db->where('id_client', $id);
		$this->db->update('clients', array('produit' => $val));
		break;
		case 'commentaire':
		$this->db->where('id_client', $id);
		$this->db->update('clients', array('commentaire' => $val));
		break;
		case 'devis':
		$this->db->where('id_client', $id);
		$this->db->update('clients', array('devis' => $val));
		break;
		case 'contact':
		$this->db->where('id_client', $id);
		$this->db->update('clients', array('contact' => $val));
		break;
		case 'email':
		$this->db->where('id_client', $id);
		$this->db->update('clients', array('email' => $val));
		break;
		case 'telephone':
		$this->db->where('id_client', $id);
		$this->db->update('clients', array('telephone' => $val));
		break;
		case 'adresse':
		$this->db->where('id_client', $id);
		$this->db->update('clients', array('adresse' => $val));
		break;
		default:
		break;
		endswitch;
	}

	public function deleteClient($id) // Suppression d'un client
	{
		if($this->db->where('id_client', $id)) // Si l'id est bien dans la BDD
		{
			$query = $this->db->delete('clients'); // Suppression de la BDD
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}

	public function orderByEntrepriseAZ()
	{

		$this->db->order_by('entreprise', 'ASC');
		$query = $this->db->get('clients');

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE; 
		}
	} 

	public function orderByDevisCroiss()
	{

		$this->db->order_by('devis', 'ASC');
		$query = $this->db->get('clients');

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE; 
		}
		
	} 

	public function orderByDevisDecroiss()
	{
		$this->db->order_by('devis', 'DESC');
		$query = $this->db->get('clients');

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE; 
		}
	}

	public function orderByDateCroiss()
	{
		$this->db->order_by('date', 'ASC');
		$query = $this->db->get('clients');

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE; 
		}
	}

	public function orderByDateDecroiss()
	{
		$this->db->order_by('date', 'DESC');
		$query = $this->db->get('clients');

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE; 
		}
	}

	public function getLastClient()
	{
		$this->db->select('id_client');
		$this->db->select_max('id_client');
		$query = $this->db->get('clients');

		if($query->num_rows()>=1) // Si le nombre de clients trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE; 
		}
	} 

}
