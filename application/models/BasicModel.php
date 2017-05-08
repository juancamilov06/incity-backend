<?php
/**
 * Created by PhpStorm.
 * User: Manuela Duque M
 * Date: 19/04/2017
 * Time: 2:32 PM
 */

class BasicModel extends CI_Model{

    public function login($mail, $password){
        $hashed = hash ('sha256', $password);
        $query = $this->db->from('user')->where('email', $mail)->where('password', $hashed)->get();
        return $query->row_array();
    }

    public function signup($user){
        $hashed = hash('sha256', $user->password);
        $data = array(
            'email' => $user->mail,
            'password' => $hashed,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'address' => $user->address,
            'phone' => $user->phone
        );
        return $this->db->insert('user', $data); 
    }
    
}