<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function loadCommentaires()
	{
		$result = $this->comm->getAllCommentaires(); 
		$data['mesComm']=$result; // Affectation à "$data" des clients 
	}

	public function ajouterCommentaire()
	{

		$comm = $this->input->post('commentaire');
		$client = $this->input->post('client');
		$user = $this->input->post('utilisateur');
		$this->comm->insertCommentaire($comm, $client, $user);
	}

	public function supprimerCommentaire()
	{
		$id = $this->input->post('id_comm');
		$this->comm->deleteCommentaire($id);
	}	

}