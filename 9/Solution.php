<?php

$case = 121;
$case1 = -121;
$case2 = 10;
class Solution {

    /**
     * @param Integer $x
     * @return Boolean
     */
    function isPalindrome($x) {
        if($x < 0) return false;
        //php 反转文字
        $rev = strrev($x);
        return $x == $rev;
    }
}

$res = ( new Solution() )->isPalindrome($case);
var_dump($res);
