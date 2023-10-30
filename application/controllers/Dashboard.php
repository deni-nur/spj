<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('dashboard_m');
	}

	public function index()
	{
		// $dpa = $this->dashboard_m->dpaget();
		// $st = $this->dashboard_m->stget();
		// $sppd = $this->dashboard_m->sppdget();
		// $lhpd = $this->dashboard_m->lhpdget();
		// $pp = $this->dashboard_m->ppget();
		// $kwitansi = $this->dashboard_m->kwitansiget();

		// $data = array(	'dpa'				=>	''.count($dpa).'',
		// 				'st'				=> 	''.count($st).'',
		// 				'sppd'				=> 	''.count($sppd).'',
		// 				'lhpd'				=> 	''.count($lhpd).'',
		// 				'pp'				=> 	''.count($pp).'',
		// 				'kwitansi'			=> 	''.count($kwitansi).''
		// 			);

		$this->template->load('template', 'dashboard');
	}
}
