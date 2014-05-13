<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta charset="utf-8">
<title>docVox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
    <link rel="stylesheet" src="style.css"/>
    
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
</head>
<body>
    <div data-role="page">
 		
        <div data-role="header" data-position="fixed">
        <a href="#nav-panel" data-role="button" data-icon="bars">Menu</a>
		<a href="index.php" data-role="button" data-icon="home">Inicio</a>
            <h1>Leer RSS</h1>
        </div><!-- /header -->

        <div data-role="content">
        
        	<strong>
        		<?php
				$user = $_SESSION['user'];
        		echo "Puerta y Orden: $pta - $ord. Servicio: $servicio. Usuario: ".$user."."?>
        	</strong>
        
		    <!--el enctype debe soportar subida de archivos con multipart/form-data-->
		    <form enctype="multipart/form-data" class="formulario">
		        <label>Subir un archivo</label><br />
		        <input name="archivo" type="file" id="imagen" /><br /><br />
		        <input type="button" value="Subir imagen" /><br />
		    </form>
		    <!--div para visualizar mensajes-->
		    <div class="messages"></div><br/><br/>
		    <!--div para visualizar en el caso de imagen-->
		    <div class="showImage"></div>
			
			<a data-rel="back" data-role="button" data-icon="star" data-theme="b">Volver</a>
			<?php

			$url = "http://neuquenalinstante.com.ar/category/actualidad/feed/";
			$articulos = simplexml_load_string(file_get_contents($url));
			$num_noticia=1;
			$max_noticias=10;
			foreach($articulos->channel->item as $noticia){ ?>
			    <article>
			        <h1><a href="<? echo $noticia->link; ?>"><? echo $noticia->title; ?></a></h1>
			        <? echo $noticia->description; ?>
			    </article>
			    <? $num_noticia++;
			    if($num_noticia > $max_noticias){
			        break;
			    }
			}?>
        </div><!-- /content -->
		
        <div data-role="footer">
            <h4>Pie</h4>
        </div><!-- /footer -->
 		
 		<div data-role="panel" data-display="push" data-theme="b" id="nav-panel">
			<ul data-role="listview">
	            <li data-icon="delete"><a href="#" data-rel="close">Cerrar menu</a></li>
	                <li><a href="index.php">Inicio</a></li>
	                <li><a href="manual.php">Manual</a></li>
			</ul>
		</div><!-- /panel -->

<?php 
/*function lectorRSS($url,$elementos=6,$inicio=0) {
	    $cache_version = "cache/" . basename($url);
	    $archivo = fopen($url, 'r');
	    stream_set_blocking($archivo,true);
	    stream_set_timeout($archivo, 5);
	    $datos = stream_get_contents($archivo);
	    $status = stream_get_meta_data($archivo);
	    fclose($archivo);
	    if ($status['timed_out']) {
		  $noticias = simplexml_load_file($cache_version);
	    }
	    else {
		  $archivo_cache = fopen($cache_version, 'w');
		  fwrite($archivo_cache, $datos);
		  fclose($archivo_cache);
		  $noticias = simplexml_load_string($datos);
	    }
	$ContadorNoticias=1;
  	echo "<ul>";
	foreach ($noticias->channel->item as $noticia) {
	if($ContadorNoticias<$elementos){
		if($ContadorNoticias>$inicio){
			echo "<li><a href='".$noticia->link."' target='_blank' class='tooltip' title='".utf8_decode($noticia->title)."'>";
			echo utf8_decode($noticia->title);
			echo "</a></li>";
		}
		$ContadorNoticias = $ContadorNoticias + 1;
 	}
	}
	echo "</ul>";
}*/

//lectorRSS($url);

//lectorRSS('http://feeds.feedburner.com/webintenta/WVpB',5);
?>
</div>
</body></html>