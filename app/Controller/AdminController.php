<?php

	class AdminController
	{
		public function index()
		{			
				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template  = $twig->load('admin.html');

				$objPostagens = Postagem::selecionaTodos();

				$parametros = array();
				$parametros['postagens'] = $objPostagens;


				$conteudo = $template->render($parametros);
				echo $conteudo;
		}

		public function create(){
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template  = $twig->load('create.html');

				$parametros = array();


				$conteudo = $template->render($parametros);
				echo $conteudo;
		}

		public function insert(){
			try{
				Postagem::insert($_POST);

				echo '<script>alert("Publicação Inserida com Sucesso!");</script>';
				echo '<script>location.href="http://localhost/php/Iniciante/CrudPHP/?pagina=admin&metodo=index"</script>';

			} catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/php/Iniciante/CrudPHP/?pagina=admin&metodo=create"</script>';
			}
		}

		public function deletar($idPost){
			try {
				Postagem::deletar($idPost);

				echo '<script>alert("Publicação Deletada com Sucesso!");</script>';
				echo '<script>location.href="http://localhost/php/Iniciante/CrudPHP/?pagina=admin&metodo=index"</script>';
			} catch(Excepton $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/php/Iniciante/CrudPHP/?pagina=admin&metodo=index"</script>';
			}
		}

		public function change($idPost){
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template  = $twig->load('update.html');

			$post =  Postagem::selecionaPorId($idPost);
			var_dump($post);

			$parametros = array();

			$parametros['id'] = $post->id;
			$parametros['titulo'] = $post->titulo;
			$parametros['conteudo'] = $post->conteudo;


			$conteudo = $template->render($parametros);
			echo $conteudo;
		}

		public function update($idPost){

			try{
				Postagem::update($_POST);
				echo '<script>alert("Publicação Alterada com Sucesso!");</script>';
				echo '<script>location.href="http://localhost/php/Iniciante/CrudPHP/?pagina=admin&metodo=index"</script>';

			} catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/php/Iniciante/CrudPHP/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
			}
			

		}
	}