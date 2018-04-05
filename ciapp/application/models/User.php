<?php

class User extends CI_Model {

    public $id;
    public $name;
    public $username;
    public $password;

    public function authenticate($user, $password)
    {
        $query = $this->db->query(
            'SELECT id, name FROM users WHERE username="'.$user.'"'
           .' AND password ="'.md5($password).'" LIMIT 0,1'
        );
        $result = $query->result_array();
        if(isset($result[0])) {
            return $result[0];
        }
        return null;
    }

    public function exists($id)
    {
        $query = $this->db->query(
            'SELECT name FROM users WHERE id='.$id.' LIMIT 0,1'
        );
        $result = $query->result_array();
        if(isset($result[0])) {
            return true;
        }
        return false;
    }

}