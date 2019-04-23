<?php
class Formulario
{

    protected $nombre;
    protected $edad;
    protected $sexo;
    protected $estudios;

    private $opciones;

    function __construct(string $nombre, $edad, string $sexo, int $estudios)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->estudios = $estudios;
        $this->opciones = ['Primario', 'Secundario', 'Terciario', 'Universitario'];
    }

    function getNombre(): string
    {
        return $this->nombre;
    }

    function getEdad()
    {
        return $this->edad;
    }

    function getSexo(): string
    {
        return $this->sexo;
    }

    function setNombre($val)
    {
        $this->nombre = $val;
    }

    function setEdad($val)
    {
        $this->edad = $val;
    }
    function setSexo($val)
    {
        $this->sexo = $val;
    }
    function setEstudios($val)
    {
        $this->nombre = $val;
    }


    function getEstudios()
    {
        // $nro = $this->estudios;
        // return $opciones[$nro];
        switch ($this->estudios) {
            case 1:
                return $this->opciones[0];
                break;
            case 2:
                return $this->opciones[1];
                break;
            case 3:
                return $this->opciones[2];
                break;
            case 4:
                return $this->opciones[3];
                break;
            default:
                break;
        }
    }

    function  esValido():bool
    {
        if($this->validarNombre()&&$this->validarEdad()&&$this->validarSexo()){
            echo "el formulario es valido";
            return true;
        }else{
            return false;
        }
     }

    function validarNombre(): bool
    {
        if (strlen($this->nombre) > 3) {
            return true;
        }else{
            echo "el nombre debe tener mas de 3 caracteres";
            return false;
        }
    }

    function validarEdad(): bool
    { 
        if($this->edad!="" && is_int($this->edad)){
            return true;
        }else{
            echo "la edad debe ser un numero entero y no estar vacio";
            return false;
        }
    }

    function validarSexo():bool
    { 
        if($this->sexo!=""){
            return true;
        }else{
            echo "el campo sexo debe estar cargado";
            return false;
        }
    }
}

//$f = new Formulario("pachi",37,"masculino",3);
//echo "su nombre es ".$f->getNombre()." \n";
//echo "su edad es ". $f->getEdad()." \n";
//echo "su sexo es ".$f->getSexo()." \n";
//echo "sus estudios son ". $f->getEstudios() . " \n";
//$f->esValido();


 $datos = $_POST;

 $nombre = $datos['nombre'];
 $edad = $datos['edad'];
 $sexo = $datos['sexo'];
 $estudios = $datos['estudios'];
 $f = new Formulario($nombre,$edad,$sexo,$estudios);
// echo "su nombre es ".$f->getNombre()." <br>";
// echo "su edad es ". $f->getEdad()." <br>";
// echo "su sexo es ".$f->getSexo()." <br>";
// echo "sus estudios son ". $f->getEstudios() . " <br>";

// echo "hola mundo";

 $conn = new mysqli('localhost', 'root', 'jupit3r', 'tp1');

 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     echo "error de conexion a la base";
 }

 $sql = "insert into formulario(nombre,edad,sexo,estudios) values('$nombre','$edad','$sexo','$estudios')";

 if ($conn->query($sql) === true) {
     echo "sus datos fueron guardados";
 }
 