<?php

class PrescriptionModel extends CI_Model{
	public function insert_item()
	{
		$data = array(
			'name' => $this->input->post('name'),
		);

		$this->db->insert('prescription', $data);

		$lastID = $this->db->insert_id();

		if ($this->input->post('products') != null){
			foreach ($this->input->post('products') as $item) {
				$data = array(
					'prescription_id' => $lastID,
					'ing_pres_id' => $item,
				);

				$this->db->insert('prescription_ingredients', $data);
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
		$this->db->update('prescription', $data);

		$this->db->delete('prescription_ingredients', array('prescription_id' => $this->input->post('product_id')));

		if ($this->input->post('products') != null){
			foreach ($this->input->post('products') as $item) {
				$data = array(
					'prescription_id' => $this->input->post('product_id'),
					'ing_pres_id' => $item,
				);

				$this->db->insert('prescription_ingredients', $data);
			}
		}
	}

	public function delete_item()
	{
		$data = array(
			'status' => 0
		);

		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('prescription', $data);
	}
}
