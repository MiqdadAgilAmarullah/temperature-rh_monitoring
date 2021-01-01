<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function __construct()
	{		
			parent::__construct();
			$this->load->model('M_dataset');
	}

	public function chart()
	{
		
		$data['rh_set'] = $this->M_dataset->get_rh();
		$data['sh_set'] = $this->M_dataset->get_sh();
		$this->load->view('chart',$data);
	}

	public function chart_from_search()
	{
		
		if (isset($_POST['start']) || isset($_POST['end'])) {

			
			$start = $this->input->post("start")." 00:00:00";
			$end = $this->input->post("end")." 23:59:00";
			
			$start = date("Y-m-d H:i:s",strtotime($start));
			$end = date("Y-m-d H:i:s",strtotime($end));
			$tampil_start = date("Y/m/d",strtotime($start));

			// echo $start.$end; die();
		}
		else{
			$start = date("Y-m-d ")." 00:00:00";
			$end = date("Y-m-d")." 23:59:00";
			$tampil_start = date("Y/m/d",strtotime($start));
		}
		$tampil_end = date("Y/m/d",strtotime($end));
		$data['rh_set'] = $this->M_dataset->get_rh_search($start,$end);
		$data['sh_set'] = $this->M_dataset->get_sh_search($start,$end);
		$data['start'] = $tampil_start;
		$data['end'] = $tampil_end;
		// var_dump($data['sh_set']->result());die();
		$this->load->view('chart_from_search',$data);
	}

	public function index()
	{
		$this->load->view('index');
	}
}
