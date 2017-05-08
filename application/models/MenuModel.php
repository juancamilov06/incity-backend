<?php
/**
 * Created by PhpStorm.
 * User: Manuela Duque M
 * Date: 19/04/2017
 * Time: 3:09 PM
 */

class MenuModel extends CI_Model {

    public function getDiscoMenu($discoId){

        $response = new stdClass();

        $this->db->select('place_items.price, item.id, item.name, item.type_id, place_items.discount');
        $this->db->from('place_items');
        $this->db->join('item', 'place_items.item_id = item.id');
        $this->db->where('place_items.place_id', $discoId);
        $query = $this->db->get();

        $data = $query->result_array();
        
        $response->menu = $data;

        return $response;

    }

}