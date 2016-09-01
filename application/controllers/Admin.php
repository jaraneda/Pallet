<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$newdata = array(
			'username'	=> 'admin',
			'notaria'	=> 1,
			'logged_in'	=> TRUE
		);
		$this->session->set_userdata($newdata);
	}
	public function index()
	{
		$this->gestion_usuarios();
	}
	public function gestion_usuarios()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('usuario');
			$crud->set_subject('Usuarios');

			$crud->where('notaria_id',$this->session->userdata('notaria'));
			$crud->where('perfil',3);

			$crud->columns('user', 'creacion','estado');
			$crud->display_as('user','Nombre de Usuario')
				->display_as('estado','Estado');

			$crud->fields('user', 'pass', 'estado');	
			$crud->callback_column('estado',array($this,'estadoToHumano'));
			
			$output = $crud->render();

			$this->_load_view('gestion_usuario', $output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	public function estadoToHumano($value, $row)
	{
		return ($value == 1) ? "Activo" : "Deshabilitado";
	}
	private function _load_view($fragment, $args = null)
	{
		$data["outlet"] = $this->load->view($fragment, $args, TRUE);
		$this->load->view('_base/outlet', $data);
	}
}