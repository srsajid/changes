<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/3/2015
 * Time: 11:51 PM
 */

class NotificationController extends BaseController {

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get('searchText') ?: "this";
        $queryMonth = date('n');
        $queryYear = date('Y') - 1;
        $query = "t.m = ? AND t.y = ?";
        if($searchText == "next") {
            $queryMonth = $queryMonth + 1;
        } elseif ($searchText == 'pending') {
            $query = "(t.m < ? AND t.y = ?) OR t.y < $queryYear";
        }
        $beneficiaries = DB::select("select * from (select name, type, designation, join_date, MONTH(last_increment_date) as m, YEAR(last_increment_date) as y FROM beneficiaries) as t where $query  LIMIT ?,?", array($queryMonth, $queryYear, $offset, $max));
        $total = DB::select("select count(*) as total from (select MONTH(last_increment_date) as m, YEAR(last_increment_date) as y FROM beneficiaries) as t where $query", array($queryMonth, $queryYear))[0]->total;
        return View::make("notification.tableView", array(
            'beneficiaries' => $beneficiaries,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }
} 