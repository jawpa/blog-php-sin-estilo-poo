<?php 

/**
* Manipula los objetoBlog y la conexión con la base de datos
*/

include_once 'ObjetoBlog.php';

class ManejoObjetos 
{
	// nos conectamos a la base de datos
	private $conexion;
	
	function __construct($conexion)
	{
		$this->setConexion($conexion);
	}

    // usamos la librería pdo
	public function setConexion(PDO $conexion)
	{
		$this->conexion = $conexion;
	}


	// obtenemos las entradas de blog
	// las modificamos las entradas de blog
	public function getContenidoPorFecha()
	{
		// almacenaremos las entradas en array
		$matriz = array();

		$contador = 0;

		$resultado = $this->conexion->query("SELECT * FROM contenido ORDER BY fecha");

		// recorremos el record-set y almacenamos cada registro -que sería cada entrada- en el array
		while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
			
			// creamos una instancia del objeto blog 
			// y lo cargamos de acuerdo el registro 
			$blog = new ObjetoBlog();

			$blog->setId($registro['id']);
			$blog->setTitulo($registro['titulo']);
			$blog->setComentario($registro['comentario']);
			$blog->setFecha($registro['fecha']);
			$blog->setImagen($registro['imagen']);

			// almacenamos el objeto creado en el array
			$matriz[$contador] = $blog;
			$contador++;
		}

		return $matriz;

	}

	public function insertaContenido(ObjetoBlog $blog)
	{
		$sql = "INSERT INTO contenido (titulo,fecha,comentario,imagen) VALUES ('" .$blog->getTitulo(). "', '" .$blog->getFecha(). "', '" .$blog->getComentario(). "','" .$blog->getImagen(). "')";

		$this->conexion->exec($sql);
	}
}

 ?>