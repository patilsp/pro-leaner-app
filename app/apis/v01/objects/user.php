<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
     
    // create new user record
    function create(){

        if(empty($this->firstname) || 
        empty($this->lastname) ||
        empty($this->email) ||
        empty($this->firstname) ||
        empty($this->password)) {
            return false;
        }
     
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    firstname = :firstname,
                    lastname = :lastname,
                    email = :email,
                    password = :password";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
     
        // bind the values
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
     
        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
         
    // check if given email exist in the database
    function emailExists(){
     
        // query to check if email exists
        $query = "SELECT id, first_name as firstname, last_name as lastname, password
                FROM " . $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";
     
        // prepare the query
        $stmt = $this->conn->prepare( $query );
     
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
     
        // bind given email value
        $stmt->bindParam(1, $this->email);
     
        // execute the query
        $stmt->execute();
     
        // get number of rows
        $num = $stmt->rowCount();
     
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
     
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
            // assign values to object properties
            $this->id = $row['id'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->password = $row['password'];
     
            // return true because email exists in the database
            return true;
        }
     
        // return false if email does not exist in the database
        return false;
    }
    
    public function getUserDetails(){
        $query = "SELECT id, first_name as firstname, last_name as lastname, password,class,username
                FROM users
                WHERE email = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare( $query );
     
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
     
        // bind given email value
        $stmt->bindParam(1, $this->email);
     
        // execute the query
        $stmt->execute();
     
        // get number of rows
        $num = $stmt->rowCount();
        $data = [];
        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $data["id"] = $row["id"];
            $data["id"] = $row["id"];
            $data["Class"] = $row["class"];
            $data["firstname"] = $row["firstname"];
            $data["username"] = $row["username"];
            $q = "SELECT module FROM cpmodules WHERE id = '".$row["class"]."'";
            $stmt1 = $this->conn->prepare( $q );
            $stmt1->execute();
            $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
            $num1 = $stmt1->rowCount();
            $data["displayClassName"] = '';
            if ($num1 > 0) {
                $data["displayClassName"] = $row1["module"];
            }
            
        }
        return $data;
    } 
    // update a user record
    public function update(){
     
        // if password needs to be updated
        $password_set=!empty($this->password) ? ", password = :password" : "";
     
        // if no posted password, do not update the password
        $query = "UPDATE " . $this->table_name . "
                SET
                    first_name = :firstname,
                    last_name = :lastname,
                    email = :email
                    {$password_set}
                WHERE id = :id";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->email=htmlspecialchars(strip_tags($this->email));
     
        // bind the values from the form
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
     
        // hash the password before saving to database
        if(!empty($this->password)){
            $this->password=htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
        }
     
        // unique ID of record to be edited
        $stmt->bindParam(':id', $this->id);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}