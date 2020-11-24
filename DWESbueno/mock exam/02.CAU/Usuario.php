<?php


class Usuario
{
    private $codigo;     // user id
    private $fields;  // other record fields

    // initialize a User object
    public function __construct()
    {
        $this->codigo = null;
        $this->fields = array('usuario' => '',
                              'password' => '');
    }

    // override magic method to retrieve properties
    public function __get($field)
    {
        if ($field == 'codigo')
        {
            return $this->codigo;
        }
        else 
        {
            return $this->fields[$field];
        }
    }

    // override magic method to set properties
    public function __set($field, $value)
    {
        if (array_key_exists($field, $this->fields))
        {
            $this->fields[$field] = $value;
        }
    }

    // return if usuario is valid format
    public static function validateUsuario($usuario)
    {
        return pCAU_match('/^[A-Z0-9]{2,20}$/i', $usuario);
    }
    
    
    
    // return an object populated based on the record's user id
    public static function getByCodigo($codigo)
    {
        $u = new Usuario();

		$conexion = new Database();
		$sql = sprintf( "SELECT * FROM CAU_USUARIOS where codigo = %d", $codigo );
		$rows = $conexion->query( $sql );
		
		if( $rows->rowCount()  == 0  )
			return null;
		else
		{
			$u = new Usuario();
			$row = $rows->fetch();
			$u->usuario = $row['usuario'];
            $u->password = $row['password'];
            $u->codigo = $codigo;
			return $u;
		}
	}
	
	public static function checkUsuario( $usuario, $password )
    {
       
		$conexion = new Database();
		$sql =  "SELECT * FROM CAU_USUARIOS where USUARIO = ?";
		$query = $conexion->prepare( $sql );
		$query->bindParam( 1, $usuario );
		$rows = $query->execute();
		
		if( $query->rowCount()  == 0  )
			$resultado = false;
		else
		{
			$row = $query->fetch();
			if( $row['PASSWORD'] == $password )
				$resultado = true;
			
            else
				$resultado = false;
			
		}
		
		return $resultado;
		
	}
	
	public static function getCodigo( $usuario)
    {
       
		$conexion = new Database();
		$sql =  "SELECT * FROM CAU_USUARIOS where USUARIO = ?";
		$query = $conexion->prepare( $sql );
		$query->bindParam( 1, $usuario );
		$rows = $query->execute();
		
		if( $row = $query->fetch() )
			$resultado = $row['USUARIO_ID'];
		else
		{
				$resultado = false;
		}
		
		return $resultado;
		
	}
	
	// return an object populated based on the record's user id
    public static function getAll()
    {
        $v = array();
		$conexion = new Database();
        $sql = sprintf('SELECT * FROM CAU_USUARIOS' );
        $rows = $conexion->query( $sql );
		

        foreach( $rows as $row )
		{
			$u = new Usuario();
			$u->usuario = $row['usuario'];
            $u->password = $row['password'];
            $u->codigo = $row['codigo'];
			$v[] = $u;
		}

        return $v;
    }
	
	
    
    // save the record to the database
    public function save()
    {
		$conexion = new Database();
		
        if ($this->codigo)
        {
            $sql = 'UPDATE CAU_USUARIOS SET usuario = ? password = ? WHERE codigo = ?';
			$conexion->prepare( $sql );
			$conexion->bindParam( 1, $this->usuario );
			$conexion->bindParam( 2, $this->password );
			$conexion->bindParam( 3, $this->codigo );
			$conexion->execute();
        }
        else
        {
            $sql = 'INSERT INTO CAU_USUARIOS ( usuario, password) VALUES (?, ?)';
			$conexion->prepare( $sql );
			$conexion->bindParam( 1, $this->usuario );
			$conexion->bindParam( 2, $this->password );
			$conexion->execute();
			$this->codigo = $conexion->lastInsertId();
        }
    }
	
	// save the record to the database
    public function delete()
    {
        $conexion = new Database();
		
		if ($this->codigo)
        {
            $sql = 'DELETE FROM CAU_USUARIOS WHERE codigo = ?';
			$conexion->prepare( $sql );
			$conexion->bindParam( 1, $this->codigo );
			$conexion->execute();
        }
    }

}
/*
function prueba()
{
	
	
	$p = new Usuario();
	$p->usuario = "antonio";
	$p->password = "lujan";
	$p->save();

	$a = Usuario::getByCodigo( 8 );
	echo "hola";
	echo $a->usuario;
	echo $a->password;
	
	$a->delete();
	
	$v = Usuario::getAll();
	print_r( $v );

}

prueba();
*/

?>
