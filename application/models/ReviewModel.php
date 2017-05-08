<?php
/**
 * Created by PhpStorm.
 * User: Manuela Duque M
 * Date: 19/04/2017
 * Time: 3:09 PM
 */

class ReviewModel extends CI_Model {

    public function findPlaceReviews($id){
        $query = $this->db->from('review')->where('place_id', $id)->get();
        return $query->result_array();
    }

    private function getCurrentDate(){
        $statement = "SELECT NOW() as date";
        $query = $this->db->query($statement);
        foreach ($query->result() as $row){
            return $row->date;
        }
    }

    public function createReview($review){

        if (isset($review->place_id) && isset($review->rating) && isset($review->content) && isset($review->username)){
            try {
                $params = array(
                    'place_id' => $review->place_id,
                    'rating' => $review->rating,
                    'content' => $review->content,
                    'username' => $review->username,
                    'created' => $this->getCurrentDate()
                );

                return $this->db->insert('review', $params);

            } catch (Exception $e){
                return false;
            }
        }

        return false;

    }

}