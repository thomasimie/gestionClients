<?php

class Utilisateurs extends CI_Model
{

	public function getAllUtilisateurs() // Fonction pour récupérer tous les produits dans la table 'produits'
	{
		$query = $this->db->get('utilisateurs');

		if($query->num_rows()>=1) // Si le nombre de produits trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE;
		}
	}

	public function getUtilisateur($login, $mdp) // Fonction pour trouver un utilisateur dans la table 'utilisateurs'
	{
		$query = $this->db->get_where('utilisateurs', array('login' => $login, 'mdp' => $mdp));

		if($query->num_rows()==1) // Si le nombre d'utilisateurs trouvés est = ou > à 1
		{
			return $query->result(); // "return" de l'utilisateur trouvé
		}
		else
		{
			return FALSE;
		}
	}

	public function getUtilisateurById($id)
	{
		//$this->db->select('login');

		$query = $this->db->get_where('utilisateurs', array('id_user' => $id));

		if($query->num_rows()>=1) // Si le nombre d'utilisateurs trouvés est = ou > à 1
		{
			return $query->result(); // "return" de l'utilisateur trouvé
		}
		else
		{
			return FALSE;
		}
	}

	public function getUtilisateurByLogin($login)
	{
		$this->db->select('id_user');

		$query = $this->db->get_where('utilisateurs', array('login' => $login));

		if($query->num_rows()>=1) // Si le nombre d'utilisateurs trouvés est = ou > à 1
		{
			return $query->result(); // "return" de l'utilisateur trouvé
		}
		else
		{
			return FALSE;
		}
	}

	public function getAdmin($login, $mdp)
	{
		$this->db->select('admin');
		// Requête pour savoir si l'utilisateur est admin ('admin' = 1 dans la BDD)
		$query = $this->db->get_where('utilisateurs', array('login' => $login, 'mdp' => $mdp, 'admin' => 1));

		$res = $query->result();

		if($query==true)
		{
			return $res[0]; // "return" de l'utilisateur trouvé
		}
		else
		{
			return false;
		}
	}

	public function insertUtilisateur($prenom, $nom, $login, $mdp, $role) // Fonction pour ajouter un utilisateur à la BDD
	{
		// Affectation des données reçues en paramètre dans un tableau "$data"
		$data = array(
			'prenom' => $prenom,
			'nom' => $nom,
			'login' => $login,
			'mdp' => md5($mdp),
			'admin' => $role
			);

		$query = $this->db->insert('utilisateurs', $data); // Ajout à la table 'utilisateurs' 

		if($query)
		{
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

	public function updateUtilisateur($col, $id, $val, $role)
	{
		switch($col): 
		case 'prenom': // Si la colonne correspond à 'prenom'
		$this->db->where('id_user', $id); // Affectation de l'utiilisateur dont l'id correspond à "$id"
		$this->db->update('utilisateurs', array('prenom' => $val)); // Changement du prenom remplacé par "$val"
		break;
		case 'nom':
		$this->db->where('id_user', $id);
		$this->db->update('utilisateurs', array('nom' => $val));
		break;
		case 'identifiant':
		$this->db->where('id_user', $id);
		$this->db->update('utilisateurs', array('login' => $val));
		break;
		case 'role':
		$this->db->where('id_user', $id);
		$this->db->update('utilisateurs', array('admin' => $role));
		break;
		default:
		break;
		endswitch;
	}

	public function deleteUtilisateur($id) // Fonction pour supprimer un utilisateur
	{
		if($this->db->where('id_user', $id)) // Si l'id est bien dans la BDD
		{
			$query = $this->db->delete('utilisateurs'); // Suppression de la BDD
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}

}