<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NewClientController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
	}

	function index()
	{
		$this->load->view('header');
		$this->load->view('nouveauClient_view');
		$this->load->view('footer');
	}

	public function loadpage($args, $mydata)
	{
		$this->load->view('header');
		$this->load->view($args, $mydata);
		$this->load->view('footer');
	}

	public function newClient()
	{
		$result = $this->articles->getAllArticles();
		$data['mesArticles']=$result;
		$this->loadpage('nouveauClient_view', $data);

		if(isset($_POST['submit']) && strlen($_POST['entreprise']) > 0 && strlen($_POST['article']) > 0  && strlen($_POST['devis']) > 0  && strlen($_POST['contact']) > 0  && strlen($_POST['email']) > 0  && strlen($_POST['telephone']) > 0  && strlen($_POST['adresse']) > 0  && strlen($_POST['commentaire']) > 0 )
		{
			$resultArticles = $this->articles->getAllArticles();
			$data['mesArticles']=$resultArticles;
			$entreprise = $this->input->post('entreprise');
			$article = $this->input->post('article');
			$devis = $this->input->post('devis');
			$contact = $this->input->post('contact');
			$email = $this->input->post('email');
			$tel = $this->input->post('telephone');
			$adresse = $this->input->post('adresse');
			$commentaire = $this->input->post('commentaire');

			$query = $this->clients->insertClient($entreprise, $article, $devis, $contact, $email, $tel, $adresse, $commentaire);
			echo json_encode($query);

			
		}else
		{
			echo 'oops';
		}
	}

}