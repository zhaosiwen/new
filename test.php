<?php 
/**
 * Siwen.zhao
 * 
 * siwen.zhao test
 * 
 * @package New
 * @author siwen.zhao<1559617934@qq.com>
 * @copyright Copyright (c) 2014-2018, siwen.zhao
 * @license http://xxxx.www.com GNU
 * @link http://siwen.com
 * @since v1.0
 */

/**
 *Algorithm 
 *
 *Centralized algorithm
 *
 *@package New
 *@author siwen.zhao<1559617934@qq.com>
 *@link http://xxx.com/test
 */
 class Algorithm
 {
     /**
      * Binary search
      * 
      * Finds the elements specified in the array by binary search algorithm
      * 
      * @param array $array
      * @param int $high
      * @param int $low
      * @param int $key
      * @return mixed
      */
     public static function binarySearch($array, $high, $low, $key)
     {
         $middle = intval(($high + $low) /2);
         if ($key == $array[$middle]) {
             return $middle;
         } elseif ($key > $array[$middle]) {
             $low = $middle + 1;
             return self::binarySearch($array, $high, $low, $key);
         } elseif ($key < $array[$middle]) {
             $high = $middle - 1;
             return self::binarySearch($array, $high, $low, $key);
         } else {
             return false;
         }
     }
 
 /**
  * Order find
  * 
  * Look for elements in array size order
  * 
  * @param array $array
  * @param int $key
  * @return mixed
  */
 public static function orderFind($array, $key)
 {
     $num = count($array);
     for ($i=0; $i < $num; $i++) {
         if ($key == $array[$i]) {
             return $i;
         }
     }
 }
 
 /**
  * Bubbling sort
  * 
  * The array sorted by the bubbing algorithm
  * 
  * @param array $array
  * @return array
  */
 public static function bubbingSort($array)
 {
     $len = count($array);
     for ($i = $len - 1; $i > 0; $i--) {
         for ($j = 0; $j < $i; $j++) {
             $k = $j + 1;
             if ($array[$j] > $array[$k]) {
                 $tem = $array[$k];
                 $array[$k] = $array[$j];
                 $array[$j] = $tem;
             }
         }
     }
         return $array;
 }
 
 /**
  * Quit sort
  * 
  * Sort arrays by quicksort algorithm
  * 
  * @param array $array
  * @return array
  */
 public static function quickSort($array)
 {
     $len = count($array);
     if ($len ==0 || $len == 1) return $array;
     $key = $array[0];
     $low = $high = array();
     for ($i = 0; $i < $len; $i++) {
         if ($array[$i] > $key) {
             $high[] = $array[$i];
         } elseif ($array[$i] < $key){
             $low[] = $array[$i];
         } else {
             $middel[] = $key;
         }
     }
     return array_merge(self::quickSort($low), $middel, self::quickSort($high));
 }
 
 /**
  * Linear table delete
  * 
  * Removes elements from an array through a linear table
  * 
  * @param array $array
  * @param int $key
  * @return array
  */
 public static function LinearDelete($array, $key)
 {
     $len = count($array);
     for ($j = $key; $j < $len; $j++) {
         if (isset($array[$j + 1])) $array[$j] = $array[$j + 1];
     }
     array_pop($array);
     return $array;
 }
 
 /**
  * Selection sort
  * 
  * Sort the array through the sort algorithm
  * 
  * @param array $array
  * @return array
  */
 public static function selectSort($array)
 {
     $len = count($array);
     for ($i = 0; $i < $len; $i++) {
         $min = $i;
         for ($j = $i + 1;$j < $len; $j++) {
             if ($array[$min] > $array[$j]) {
                 $min = $j;
             }
         }
         if ($min != $i) {
             $tmp = $array[$i];
             $array[$i] = $array[$min];
             $array[$min] = $tmp;
         }
     }
     return $array;
 }
 
 /**
  * Insertion sort
  * Sort the array by insertion sort algorithm
  * 
  * @param array $array
  * @param array
  */
 public static function InsertSort($array)
 {
     $len = count($array);
     for ($i = 1; $i< $len; $i++) {
         $tmp = $array[$i];
         for ($j = $i - 1; $j > -1; $j--) {
             if ($array[$j] > $tmp) {
                 $array[$j + 1] = $array[$j];
                 if ($j == 0) {
                     $array[$j] = $tmp;
                 }
             } else {
                 $array[$j + 1] = $tmp;
                 break;
             }
         }
     }
     return $array;
 }
}

// 二分查找测试
echo '测试二分查找start<br>';
$array = [2, 4,1,5,8,11,33,22,17,99,23,10];
var_dump($array);
var_dump(Algorithm::binarySearch($array, 0, 9, 8));
echo '测试二分查找end<br>';

// 顺序查找测试
echo '测试顺序查找start<br>';
$array = [2, 4,1,5,8,11,33,22,17,99,23,10];
var_dump($array);
var_dump(Algorithm::orderFind($array,99));
echo '测试顺序查找end<br>';

// 冒泡排序测试
echo '测试冒泡算法start<br>';
$array = [2, 4,1,5,8,11,33,22,17,99,23,10];
var_dump($array);
var_dump(Algorithm::bubbingSort($array));
echo '测试冒泡算法end<br>';

// 快速排序测试
echo '测试快速算法start<br>';
$array = [2, 4,1,5,8,11,33,22,17,99,23,10];
var_dump($array);
var_dump(Algorithm::quickSort($array));
echo '测试快速算法end<br>';

// 线性删除测试
echo '测试线性删除start<br>';
$array = [2, 4,1,5,8,11,33,22,17,99,23,10];
var_dump($array);
var_dump(Algorithm::LinearDelete($array,2));
echo '测试线性删除end<br>';


// 选择排序测试
echo '测试选择排序start<br>';
$array = [2, 4,1,5,8,11,33,22,17,99,23,10];
var_dump($array);
var_dump(Algorithm::selectSort($array));
echo '测试选择排序end<br>';

// 插入排序测试
echo '测试插入排序start<br>';
$array = [2, 4,1,5,8,11,33,22,17,99,23,10];
var_dump($array);
// $array = array(4,2);
// var_dump($array);
var_dump(Algorithm::InsertSort($array));
echo '测试插入排序end<br>';