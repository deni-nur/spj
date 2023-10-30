<?php

Class fungsi {
	
	protected $ci;

	function __construct() {
		$this->ci =& get_instance();
	}

	function user_login() {
		$this->ci->load->model('user_m');
		$user_id = $this->ci->session->userdata('userid');
		$user_data = $this->ci->user_m->get($user_id)->row();
		return $user_data;
	}

	// function tahun_login() {
	// 	$this->ci->load->model('portal_m');
	// 	$portal_id = $this->ci->uri->segment(2);
	// 	$tahun_data = $this->ci->portal_m->get($portal_id)->row();
	// 	return $tahun_data;
	// }
	
	function PdfGenerator($html, $filename, $paper, $orientation)
	{
		$dompdf = new Dompdf\Dompdf();
		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper($paper, $orientation);
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream($filename, array('Attachment' => 0));
	}

}