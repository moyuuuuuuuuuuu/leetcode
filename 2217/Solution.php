<?php

class Solution
{
    /**
     * @param Integer[] $queries
     * @param Integer $intLength
     * @return Integer[]
     */
    function kthPalindrome($queries, $intLength)
    {
        $max = $queries[count($queries) - 1];
        $res = $this->createPalindrome($intLength, $max);
        $ans = [];
        foreach ($queries as $query) {
            $ans[] = $res[$query - 1];
        }
        return $ans;
    }

    /**
     * 生成指定个数的指定位数的回文数
     * @param $n
     * @param $max
     * @return array
     */
    function createPalindrome($n, $max)
    {
        $weight = [1];
        //数组右侧填充0
        for ($i = 1; $i < $n; $i++) {
            $weight[$i] = 0;
        }
        $res    = [];
        $i      = 1;
        $weight = implode('', $weight);
        for (intval($weight); $weight < PHP_INT_MAX; $weight++) {
            if (count($res) >= $max) break;
            if ($this->isPalindrome($weight)) {
                $res[] = $weight;
            }
        }
        return $res;
    }

    /**
     * 判断是否是回文数
     * @param $x
     * @return bool
     */
    function isPalindrome($x)
    {
        if ($x < 0) return false;
        //php 反转文字
        $rev = strrev($x);
        return $x == $rev;
    }
}

$res = (new Solution())->kthPalindrome([1,2,3,4,5,90], 3);
var_dump($res);
