<?php
/**
 * Created by PhpStorm.
 * User: Manuela Duque M
 * Date: 19/04/2017
 * Time: 3:37 PM
 */

class EventModel extends CI_Model{

    public function findAll(){
        
        $response = new stdClass();
        
        $this->db->where('is_active', 1);
        $query = $this->db->get('event');
        $data = $query->result_array();

        $response->events = $data;

        return $response;

    }

    public function getTickets($eventId){
        $response = new stdClass();
        $query = $this->db->where('event_id', $eventId)->where('is_available', 1)->get('ticket');
        $response->tickets = $query->result_array();
        return $response;
    }

    public function findPlaceEvents($id){
        
        $response = new stdClass();

        $query = $this->db->where('is_active', 1)->where('place_id', $id)->get('event');
        $response->events = $query->result_array();;
        
        return $response;

    }

}