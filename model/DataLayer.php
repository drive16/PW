<?php
class DataLayer
{
    public function db_connect()
    {
        $USERNAME = "guido";
        $PASSWORD = "garolla";
        $HOST = "localhost";
        $DB_NAME = "DevicesDB";
        
        $connection = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB_NAME) 
                or die('Errore nella connessione al database: ' . mysqli_error());
        
        // Se $DB_NAME non viene specificato in mysqli_connect...
        // mysqli_select_db($connection, $DB_NAME);
        
        return $connection;
    }
    
    public function listRouters()
    {
        $connection = $this->db_connect();
        
        $sql = "SELECT * FROM routerTable ORDER BY name";
        
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
        
        $routers = array();
        while($riga = mysqli_fetch_array($risposta))
        {
            $routers[] = new Router($riga['name'], $riga['model'], $riga['type'], $riga['firmware'], $riga['ports'], $riga['serialNumber']);
        }
        return $routers;
    }
    
    public function listSwitches()
    {
        $connection = $this->db_connect();
        
        $sql = "SELECT * FROM switchesTable ORDER BY name";
        
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
        
        $switches = array();
        while($riga = mysqli_fetch_array($risposta))
        {
            $switches[] = new Router($riga['name'], $riga['model'], $riga['type'], $riga['firmware'], $riga['ports'], $riga['serialNumber']);
        }
        return $switches;
    }

    
    public function findRouterBySerial($serial)
    {
        $connection = $this->db_connect();
        $sql = "SELECT * FROM routerTable where serialNumber='".$serial."'";
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        mysqli_close($connection);
        
        $riga = mysqli_fetch_array($risposta);
        
        return new Router($riga['name'], $riga['model'], $riga['type'], $riga['firmware'], $riga['ports'], $riga['serialNumber']);
    }

    public function findSwitchBySerial($serial)
    {
        $connection = $this->db_connect();
        $sql = "SELECT * FROM switchesTable where serialNumber='".$serial."'";
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        mysqli_close($connection);
        
        $riga = mysqli_fetch_array($risposta);
        
        return new Switches($riga['name'], $riga['model'], $riga['type'], $riga['firmware'], $riga['ports'], $riga['serialNumber']);
    }
    
    public function editRouter($name, $model, $firmware, $ports, $serialNumber)
    {
        $connection = $this->db_connect();
        $sql = "UPDATE routerTable SET name='".$name."', model='".$model."', type='"."Router"."', firmware='".$firmware."', ports='".$ports."' WHERE serialNumber='".$serialNumber."'";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function editSwitch($name, $model, $firmware, $ports, $serialNumber)
    {
        $connection = $this->db_connect();
        $sql = "UPDATE switchesTable SET name='".$name."', model='".$model."', firmware='".$firmware."', ports='".$ports."' WHERE serialNumber='".$serialNumber."'";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function addRouter($name, $model, $firmware, $ports, $serialNumber)
    {
        $connection = $this->db_connect();
        $sql = "INSERT INTO routerTable (name,model,type,firmware,ports,serialNumber) VALUES ('".$name."','".$model."','"."Router"."','".$firmware."','".$ports."','".$serialNumber."')";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function addSwitch($name, $model, $firmware, $ports, $serialNumber, $type = Switches)
    {
        $connection = $this->db_connect();
        $sql = "INSERT INTO switchesTable (name,model,type,firmware,ports,serialNumber) VALUES ('".$name."','".$model."','".$type."','".$firmware."','".$ports."','".$serialNumber."')";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function deleteAuthor($id) 
    {
        $connection = $this->db_connect();
        $sql = "DELETE FROM author where id='".$id."'";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function editAuthor($id,$first_name,$last_name)
    {
        $connection = $this->db_connect();
        $sql = "UPDATE author SET firstname='".$first_name."', lastname='".$last_name."' WHERE id=".$id;
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function addAuthor($first_name,$last_name)
    {
        $connection = $this->db_connect();
        $sql = "INSERT INTO author (firstname,lastname) VALUES ('".$first_name."','".$last_name."')";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function findBookById($id)
    {
        $connection = $this->db_connect();
        $sql = "SELECT * FROM book where id='".$id."'";
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        mysqli_close($connection);
        
        $riga = mysqli_fetch_array($risposta);
        
        $author = $this->findAuthorById($riga['author_id']);
        
        return new Book($riga['id'], $riga['title'], $author->getLastName(), $riga['author_id']);
    }
    
    public function deleteBook($id) 
    {
        $connection = $this->db_connect();
        $sql = "DELETE FROM book where id='".$id."'";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function editBook($id,$title,$author_id)
    {
        $connection = $this->db_connect();
        $sql = "UPDATE book SET title='".$title."', author_id='".$author_id."' WHERE id=".$id;
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function addBook($title,$author_id)
    {
        $connection = $this->db_connect();
        $sql = "INSERT INTO book (title,author_id) VALUES ('".$title."','".$author_id."')";
        mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
    }
    
    public function findBooksByAuthorID($author_id)
    {
        $connection = $this->db_connect();
        $sql = "SELECT * FROM book where author_id='".$author_id."'";
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        if(mysqli_affected_rows($connection)!=0)
        {
            mysqli_close($connection);
            return true;
        }
        else
        {
            mysqli_close($connection);
            return false;
        }
    }
}  
?>

