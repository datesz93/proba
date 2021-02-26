<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class CountuiesModel extends CI_Model {

    function __construct() {
		parent::__construct();
	}

	public function setCurrency($currency,$rate) {
		$sql = "INSERT INTO EuropeBank (currency, rate)
					VALUES (?, ?);";

		$data = array($currency,$rate);
	    $this->db->query($sql, $data);
	}

	public function getCurrency() {
		$this->db->select('COUNT(rate) as num');
		$query = $this->db->get('EuropeBank')->row();

		return $query;
	}

	public function setCurrencyLogikaiTorles() {
		$data = array(
		        'logikai' => '1',
		        'TorlesIdo' => date('Y-m-d H:i:s')
		);
		$this->db->where('logikai', 0);
		$this->db->update('EuropeBank', $data);
	}
}
