<?php
/**
 * Created by PhpStorm.
 * User: Manuela Duque M
 * Date: 24/04/2017
 * Time: 12:09 PM
 */

class UserModel extends CI_Model{

    public function updatePhone($phone, $mail){
        $params = array(
            'mail' => $mail,
            'phone' => $phone
        );
        return $this->db->where('mail', $mail)->update('user', $params);
    }

    public function getCode($mail){
        $query = $this->db->select('id')->where('mail', $mail)->get('user');
        return $query->row_array();
    }
    
    public function userProfileInfo($mail){

        $response = new stdClass();

        $query = $this->db->select('id, phone')->from('user')->where('mail', $mail)->get();
        $result = (object) $query->row_array();

        $response->user = $result;

        $id = $result->id;

        $query = $this->db->select('COUNT(*) AS order_count')->from('package_order')->where('user_id', $id)->get();
        $result = (object) $query->row_array();

        $response->package_order_count = $result->order_count;

        $query = $this->db->select('COUNT(*) AS order_count')->from('item_order')->where('user_id', $id)->get();
        $result = (object) $query->row_array();

        $response->item_order_count = $result->order_count;

        return $response;

    }

}