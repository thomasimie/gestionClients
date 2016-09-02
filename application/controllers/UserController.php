<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserController extends CI_Controller {

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

	public function loadUtilisateurs() // Fonction pour afficher tous les clients
	{
		$result = $this->user->getAllUtilisateurs(); 
		$data['mesUtilisateurs']=$result; // Affectation à "$data" des clients 
		$this->loadpage('utilisateurs_view', $data); // Chargement de la page 'clients_view' avec les données affectées à $data
	}

	public function nouvelUtilisateur() // Fonction pour ajouter un utilisateur
	{
		// Affectation aux variables des données passées en POST
		$prenom = $this->input->post('prenom');
		$nom = $this->input->post('nom');
		$login = $this->input->post('login');
		$mdp = $this->input->post('mdp');
		$role = $this->input->post('role');
		$this->user->insertUtilisateur($prenom, $nom, $login, $mdp, $role); // Ajout de l'utilisateur
	}

	public function modifierUtilisateur() // Fonction pour modifier les caractéristiques d'un client
	{
		// Affectation aux variables des données passées en POST
		$col = $this->input->post('col'); 
		$id = $this->input->post('id');
		$val = $this->input->post('val');
		$role = $this->input->post('role');
		$this->user->updateUtilisateur($col, $id, $val, $role); // Modification de l'utilisateur
	}

	public function supprimerUtilisateur() // Fonction pour supprimer un client
	{
		$id = $this->input->post('id');  // Affectation à "$id" de l'id passé en POST
		$this->user->deleteUtilisateur($id); // Suppression de l'utilisateur
	}

	public function verifUser() // Fonction pour vérifier que l'utilisateur est dans la table 'utilisateurs'
	{
		$this->load->view('header'); // "header" pour le haut de page
		$this->load->view('login_view'); // corps de page pour le login
		$this->load->view('footer'); // "footer" pour le bas de page
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('login', 'Login', 'required');
		$this->form_validation->set_rules('mdp', 'Mot de Passe', 'required');

		if(isset($_POST['submit'])) // Si l'utilisateur clique sur le bouton "Envoyer" du formulaire
		{
			// Affectation aux variables des données passées en POST
			$login = $this->input->post('login'); 
			$mdp = md5($this->input->post('mdp'));

			$result = $this->user->getUtilisateur($login, $mdp); // Requête pour trouver l'utilisateur avec le "$login" et "$mdp" correspondant

			if ($this->form_validation->run() == TRUE && $result == TRUE ) // Si les données dans le formulaire sont valides et que le "$result" est supérieur à 1
			{
				// Affectation et ouverture d'une SESSION au nom de "login" 
				$this->session->set_userdata("login", $login);
				$this->session->userdata('login');

				$admin = $this->user->getAdmin($login, $mdp); // Requête pour vérifier si l'utilisateur a le statut d'administrateur
				
				// Affectation et ouverture d'une SESSION au nom de "admin" 
				$this->session->set_userdata("admin", $admin);
				$this->session->userdata('admin');

				header('Location: clients'); // Redirection vers la page 'clients'
			}
			else
			{
				header('Location: connexion'); // Si la requête n'est pas égale à TRUE alors on reste sur la page
			}
		}
	}

	public function deconnexion() // Fonction pour deconnecter l'utilisateur et "détruire" la session ouverte
	{
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('admin');
		$this->session->sess_destroy();
		redirect('connexion','refresh'); // Redirection vers la page de Login
	}

}