<?php

class Produits extends CI_Model
{
	
	public function getAllProduits() // Fonction pour récupérer tous les produits dans la table 'produits'
	{
		$query = $this->db->get('produits');

		if($query->num_rows()>=1) // Si le nombre de produits trouvés est = ou > à 1 
		{
			return $query->result(); // "return" des clients trouvés
		}
		else
		{
			return FALSE;
		}
	}

	public function getProduitById($id) // Fonction pour trouver un produit par son id
	{

		$query = $this->db->get_where('produits', array('id_produit' => $id));

		if($query->num_rows()>=1)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	public function getProduitByName($nom) // Fonction pour trouver un produit par son id
	{
		$this->db->select('id_produit');

		$query = $this->db->get_where('produits', array('nom' => $nom));

		if($query->num_rows()>=1)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	public function insertProduit($produit) // Fonction pour ajouter un produit à la BDD
	{
		// Affectation des données reçues en paramètre dans un tableau "$data"
		$data = array('nom' => $produit);

		$query = $this->db->insert('produits', $data); // Ajout à la table 'produits' 

		if($query)
		{
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

	public function updateProduit($id, $val) // Fonction pour changer un produit
	{
		$this->db->where('id_produit', $id); // Affectation du produit dont l'id correspond à "$id"
		$this->db->update('produits', array('nom' => $val)); // Changement du nom du produit remplacé par "$val"
	}

	public function deleteProduit($id) // Fonction pour supprimer un produit
	{
		if($this->db->where('id_produit', $id)) // Si l'id est bien dans la BDD
		{
			$query = $this->db->delete('produits'); // Suppression de la BDD
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
	}

}
