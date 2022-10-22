<?php

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('ProductModel');
	}

	public function index()
	{
		$query = $this->db->get_where('products', array('status' => 1));
		$data['products'] = $query->result();

		$this->load->view('partials/header');
		$this->load->view('product/list', $data);
		$this->load->view('partials/footer');

	}

	public function create()
	{
		$productModel = new ProductModel();
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
		$query = $this->db->get_where('products', array('id' => $id));
		$allQuery = $this->db->get_where('products', array('status' => 1));
		$query_ing = $this->db->get_where('products_ingredients', array('product_id' => $id));
		$data['product'] = $query->result()[0];
		$data['all_products'] = $allQuery->result();
		$data['product_ingredients'] = $query_ing->result();

		$checked_products = array();

		if (isset($data['all_products']) && isset($data['product_ingredients'])){

			foreach ($data['all_products'] as $product){

				foreach ($data['product_ingredients'] as $ingredient) {
					if ($ingredient->ing_product_id == $product->id) {
						$checked_products[] = $product->id;
					}
				}
			}
		}

		$data['product_ingredients'] = $checked_products;

		$this->load->view('partials/header');
		$this->load->view('product/edit', $data);
		$this->load->view('partials/footer');
	}

	public function update()
	{
		$productModel = new ProductModel();
		$productModel->update_item();

		$query = $this->db->get_where('products', array('status' => 1));
		$data['products'] = $query->result();

		$this->load->view('partials/header');
		$this->load->view('product/list', $data);
		$this->load->view('partials/footer');
	}

	public function delete()
	{
		$productModel = new ProductModel();
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
