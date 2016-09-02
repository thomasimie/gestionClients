<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProduitsController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function loadpage($args, $mydata) // Fonction pour charger la page 
	{
		$this->load->view('header'); // "header" pour le haut de page
		$this->load->view($args, $mydata); // "$args" pointe vers le fichier "views" à charger et "$mydata" aux données à envoyer vers la page
		$this->load->view('footer'); // "footer" pour le bas de page
	}

	public function loadProduits() // Fonction pour afficher tous les clients
	{
		$result = $this->produits->getAllProduits(); 
		$data['mesProduits']=$result; // Affectation à "$data" des clients 
		$this->loadpage('produits_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}

	public function nouveauProduit() // Fonction pour ajouter un produit
	{
		$produit = $this->input->post('produit'); // Affectation à "$produit" du produit passé en POST
		$this->produits->insertProduit($produit); // Ajout du produit
	}

	public function modifierProduit() // Fonction pour modifier un produit
	{
		$id = $this->input->post('id'); // Affectation à "$id" de l'id passé en POST
		$val = $this->input->post('val'); // Affectation à "$val" de la valeur passé en POST
		$this->produits->updateProduit($id, $val); // Mise à jour du produit
	}

	public function supprimerProduit() // Fonction pour supprimer un produit
	{
		$id = $this->input->post('id'); // Affectation à "$id" de l'id passé en POST
		$this->produits->deleteProduit($id); // Suppression du produit
	}

} 