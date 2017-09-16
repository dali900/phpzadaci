<?php 
# Ucitava konekciju sa bazom
include "db.php";


class WebStrana
{
	public $dom,$html,$title,$body,$h,$p;
	public $html5,$title5,$body5,$h1,$p5;

	function __construct()
	{
		$this->dom = new DOMDocument('1.0');
		$this->dom->formatOutput=true;	
		$this->html = $this->dom->createElement('html');
		$this->body = $this->dom->createElement('body');
		
	}

	public function dodajTitle($title_vrednost)
	{			
		$this->title = $this->dom->createElement('title',$title_vrednost);
		$this->html->appendChild($this->title);
	}

	public function dodajNaslov($textNaslova, $velicinaNaslova)
	{
		$this->h = $this->dom->createElement($velicinaNaslova,$textNaslova);
		$this->body->appendChild($this->h);
		$this->html->appendChild($this->body);
		$this->dom->appendChild($this->html);
		echo $this->dom->saveHTML();
	}

	public function dodajParagraf($pozicija,$text)
	{
		# code...
	}
}

class WebForma extends WebStrana
{
	
	function __construct()
	{
		parent::__construct();
	}
}

$forma = new WebForma();
$forma->dodajTitle("OOP");
$forma->dodajNaslov("OOP Programiranje", "h1");
?>


 

 <!-- Linka za pretragu -->
 <a href="pretraga.php">Pretraga</a>