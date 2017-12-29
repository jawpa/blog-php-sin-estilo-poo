<?php 
    
include_once '../modelo/ObjetoBlog.php';
include_once '../modelo/ManejoObjetos.php';

// conectamos con la base de datos
try {

		$conexion = new PDO('mysql:host=localhost; dbname=blog','root','1234');

		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // chequeamos que esté todo bien con la imagen y la depositamos en la carpeta indicada
	    // si recibimos la imagen por error o un error en la subida
	    if($_FILES['imagen']['error']){

	        switch ($_FILES['imagen']['error']) {
	        	
	        	// error de tamaño de archivo en php.ini
	        	case '1': 
	        		echo "el tamaño del archivo subido excede el límite del servidor";
	        		break;
	        	
	        	// error de tamaño de archivo marcado en formulario
	            case '2': 
	        		echo "el tamaño del archivo subido se ha excedido el límite del formulario";
	        		break;

	             
	            // 
	        	case '3': 
	        		echo "el envío del archivo se interrumpió";
	        		break;



	        	case '4': 
	        		echo "no se ha enviado archivo alguno";
	        		break;		

	        }

	    }else{

	        echo "entrada subida correctamente";
	       
	        // si recibimos un archivo por formulario y si el error da 0 (UPLOAD_ERR_OK es igual a 0)
	        if (isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error']==UPLOAD_ERR_OK)) {

	        	// movemos la imágenes desde la carpeta temporal del servidor a la carpeta del servidor elegida 
	        	
	        	$destino_de_ruta = "../imagenes/";
	        	move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_de_ruta . $_FILES['imagen']['name']);
	        	echo "imagen depositada en la carpeta imágnes";
	        	
	        }else{

	            echo "El archivo no se ha podido copiar al directorio de imágenes";

	        }

	    }

        
        // creamos un objeto de tipo blog  
        $blog1 = new ObjetoBlog();


        // con la instancia podemos ponerle las propiedades al objeto blog
        // evitamos la inyección sql
        $blog1->setTitulo(htmlentities(addslashes($_POST['titulo']),ENT_QUOTES));

        $blog1->setComentario(htmlentities(addslashes($_POST['comentario']),ENT_QUOTES));
        
        //la fecha no está en el formulario, la establecemos cada que ve realizamos una entrada
        $blog1->setFecha(DATE("Y-m-d H:i:s"));
        
        // accedemos a la imagen guardada en la carpeta correspondiente
        $blog1->setImagen($_FILES['imagen']['name']);
        
        // ya tenemos al objeto, lo tenemos que insertar en la base de datos
        // la función insertaContenido recibe un objeto blog
        // creamos un objeto perteneciente a la clase manejoObjetos
        $manejo_objetos = new ManejoObjetos($conexion);
        $manejo_objetos->insertaContenido($blog1);

        echo "<br>Se ha ingresado una entrada al blog<br>";


	} catch (Exception $e) {
	
        die("Error: " . $e->getMessage());
    }    



 ?>