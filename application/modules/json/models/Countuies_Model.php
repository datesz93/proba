<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Countuies_Model extends CI_Model {

    function __construct() {
		parent::__construct();
	}

	public function setCountries($data) {

	    $this->db->insert('Countries', $data);
	    $last_id = $this->db->insert_id();

	    if(isset($last_id) && $last_id != '')
	    	return true;
	    else return false;
	}

	public function deleteAll()
	{
		$this->db->empty_table('Countries');
	}

	public function getCountries() {
		$this->db->select('name, alpha2Code, euro, capital, population');
		$query = $this->db->get('Countries')->result();
		$data = array('data' => $query);
		return $data;
	}

	public function getCurrencyAjax($valuta) {
		$this->db->select('rate');
		$this->db->where('logikai', 0);
		$this->db->where('currency', $valuta);
		$this->db->limit(1);
		$query = $this->db->get('EuropeBank')->row();

		return $query;
	}
}
