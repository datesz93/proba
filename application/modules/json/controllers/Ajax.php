<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MX_Controller {
public function __construct() {
		parent::__construct();
    	$this->load->model('countuies_Model');
	}

  public function myData() {
      $countries = $this->countuies_Model->getCountries();

      echo json_encode($countries);
  }

  public function euro($valuta) {
  	$currency = $this->countuies_Model->getCurrencyAjax($valuta);

  	if($currency != NULL)
  		echo $currency->rate;
  	else echo "NULL";
  }
}
?>