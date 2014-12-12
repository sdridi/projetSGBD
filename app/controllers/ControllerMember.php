<?php 
require_once("Controller.php");
require_once("../models/produitModel.php");
class ControllerMember extends Controller{
	
	var $memberId;

	function add()
	{
		
	}
	
	function index()
	{
		if( isset($memberId))
		{
		$t = array();
		$t[0] = new produitModel();
		$t[0]->setIdProduit(4);
		$t[0]->setDesignation("chocapic");
		$t[0]->setDescriptif("blablabla");
		$d['panier'] = array('MemberId' => 0,'NbProduit' =>1,'TabProduit' =>$t);
		$this->set($d);
		$this->render("../views/pageBasket");	
		
		//else if($memberId == -1)
		
		}
		else{
		$this->render("../views/home");
		}
	}
	
	function signUp()
	{
		$this->render("../views/pageSignUp");		
	}
	
	function logIn()
	{
		$this->render("../views/pageLogIn");			
	}
	
	function testLogIn()
	{
		$email = $_POST['username'];
		$pass = $_POST['pass'];
		$mb = new MemberModel();
		$mb->setEmail($email);
		$memberId= $mb->checkMdp($pass);
		$this->index();
	}
	
	function addProcess(){
		$firstName = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$adress = $_POST['adress'];
		$city = $_POST['city'];
		$pcode = $_POST['pcode'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$pass = $_POST['pass'];
		$repass = $_POST['repass'];

		if($pass === $repass)
		{
			if(false)//testMail);
			{
				//rajouter le membre
				$mb = new MemberModel();
				$mb->setNom($lastname);
				$mb->setPrenom($firstName);
				$mb->setAdresse($adress);
				$mb->setMail($email);
				$mb->setTel($tel);
				$mb->setMDP($pass);
	
			//setIdVille($id_ville)
 		
			//$this->id_membre = $id_membre;
			
				
			$this->render("../views/pageBasket");
			}
			else
			{
				echo "email already used";
				$this->render("../views/pageSignUp");
				//redirection
			}		
		}
		else
		{ 
			echo "password aren't the same";
			$this->render("../views/pageSignUp");
			//redirection
		}
	}
}
?>