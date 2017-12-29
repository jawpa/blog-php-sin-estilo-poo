<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php 

    include_once '../modelo/ManejoObjetos.php';

    try {

        $conexion = new PDO('mysql:host=localhost; dbname=blog','root','1234');

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // instanciamos un objeto de esta clase
        $manejo_Objetos = new ManejoObjetos($conexion);

        // llamamos al objeto que necesitamos
        // nos devuelve el array con objetos blog
        $tabla = $manejo_Objetos->getContenidoPorFecha();

        if (empty($tabla)) {
            
            echo "noo hay entradas del blog aún";
        
        }else{


            foreach ($tabla as $entrada) {
                
                echo "<h3>" . $entrada->getTitulo() . "</h3>";;
                echo "<h4>" . $entrada->getFecha() . "</h4>";
                echo "<div style='width:400px'>" . $entrada->getComentario() . "</div><br><br>";
                if ($entrada->getImagen() != "") {

                        // leemos la fuente de la imagen en la carpeta dónde la trasladamos desde la carpeta temporals
                        echo "<img src='../imagenes/" . $entrada->getImagen() . "' width='300px' heigth='200px'  />";
                }

                echo "<hr>";

            }

        }



    }catch (Exception $e) {

        die("Error: " . $e->getMessage());
    
    } 
 ?>

    <a href="formulario.php">Añadir Nueva Entrada</a><br><br>
    


</body>
</html>
