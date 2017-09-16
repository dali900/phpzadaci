<?php 
# Ucitava konekciju sa bazom
include "db.php";


class WebStrana
{
	/**
	 * [Inicijalizacija polja]
	 * [Postavljaju se karakteri @,% gde ce se kasnije zameniti sa parametrima]
	 */
	public $html = "<html> % ";
	public $title = "<title> % </title>";
	public $body = "<body> ";
	public $form;
	public $h = "<@> % </@>";
	public $p = "<p style='margin: POZICIJA'> % </p>";
	public $input = "<input type='text' name='field'>";
	public $input_submit = "<input type='submit' value='Posalji'>";

	/**
	 * [Postavaljamo vrednost polja $form jednako]
	 * @param [type] $form [description]
	 */
	function __construct($form)
	{
		$this->form = $form;
	}

	public function dodajTitle($title_vrednost)
	{			
		$this->title = str_replace("%", $title_vrednost, $this->title);
		$this->html = str_replace("%", $this->title, $this->html);
		
	}

	public function dodajNaslov($textNaslova, $velicinaNaslova)
	{
		$this->h = str_replace("@", $velicinaNaslova, $this->h);
		$this->h = str_replace("%", $textNaslova, $this->h);
		$this->body .= $this->h;		
	}

	public function dodajParagraf($pozicija,$text)
	{
		$this->p = str_replace("POZICIJA", $pozicija, $this->p);
		$this->p = str_replace("%", $text, $this->p);
		$this->body .= $this->p;
		$this->html .= $this->body;
		$this->html .= $this->form;
		$this->html .= $this->input;
		$this->html .= $this->input_submit;
		$this->html .= "</body></html>";
		echo $this->html;
	}
}

class WebForma extends WebStrana
{
	public $form = "<form action=@ method=%>";
	

	function __construct($action,$method)
	{	
		$this->form = str_replace("@", $action, $this->form);
		$this->form = str_replace("%", $method, $this->form);

		parent::__construct($this->form);
		
	}
}

$forma = new WebForma("webstrana2.php","POST");
$forma->dodajTitle("OOP");
$forma->dodajNaslov("OOP Programiranje", "h1");
$forma->dodajParagraf("60 0 30 30", "Neki tekst u paragrafu");
?>


 

 <!-- Linka za pretragu -->
 <br>
 <a href="pretraga.php">Pretraga</a>