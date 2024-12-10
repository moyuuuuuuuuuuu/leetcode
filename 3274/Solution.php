<?php

class Solution
{
    /**
     * @param String $coordinate1
     * @param String $coordinate2
     * @return Boolean
     */
    function checkTwoChessboards($coordinate1, $coordinate2)
    {
        $a       = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 6, 'g' => 7, 'h' => 8,];
        $letter1 = $coordinate1[0];
        $letter2 = $coordinate2[0];
        $letter1 = $a[$letter1];
        $letter2 = $a[$letter2];
        $num1    = $coordinate1[1];
        $num2    = $coordinate2[1];
        //判断num1和letter1是否偶数
        return (($letter1 + $num1) % 2 == 0 && ($letter2 + $num2) % 2 == 0 ) || (($letter1 + $num1) % 2 != 0 && ($letter2 + $num2) % 2 != 0);

    }
}

$res = (new Solution())->checkTwoChessboards('c2', 'g4');
var_dump(ord('a'),ord('1'));
