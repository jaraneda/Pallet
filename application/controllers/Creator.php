<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creator extends CI_Controller {

	public function index()
	{
		$this->load->view('creator');
	}

	public function crear_documento()
	{
		$this->load->model('documento');

		$nombre 	= $this->input->post('documento_nombre', TRUE);
		$paginas 	= $this->input->post('documento_paginas', TRUE);

		log_message("error", $nombre);
		log_message("error", $paginas);

		// Creación del documento
		$documento_id = $this->documento->crear_documento($nombre);


		// Creación de las hojas
		$paginas_decode = json_decode($paginas);

		foreach ($paginas_decode['paginas'] as $pagina => $contenido) {
			$pagina_id = $this->documento->crear_pagina($documento_id,$paginas_decode['configuracion'],$contenido);
		}
		
		echo "finalizado";
	}
}
