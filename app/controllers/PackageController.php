<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/30/14
 * Time: 4:08 PM
 */

class PackageController extends BaseController{

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $packages = PackageService::getPackages();
        $total = PackageService::getCounts();
        return View::make("package.tableView", array(
            'packages' => $packages,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }

    public function getCreate() {
        $pack = null;
        if(Input::get("id")) {
            $pack = Package::find(intval(Input::get("id")));
        } else {
            $pack = new Package();
        }
       return View::make("package.create", array('pack' => $pack));
    }

    public function postSave() {
        $id = Input::get("id");
        $name = Input::get("name");
        $items = json_decode(Input::get("items"));
        $quantities = json_decode(Input::get("quantities"));
        $result = null;
        try{
            $result = PackageService::save($id, $name, $items, $quantities);
        } catch(Exception $e) {
            $result = false;
        }
        if($result) {
            return array('status' => 'success', 'message' => 'Package has been saved successfully');
        }
        return array('status' => 'error', 'message' => 'Package save operation has been failed');
    }

}