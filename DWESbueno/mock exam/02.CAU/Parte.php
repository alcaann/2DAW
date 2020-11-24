<?php


class Parte
{
    private $codigo;     // user id
    private $fields;  // other record fields

    // initialize a User object
    public function __construct()
    {
        $this->codigo = null;
        $this->fields = array(	'usuario_id' => '',
								'servicio_id' => '',
								'averia' => '',
								'telefono' => '',
								'fecha' => '');
    }

    // override magic method to retrieve properties
    public function &__get($field)
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
        return pcau_match('/^[A-Z0-9]{2,20}$/i', $usuario);
    }
    
    
    
    // return an object populated based on the record's user id
    public static function getByCodigo($codigo)
    {
        $u = new Usuario();

		$conexion = new Database();
		$sql = sprintf( "SELECT * FROM cau_partes where codigo = %d", $codigo );
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
	
	
	
	// return an object populated based on the record's user id
    public static function getAll()
    {
        $v = array();
		$conexion = new Database();
        $sql = 'SELECT * FROM cau_partes';
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
            $sql = 'UPDATE CAU_PARTES SET USUARIO_ID = ? SERVICIO_ID = ? TELEFONO = ? FECHA = ? AVERIA = ? WHERE PARTE_ID = ?';
            $query = $conexion->prepare( $sql );
			$query->bindParam( 1, $this->usuario_id );
			$query->bindParam( 2, $this->servicio_id );
			$query->bindParam( 3, $this->telefono );
			$query->bindParam( 4, $this->fecha );
			$query->bindParam( 5, $this->averia );
			$query->bindParam( 6, $this->codigo );
			
			$query->execute( );
        }
        else
        {
			
			$sql = 'INSERT INTO CAU_PARTES (USUARIO_ID,SERVICIO_ID, TELEFONO, FECHA, AVERIA ) VALUES ( ?,?,?,?,?)';
            
			$query = $conexion->prepare( $sql );
			$a = $this->usuario_id ;
			$query->bindParam( 1, $this->usuario_id );
			$query->bindParam( 2, $this->servicio_id );
			$query->bindParam( 3, $this->telefono );
			$query->bindParam( 4, $this->fecha );
			$query->bindParam( 5, $this->averia );
			
			$query->execute( );
            //$this->parte_id = $query->lastInsertId();
        }
    }
	
	// save the record to the database
    public function delete()
    {
        $conexion = new Database();
		
		if ($this->codigo)
        {
            $sql = sprintf('DELETE FROM cau_partes WHERE codigo = %d',
                     $this->codigo);
            $conexion->exec( $sql );
        }
    }

}


?>
