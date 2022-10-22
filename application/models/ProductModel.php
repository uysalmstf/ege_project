<?php

class ProductModel extends CI_Model{
	public function insert_item()
	{
		$data = array(
			'name' => $this->input->post('name'),
		);

		$this->db->insert('products', $data);

		$lastID = $this->db->insert_id();
		
		if ($this->input->post('products') != null){
			foreach ($this->input->post('products') as $item) {
				$data = array(
					'product_id' => $lastID,
					'ing_product_id' => $item,
				);

				$this->db->insert('products_ingredients', $data);
			}
		}

		return true;
	}

	public function update_item()
	{

		$data = array(
			'name' => $this->input->post('name'),
		);

		$this->db->where('id', $this->input->post('product_id'));
		$this->db->update('products', $data);

		$this->db->delete('products_ingredients', array('product_id' => $this->input->post('product_id')));

		if ($this->input->post('products') != null){
			foreach ($this->input->post('products') as $item) {
				$data = array(
					'product_id' => $this->input->post('product_id'),
					'ing_product_id' => $item,
				);

				$this->db->insert('products_ingredients', $data);
			}
		}
	}

	public function delete_item()
	{
		$data = array(
			'status' => 0
		);

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('products', $data);
	}
}
