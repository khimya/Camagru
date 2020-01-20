<?php
class User{
    private $db;

    public function  __construct(){
        $this->db = new Database;
    }

    // register user
    public function register($data){
        $this->db->query('INSERT INTO users (display_name, email, password) VALUES(:display_name, :email, :password)');

        //binding login values

        $this->db->bind(':display_name', $data['display_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);


        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // login user
    public function login($display_name, $password){
        $this->db->query('SELECT * FROM users WHERE display_name = :display_name');
        $this->db->bind(':display_name', $display_name);
  
        $row = $this->db->single();
  
        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
          return $row;
        } else {
          return false;
        }
      }
    //find user by email
    
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        
        ///bind values
        $this->db->bind(':email', $email);
        // var_dump();
        
        
        $row = $this->db->single();
        
        //check rows
        
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function findUserByDisplayName($display_name){
        $this->db->query('SELECT * FROM users WHERE display_name = :display_name');
        
        ///bind values
        $this->db->bind(':display_name', $display_name);
        // var_dump();
        
        
        $row = $this->db->single();
        
        //check rows
        
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    //find user by id
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');

        ///bind values
        $this->db->bind(':id', $id);
        // var_dump();

        $row = $this->db->single();

        return $row;
    }
    
}
