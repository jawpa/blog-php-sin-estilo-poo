<?php 

 class ObjetoBlog 
 {

 	// propiedades
 	private $id;
 	private $titulo;
 	private $comentario;
 	private $fecha;
 	private $imagen;

 	// function __construct()
 	// {
 		
 	// }

   
    // métodos de acceso a las propiedades
    public function getId()
     {
       // el this hace referencia al objeto dónde nos encontramos, la id de la entrada del blog
       return $this->id;
     }

    public function getTitulo()
     {
       return $this->titulo;
     }
     
    public function getComentario()
     {
       return $this->comentario;
     }
     
    public function getFecha()
     {
       return $this->fecha;
     }

    public function getImagen()
     {
       return $this->imagen;
     }

    public function setId($id)
          {
          	$this->id = $id;
          }  

    public function setTitulo($titulo)
          {
          	$this->titulo = $titulo;
          }  
          
    public function setComentario($comentario)
          {
          	$this->comentario = $comentario;
          }  
          
    public function setFecha($fecha)
          {
          	$this->fecha = $fecha;
          }  
          
    public function setImagen($imagen)
          {
          	$this->imagen = $imagen;
          }                              
 }


 ?>