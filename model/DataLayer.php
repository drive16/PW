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
    
    public function listDevices()
    {
        $connection = $this->db_connect();
        
        $sql = "SELECT * FROM devices ORDER BY model";
        
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
        
        $devices = array();
        while($riga = mysqli_fetch_array($risposta))
        {
            $author = $this->findAuthorById($riga['author_id']);
            $books[] = new Book($riga['id'], $riga['title'], $author->getLastName(), $riga['author_id']);
        }
        return $devices;
    }
    
    public function listAuthors()
    {
        $connection = $this->db_connect();
        
        $sql = "SELECT * FROM author ORDER BY lastname,firstname";
        
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        
        mysqli_close($connection);
        
        $authors = array();
        while($riga = mysqli_fetch_array($risposta))
        {
            $authors[] = new Author($riga['id'], $riga['firstname'], $riga['lastname']);
        }
        return $authors;
    }
    
    public function findAuthorById($id)
    {
        $connection = $this->db_connect();
        $sql = "SELECT * FROM author where id='".$id."'";
        $risposta = mysqli_query($connection, $sql) or die('Errore nella query: ' . $sql . '\n' . mysqli_error());
        mysqli_close($connection);
        
        $riga = mysqli_fetch_array($risposta);
        
        return new Author($riga['id'], $riga['firstname'], $riga['lastname']);
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

