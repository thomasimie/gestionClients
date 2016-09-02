<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ClientsController extends CI_Controller { 

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

	public function loadClients() // Fonction pour afficher tous les clients
	{
		$result = $this->clients->getAllClients(); 
		$data['mesClients']=$result; // Affectation à "$data" des clients 

		$this->loadpage('clients_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}

	public function clientsDetails() // Fonction pour afficher les détails d'un client
	{
		$id = $_GET["id"]; // Méthode GET pour récupérer l'id dans l'url
		$result = $this->clients->getClientById($id); 
		$data['monClient'] = $result; // Affectation à "$data" des données du client 
		
		foreach ($result as $object) 
		{
			$data['prod'] = $this->produits->getProduitById($object->produit);
			$data['lastComm'] = $this->comm->getDernierCommentaire($object->id_client);
			$data['comm'] = $this->comm->getCommById($object->id_client);
		}

		$this->loadpage('detailsClient_view', $data);
	}

	public function nouveauClient() // Fonction pour ajouter un client
	{
		$this->load->library('form_validation'); // Chargement de la librairie de validation
		$this->load->helper('form');

		$this->form_validation->set_rules('entreprise', 'Entreprise', 'trim|required|max_length[25]|xss_clean');
		$this->form_validation->set_rules('produit', 'Produit', 'required|xss_clean');
		$this->form_validation->set_rules('commentaire', 'Commentaire', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('devis', 'Devis', 'trim|required|max_length[12]|xss_clean');
		$this->form_validation->set_rules('contact', 'Contact', 'trim|required|max_length[25]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[40]|xss_clean');
		$this->form_validation->set_rules('adresse', 'Adresse', 'trim|required|min_length[5]|max_length[100]|xss_clean');		

		$resultProduits = $this->produits->getAllProduits(); // Affectation à "$resultProduits" des produits dans la BDD
		$data['mesProduits']=$resultProduits; // Affectation à "$data" des produits	

		$this->loadpage('nouveauClient_view', $data); // Chargement de la page 'nouveauClient_view'

		if(isset($_POST['submit'])) // Si l'utilisateur clique sur le bouton "Envoyer" du formulaire 
		{
			if ($this->form_validation->run() == TRUE) // Si les champs sont validés
			{
				$login = $this->session->userdata("login");
				
				// Affectation aux variables des données passées en POST
				$entreprise = $this->input->post('entreprise');
				$produit = $this->input->post('produit');
				$commentaire = $this->input->post('commentaire');
				$devis = $this->input->post('devis');
				$contact = $this->input->post('contact');
				$email = $this->input->post('email');
				$tel = $this->input->post('telephone');
				$adresse = $this->input->post('adresse');
				$utilisateur = $this->user->getUtilisateurByLogin($login);

				foreach ($utilisateur as $key1) 
				{
					$user = $key1->id_user;
					$query = $this->clients->insertClient($entreprise, $produit, $devis, $contact, $email, $tel, $adresse, $user); // Requête pour ajouter les nouvelles données 
				}

				$id_client = $this->clients->getLastClient();
				foreach ($id_client as $key) 
				{
					$client = $key->id_client;
					$newComm = $this->comm->insertCommentaire($commentaire, $client, $user);
				}

				if($query==TRUE) // Si la requête "retourne" TRUE alors redirection vers la page 'clients'
				{
					header('Location: clients');
				}
			}else
			{
				header('');
			}
		}

	}

	public function modifierClient() // Fonction pour modifier les caractéristiques d'un client
	{
		$id1 = $_GET["id"]; // Méthode GET pour récupérer l'id dans l'url
		$result = $this->clients->getClientById($id1);
		$data['monClient']=$result; // Affectation à "$data" des données du client
		$data['produits'] = $this->produits->getAllProduits();
		foreach ($result as $object) 
		{
			$data['prod'] = $this->produits->getProduitById($object->produit);
			$data['lastComm'] = $this->comm->getDernierCommentaire($object->id_client);
			$data['comm'] = $this->comm->getCommById($object->id_client);
		}
		$this->loadpage('modifClient_view', $data);
		
		// Affectation aux variables des données passées en POST
		$col = $this->input->post('col'); 
		$id = $this->input->post('id');
		$nom = $this->input->post('val');
		
		if ($col=='produit') 
		{
			$val = $this->produits->getProduitByName($nom);
			foreach ($val as $key) 
			{
				$this->clients->updateClient($col, $id, $key->id_produit);
			}
			
		}else
		{
			$this->clients->updateClient($col, $id, $nom); // Mise à jour du client avec les nouvelles données
		}

		
		
	}

	public function supprimerClient() // Fonction pour supprimer un client
	{
		$id = $this->input->post('id'); // Affectation à "$id" de l'id passé en POST 
		$this->clients->deleteClient($id); // Suppression du client
	}

	public function triEntrAZ()
	{
		$result = $this->clients->orderByEntrepriseAZ(); // Appel de la fonction pour trier les entreprises par ordre alphabétique
		$data['mesClients']=$result; // Affectation à "$data" des clients 
		$this->loadpage('clients_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}

	public function triDevisCroiss()
	{
		$result = $this->clients->orderByDevisCroiss(); // Appel de la fonction pour trier les devis par ordre croissant
		$data['mesClients']=$result; // Affectation à "$data" des clients 
		$this->loadpage('clients_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}

	public function triDevisDecroiss()
	{
		$result = $this->clients->orderByDevisDecroiss(); // Appel de la fonction pour trier les devis par ordre décroissant
		$data['mesClients']=$result; // Affectation à "$data" des clients 
		$this->loadpage('clients_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}

	public function triDateCroiss()
	{
		$result = $this->clients->orderByDateCroiss(); // Appel de la fonction pour trier les devis par ordre décroissant
		$data['mesClients']=$result; // Affectation à "$data" des clients 
		$this->loadpage('clients_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}

	public function triDateDecroiss()
	{
		$result = $this->clients->orderByDateDecroiss(); // Appel de la fonction pour trier les devis par ordre décroissant
		$data['mesClients']=$result; // Affectation à "$data" des clients 
		$this->loadpage('clients_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}
}