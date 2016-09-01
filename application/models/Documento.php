<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Model {

	public function crear_documento($documento_nombre)
	{
		$documento = array(
				"notaria_id"	=> 1
				,"nombre"		=> $documento_nombre
			);

		$this->db->insert('documento', $documento);

		return $this->db->insert_id();
	}

	public function crear_pagina($documento_id, $pagina_configuracion, $pagina_contenido)
	{
		$pagina = array(
				"documento_id" 	=> $documento_id,
				"configuracion"	=> $pagina_configuracion,
				"contenido"		=> $pagina_contenido
			);

		$this->db->insert('pagina', $pagina);

		return $this->db->insert_id();
	}
}