<?php 
# Ucitava konekciju sa bazom
include "db.php";

 
/**
 *  Inicijalizacija polja (html tagove)
 *  Formira polja $title,$h,$p i dodaje njihove vrednosti u $body
 *  $body se dodoaje u glavno polje $html i na kraju se zatvaraju 
 *  nedostajuci tagovi </html> i </body>
 */
class WebStrana
{
	public $html = "<html>";
	public $title;
	public $body = "<body> ";
	public $form;
	public $h ;
	public $p;
	public $input = "<input type='text' name='field'>";
	public $input_submit = "<input type='submit' value='Posalji'>";

	# $form-prosledjen parametar iz konstruktora klase WebForma
	function __construct($form) 
	{
		$this->form = $form;
	}

	/**
	 * [Formira polje $title i dodje u polje $html]
	 * @param  [string] $title_vrednost                
	 */
	public function dodajTitle($title_vrednost)
	{			
		$this->title = "<title>".$title_vrednost."</title>";
		$this->html .= $this->title;
		
	}

	/**
	 * [Formira polje $h i dodaje u polje $body]
	 * @param  [string] $textNaslova     
	 * @param  [string] $velicinaNaslova 
	 */
	public function dodajNaslov($textNaslova, $velicinaNaslova)
	{
		$this->h = "<$velicinaNaslova>$textNaslova</$velicinaNaslova>";
		$this->body .= $this->h;		
	}

	/**
	 * [Formira polje $p i dodaje u polej $body]
	 * @param  [string/int] $pozicija 
	 * @param  [string] $text     
	 */
	public function dodajParagraf($pozicija,$text)
	{
		$this->p = "<p style='margin:$pozicija'>$text</p>";
		$this->body .= $this->p;
		# Posto je ovo poslednja metoda koja se poziva '$forma->dodajParagraf()'
		# Ovde se dodaju preostala polja u $html i zatvraju otvoreni tagovi
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
	public $form;
	
	/**
	 * [Formiranje form polja sa prosledjenim parametrima]
	 * @param [string] $action 
	 * @param [string] $method 
	 */
	function __construct($action,$method)
	{	
		$this->form = "<form action='$action' method='$method'>";

		# Poziva construktor klase WebStrana sa parametrom
		parent::__construct($this->form);
		
	}
}

$forma = new WebForma("webstrana.php","POST"); # Parametri - $action, $method
$forma->dodajTitle("OOP");
$forma->dodajNaslov("OOP Programiranje", "h1");
$forma->dodajParagraf("60 0 30 30", "Neki tekst u paragrafu");
?>


 

 <!-- Linka za pretragu -->
 <br>
 <a href="pretraga.php">Pretraga</a>