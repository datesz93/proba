<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valuta extends MX_Controller {
	public function __construct() {
		parent::__construct();
    	$this->load->model('countuiesModel');
	}

	public function index()
	{
		$this->countuiesModel->setCurrencyLogikaiTorles();
		//$euroUrl = "http://www.ecb.europa.eu/stats/exchange/eurofxref/html/index.en.html#dev";
		$letezik = $this->countuiesModel->getCurrency();
		$euroUrl = "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";

		$xml = simplexml_load_file($euroUrl);
		$xmlJson  = json_encode($xml);
		$array = json_decode($xmlJson,TRUE);

		foreach ($array['Cube']['Cube']['Cube'] as $key => $value) {
			if($letezik->num == 0)
				$this->countuiesModel->setCurrency($value["@attributes"]["currency"],$value["@attributes"]["rate"]);
			else 
				$this->countuiesModel->setCurrency($value["@attributes"]["currency"],$value["@attributes"]["rate"]);
		}
	}
}
