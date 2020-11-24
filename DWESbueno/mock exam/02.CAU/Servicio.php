<?php


class Servicio
{
    private $codigo;     // user id
    private $fields;  // other record fields

    // initialize a User object
    public function __construct()
    {
        $this->codigo = null;
        $this->fields = array('servicio' => '');
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

   
    
    
    // return an object populated based on the record's user id
    public static function getByCodigo($codigo)
    {
        $u = new servicio();
		
		$conexion = new Database();
		$sql =  "SELECT * FROM cau_servicios where SERVICIO_ID = ?";
		$query = $conexion->prepare( $sql );
		$query->bindParam( 1, $codigo );
		$query->execute();
		
		if( $row = $query->fetch() )
		{
			$u = new servicio();
			$u->servicio = $row['SERVICIO'];
            $u->codigo = $codigo;
			return $u;
		}	
		else
		{
			return null;
		}
	}
	
	public static function checkservicio( $servicio, $password )
    {
		
		$conexion = new Database();
		$sql = sprintf( "SELECT * FROM cau_servicios where servicio = %d", $servicio );
		$rows = $conexion->query( $sql );
		
		
		if( $rows->rowCount()  == 0  )
			$resultado = false;
		else
		{
			$row = $rows->fetch();
			if( $row['password'] == $password )
				$resultado = true;
			
            else
				$resultado = false;
			
		}
		
		return $resultado;
		
	}
	
	// return an object populated based on the record's user id
    public static function getAll()
    {
        $v = array();
		$conexion = new Database();
        $sql = 'SELECT * FROM cau_servicios order by servicio';
        $rows = $conexion->query( $sql );
		

        foreach( $rows as $row )
		{
			$u = new servicio();
			$u->codigo = $row['SERVICIO_ID'];
            $u->password = $row['SERVICIO'];
         	$v[$row['SERVICIO_ID'] ] = $row['SERVICIO'];
		}

        return $v;
    }
	
	
    
    // save the record to the database
    public function save()
    {
		$conexion = new Database();
		
        if ($this->codigo)
        {
            $query = sprintf('UPDATE cau_servicios SET servicio = "%s" WHERE codigo = %d',
                $this->servicio,
                $this->password,
                $this->codigo);
            $rows = $conexion->exec( $query );
        }
        else
        {
            $query = sprintf('INSERT INTO cau_servicios ( servicio ) VALUES ("%s")',
                $this->servicio,
                $this->password );
			$rows = $conexion->exec( $query );

            $this->codigo = $conexion->lastInsertId();
        }
    }
	
	// save the record to the database
    public function delete()
    {
        $conexion = new Database();
		
		if ($this->codigo)
        {
            $sql = sprintf('DELETE FROM cau_servicios WHERE codigo = %d',
                     $this->codigo);
            $conexion->exec( $sql );
        }
    }

}


?>
