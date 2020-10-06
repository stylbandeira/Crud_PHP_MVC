<?php

$template = file_get_contents('app/Template/estrutura.html');

require_once 'app/Core/Core.php';
//Controllers
require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErroController.php';
require_once 'app/Controller/PostController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Controller/AdminController.php';

require_once 'app/Model/Postagem.php';
require_once 'app/Model/Comentario.php';
require_once 'lib/Database/Connection.php';

require_once 'vendor/autoload.php';


ob_start();

	$core = new Core;
	$core->start($_GET);

	$saida = ob_get_contents();
ob_clean();

$tpl_pronto = str_replace('{{area_dinamica}}', $saida, $template);


echo $tpl_pronto;