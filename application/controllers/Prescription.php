<?php

class Prescription extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('PrescriptionModel');
	}


	public function index()
	{
		$query = $this->db->get_where('prescription', array('status' => 1));
		$data['prescriptions'] = $query->result();
		$query_products = $this->db->get_where('products', array('status' => 1));
		$data['products'] = $query_products->result();
		$this->load->view('partials/header');
		$this->load->view('prescription/list', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$productModel = new PrescriptionModel();
		if ($productModel->insert_item()){
			$data['success'] = true;
			$data['message'] = 'Process Done';
		} else {
			$data['success'] = false;
			$data['message'] = 'Process Not Done';
		}

		echo json_encode($data, true);
	}

	public function edit($id)
	{
		$query = $this->db->get_where('prescription', array('id' => $id));
		$allQuery = $this->db->get_where('products', array('status' => 1));
		$query_ing = $this->db->get_where('prescription_ingredients', array('prescription_id' => $id));
		$data['prescription'] = $query->result()[0];
		$data['all_products'] = $allQuery->result();
		$data['prescription_ingredients'] = $query_ing->result();

		$checked_products = array();

		if (isset($data['all_products']) && isset($data['prescription_ingredients'])){

			foreach ($data['all_products'] as $product){

				foreach ($data['prescription_ingredients'] as $ingredient) {
					if ($ingredient->ing_pres_id == $product->id) {
						$checked_products[] = $product->id;
					}
				}
			}
		}

		$data['prescription_ingredients'] = $checked_products;

		$this->load->view('partials/header');
		$this->load->view('prescription/edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		$productModel = new PrescriptionModel();
		$productModel->update_item();

		$query = $this->db->get_where('prescription', array('status' => 1));
		$data['prescriptions'] = $query->result();
		$query_products = $this->db->get_where('products', array('status' => 1));
		$data['products'] = $query_products->result();

		$this->load->view('partials/header');
		$this->load->view('prescription/list', $data);
		$this->load->view('partials/footer');
	}

	public function delete()
	{
		$productModel = new PrescriptionModel();
		if ($productModel->delete_item()){
			$data['success'] = true;
			$data['message'] = 'Process Done';
		} else {
			$data['success'] = false;
			$data['message'] = 'Process Not Done';
		}

		echo json_encode($data, true);
	}

}
