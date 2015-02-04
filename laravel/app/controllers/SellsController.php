<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 5/31/14
 * Time: 6:43 PM
 */

class SellsController extends BaseController {

    public function loadTable() {
        $max = Input::has("max") ? Input::get("max") : "10";
        $offset = Input::has("offset") ? Input::get("offset") : "0";
        $search_text = Input::has("searchText") ? Input::get("searchText") : "";
        $params = array('max' => $max, 'offset'=> $offset ,'searchText'=> $search_text);
        $sells = SellsService::getSells($params);
        $count = SellsService::getCounts($params);
        return View::make("sells.tableView", array(
            'sells' => $sells,
            'total' => $count,
            'max' => $max,
            'offset' => $offset
        ));
    }

    public function create() {
        $packageList = Package::all();
        $packages = array('' => "None");
        foreach($packageList as $pack) {
            $packages[$pack->id] = $pack->name;
        }
        return View::make("sells.create", array('packages' => $packages));
    }

    public function selection() {
        $packageId = Input::get("package");
        if($packageId) {
            $package = Package::find(intval($packageId));
            return View::make("sells.packSelection", array('pack' => $package));
        }
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $products = ProductService::getProducts();
        $total = ProductService::getCounts();
        return View::make("sells.productsSelection", array(
            'products' => $products,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }

    public function save() {
        $ids = json_decode(Input::get("ids"));
        $quantities = json_decode(Input::get("quantities"));
        $studentId = Input::get("studentId");
        $mobileNo = Input::get("mobileNo");
        $result = null;
        try {
            $result = SellsService::save($studentId, $mobileNo, $ids, $quantities);
        } catch(Exception $e) {
            $result = false;
        }
        if($result) {
            return array('status' => 'success', 'message' => 'Sells has been created successfully');
        }
        return array('status' => 'error', 'message' => 'Sells has been failed');
    }

    public function pdf(){
        $sell = Sell::find(intval(Input::get('id')));
        if(!$sell) {
            return;
        }
//        require_once(base_path()."/vendor/dompdf/dompdf/dompdf_config.inc.php");
        $html = View::make("sells.pdf", array('sell' => $sell));
        return $html;
//        $pdf = new DOMPDF();
//        $pdf->load_html($html);
//        $pdf->render();
//        $pdf->stream("$sell->id-sells.pdf", array('Attachment'=>0));
    }

    public function view() {
        $sell = Sell::find(intval(Input::get('id')));
        if(!$sell) {
            return "Sells not found";
        }
        return View::make("sells.view", array('sell' => $sell));

    }

    public function reportForm() {
        return View::make("sells.generateReport");
    }

    public function report() {
        set_time_limit(360);
        $from = Input::get("from");
        $to = Input::get("to");
        $array = array();
        $query= "";
        $flag = false;
        if($from) {
            array_push($array, new DateTime($from."00:00:00"));
            $query = $query."created_at >= ?";
            $flag = true;
        }
        if($to) {
            array_push($array, new DateTime($to."23:59:59"));
            $query = $query.($flag ? " and " : "");
            $query = $query."created_at <= ?";
        }
        if(strlen($query) <= 0) {
            return "invalid query";
        }
        $sells = Sell::with("items")->whereRaw($query, $array)->get();
//        require_once(base_path()."/vendor/dompdf/dompdf/dompdf_config.inc.php");
        $html =  View::make("sells.report", array('sells' => $sells, 'to' => $to, 'from' => $from));
        return $html;
//        $pdf = new DOMPDF();
//        $pdf->load_html($html);
//        $pdf->render();
//        $pdf->stream("Report.pdf", array('Attachment'=>0));
    }
}