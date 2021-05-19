<?php

	/* ***********************************
	* loadImg($imagem, $nome)
	* Redimenciona das imagens PNG ou JPG
	* $imagem - imagem a se redimencionar
	* $nome - novo nome que esta deve assumir
	* ao final irá apagar a imagem original
	* ********************************** */

	function loadImg($imagem, $nome, $pastaFotos)
	{

		//pega o tipo de imagem - jpg ou png
		$tipo = mime_content_type($imagem);

		//calcula o tamanho da imagem para redimencionar proporcionalmente a largura
		list($largura1, $altura1) = getimagesize($imagem);

		//configuracoes do maior tamanho - desktopos
		$largura = 960;
		$percent = ($largura/$largura1);
		$altura = $altura1 * $percent;

		//configurações para tamanho médio - tablets
		$larguram = 680;
		$percentm = ($larguram/$largura1);
		$alturam = $altura1 * $percentm;

		//configurações para tamanho pequeno - smartphones
		$largurap = 300;
		$percentp = ($largurap/$largura1);
		$alturap = $altura1 * $percentp;

		if ( $tipo == "image/png") {

			$imagem_gerada = $pastaFotos.$nome."g.png";
			$path = $imagem;
			$imagem_orig = ImageCreateFromPNG($path);
			$pontoX = ImagesX($imagem_orig);
			$pontoY = ImagesY($imagem_orig);

			$imagem_fin = ImageCreateTrueColor($largura, $altura);

			imagealphablending($imagem_fin, false);
			imagesavealpha($imagem_fin,true);
			$transparent = imagecolorallocatealpha($imagem_fin, 255, 255, 255, 127);
			imagefilledrectangle($imagem_fin, 0, 0, $largura+1, $altura+1, $transparent);

			ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY);
			ImagePNG($imagem_fin, $imagem_gerada,9);
			ImageDestroy($imagem_orig);
			ImageDestroy($imagem_fin);


			$imagem_gerada = $pastaFotos.$nome."m.png";
			$path = $imagem;
			$imagem_orig = ImageCreateFromPNG($path);
			$pontoX = ImagesX($imagem_orig);
			$pontoY = ImagesY($imagem_orig);

			$imagem_fin = ImageCreateTrueColor($larguram, $alturam);

			imagealphablending($imagem_fin, false);
			imagesavealpha($imagem_fin,true);
			$transparent = imagecolorallocatealpha($imagem_fin, 255, 255, 255, 127);
			imagefilledrectangle($imagem_fin, 0, 0, $larguram+1, $alturam+1, $transparent);

			ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $larguram+1, $alturam+1, $pontoX, $pontoY);
			ImagePNG($imagem_fin, $imagem_gerada,9);
			ImageDestroy($imagem_orig);
			ImageDestroy($imagem_fin);

			$imagem_gerada = $pastaFotos.$nome."p.png";
			$path = $imagem;
			$imagem_orig = ImageCreateFromPNG($path);
			$pontoX = ImagesX($imagem_orig);
			$pontoY = ImagesY($imagem_orig);

			$imagem_fin = ImageCreateTrueColor($largurap, $alturap);

			imagealphablending($imagem_fin, false);
			imagesavealpha($imagem_fin,true);
			$transparent = imagecolorallocatealpha($imagem_fin, 255, 255, 255, 127);
			imagefilledrectangle($imagem_fin, 0, 0, $largurap+1, $alturap+1, $transparent);

			ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largurap+1, $alturap+1, $pontoX, $pontoY);
			ImagePNG($imagem_fin, $imagem_gerada,9);
			ImageDestroy($imagem_orig);
			ImageDestroy($imagem_fin);


		} else {

			$imagem_gerada = $pastaFotos.$nome."g.jpg";
			$path = $imagem;
			$imagem_orig = ImageCreateFromJPEG($path);
			$pontoX = ImagesX($imagem_orig);
			$pontoY = ImagesY($imagem_orig);
			$imagem_fin = ImageCreateTrueColor($largura, $altura);
			ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY);
			ImageJPEG($imagem_fin, $imagem_gerada,80);
			ImageDestroy($imagem_orig);
			ImageDestroy($imagem_fin); 

			$imagem_gerada = $pastaFotos.$nome."m.jpg";
			$path = $imagem;
			$imagem_orig = ImageCreateFromJPEG($path);
			$pontoX = ImagesX($imagem_orig);
			$pontoY = ImagesY($imagem_orig);
			$imagem_fin = ImageCreateTrueColor($larguram, $alturam);
			ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $larguram+1, $alturam+1, $pontoX, $pontoY);
			ImageJPEG($imagem_fin, $imagem_gerada,80);
			ImageDestroy($imagem_orig);
			ImageDestroy($imagem_fin);

			$imagem_gerada = $pastaFotos.$nome."p.jpg";
			$path = $imagem;
			$imagem_orig = ImageCreateFromJPEG($path);
			$pontoX = ImagesX($imagem_orig);
			$pontoY = ImagesY($imagem_orig);
			$imagem_fin = ImageCreateTrueColor($largurap, $alturap);
			ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largurap+1, $alturap+1, $pontoX, $pontoY);
			ImageJPEG($imagem_fin, $imagem_gerada,80);
			ImageDestroy($imagem_orig);
			ImageDestroy($imagem_fin);
		}
	
		//apagar a imagem antiga
		unlink ($imagem);
	}