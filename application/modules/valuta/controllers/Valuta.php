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
			$data = array('currency' => $value["@attributes"]["currency"], 'rate' => $value["@attributes"]["rate"]);
			if($letezik->num == 0)
				$hibaVane = $this->countuiesModel->setCurrency($data);
			else 
				$hibaVane = $this->countuiesModel->setCurrency($data);
			
			if($hibaVane == false) {
				echo '<script>alert("Gond van az url-en érkező adatokkal, módosúltak kérem lépjek kapcsolatba a kód készítőjével a hiba orvoslására.")</script>';
				break;
			}
		}
	}
}
