<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

		public function index()
	{

		//mandar mensajea nuestra vistas
		$datos['titulo']='HOLA MUNDO';

		$this->load->view('welcome_message',$datos);
	}
}
