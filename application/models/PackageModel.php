<?php
/**
 * Created by PhpStorm.
 * User: Manuela Duque M
 * Date: 19/04/2017
 * Time: 2:32 PM
 */

class PackageModel extends CI_Model{

    public function getPlacePackages($id){

        $query = $this->db->select('place_packages.id, place_packages.price, place_packages.discount
            ,place_packages.package_id, package.name, package.img_url')->from('place_packages')->join('package'
            , 'package.id = place_packages.id')->where('place_packages.place_id', $id)->where('package.is_active', 1)->get();

        return $query->result_array();

    }

    public function getPackageContent($placePackageId){

        $query = $this->db->select('package_items.id, item.name, place_items.price, package_items.quantity
            , (place_items.price * package_items.quantity) AS total')->from('package_items')->join('place_items'
            , 'place_items.id = package_items.place_items_id')->join('item'
            , 'item.id = place_items_id')->where('package_items.place_packages_id', $placePackageId)->get();
        
        return $query->result_array();

    }

}