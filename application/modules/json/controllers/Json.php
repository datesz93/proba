<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends MX_Controller {
	public function __construct() {
		parent::__construct();
    	$this->load->model('countuies_Model');
	}
	
	public function index()
	{
		echo modules::run('valuta/valuta/index');
		$this->countuies_Model->deleteAll();
		$url = "https://restcountries.eu/rest/v2/all?fields=name;alpha2Code;alpha3Code;capital;subregion;population;currencies";

		$json = file_get_contents($url);
		$json = json_decode($json);

		foreach ($json as $key => $value) {
			$cur = "";
			for ($i=0; $i < count($value->currencies); $i++) {
				$code = ""; $name = ""; $symbol = ""; $euro = "";
				if(isset($value->currencies[$i]->code)) {
					$code = $value->currencies[$i]->code;
				}
				if(isset($value->currencies[$i]->name)) {
					$name = $value->currencies[$i]->name;
				}
				if(isset($value->currencies[$i]->symbol)) {
					$symbol = $value->currencies[$i]->symbol;
				}

				if($code != 'EUR') $euro = $code;

				if($code == "" && $name == "" && $symbol != "") $cur .= $symbol;
				if($code == "" && $name != "" && $symbol == "") $cur .= $name;
				if($code != "" && $name == "" && $symbol == "") $cur .= $code;
				if($code == "" && $name != "" && $symbol != "") $cur .= $name.", ".$symbol;
				if($code != "" && $name != "" && $symbol == "") $cur .= $code.", ".$name;
				if($code != "" && $name == "" && $symbol != "") $cur .= $code.", ".$symbol;
				if($code != "" && $name != "" && $symbol != "") $cur .= $code.", ".$name.", ".$symbol;
				if(count($value->currencies) > 1) $cur .= ";";
			}
			$data = array('name' => $json[$key]->name,
						'alpha2Code' => $json[$key]->alpha2Code, 
						'alpha3Code' => $json[$key]->alpha3Code, 
						'capital' => $json[$key]->capital, 
						'subregion' => $json[$key]->subregion, 
						'population' => $json[$key]->population, 
						'euro' => $euro, 
						'currencies' => $cur
			);
			$hibaVane = $this->countuies_Model->setCountries($data);

			if($hibaVane == false) {
				echo '<script>alert("Gond van az url-en érkező adatokkal, módosúltak kérem lépjek kapcsolatba a kód készítőjével a hiba orvoslására.")</script>';
				break;
			}
		}
		
		$this->load->view('header');
		$this->load->view('welcome_message');
		$this->load->view('footer');
	}
}