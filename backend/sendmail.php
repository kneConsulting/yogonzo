<?php
	//var_dump($_POST);
	$resposta = new stdClass();
	extract($_POST);


	$mensagem = "First Name: ".$field1."Last Name: ".$field4."\nEmail: ".$field5."Message: ".$field6;

	// mail(to, subject, message)
	if(mail("kiko127@live.com", "Contact from YoGonzo",$mensagem))
	{
		$resposta->erro = 0;
		$resposta->mensagem = "Your message was sent!";
	}
	else
	{
		$resposta->erro = 1;
		$resposta->mensagem = "Error sending message, please try again.";
	}

	echo json_encode($resposta);