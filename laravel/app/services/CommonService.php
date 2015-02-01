<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/19/14
 * Time: 9:12 PM
 */

class CommonService {
    public static function itemPerPage($max) {
        $html = "<select class='item-per-page'>".PHP_EOL;
        $array = array(
            '10' => '10',
            '20' => '20',
            '25' => '25',
            '50' => '50',
            '100' => '100',
            '200' => '200'
        );
        foreach($array as $key => $value) {
            $class = intval($value) == $max ? "selected" : "";
            $html = $html."<option value='$key' $class>$value</option>".PHP_EOL;
        }
        $html = $html."</select>";
        return $html;
    }
    public static function paginator($max, $offset, $total) {
        $html = "<ul class='pagination' max='$max' offset='$offset' total='$total'>".PHP_EOL;
        $currentPage = intval($offset / $max) + 1;
        $noOfPage = ceil($total/$max);
        $class = $currentPage == 1 ? "disabled" : "";
        $html =  $html."<li page='prev' class='$class'><a>&laquo;</a></li>".PHP_EOL;
        $d = $currentPage < 5 ? 10 - $currentPage : 5;
        $n = ($currentPage + $d) > $noOfPage ? $noOfPage : ($currentPage + $d);
        $i = $currentPage - 5 > 0 ? $currentPage - 5 : 1;
        for(; $i <= $n; $i++) {
            $class = $i == $currentPage ? "active" : "";
            $html =  $html."<li page='$i' class='$class' ><a>$i</a></li>".PHP_EOL;
        }
        $class = $currentPage == $noOfPage || $total < $max ?  "disabled" : "";
        $html = $html."<li page='next' class='$class'><a>&raquo;</a></li>".PHP_EOL;
        $html = $html.'</ul>';
        return $html;
    }


} 