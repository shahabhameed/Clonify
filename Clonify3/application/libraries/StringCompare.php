<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class StringCompare{
  
  function __construct(){
    $this->ci =& get_instance();
  }
  
  function getDifferenceBetweenStrings($s1, $s2) {
      $i = 0;
      $s1_len = strlen($s1);
      $s2_len = strlen($s2);
      $a = array_fill(0, ($s1_len + 1), array_fill(0, ($s2_len + 1), 0));
      $s1 = str_split($s1);
      $s2 = str_split($s2);
      for ($i = 0; $i < $s1_len; $i++) {
        for ($j = 0; $j < $s2_len; $j++) {
          if ($s1[$i] == $s2[$j])
            $a[$i + 1][$j + 1] = $a[$i][$j] + 1;
          else
            $a[$i + 1][$j + 1] = max($a[$i + 1][$j], $a[$i][$j + 1]);
        }
      }

      $x = $s1_len;
      $y = $s2_len;
      $result = array();
      $clean_result = array();
      $clean_result2 = array();
      $return_array = array();
      while ($x != 0 and $y != 0) {
        if ($a[$x][$y] == $a[$x - 1][$y])
          $x--;

        else if ($a[$x][$y] == $a[$x][$y - 1])
          $y--;
        else {
          array_push($result, $s1[$x - 1]);
          //echo $s1[$x-1];
          $x--;
          $y--;
        }
      }
      $result = array_reverse($result);
      $s1_copy = $s1;
      $s2_copy = $s2;

      $comma_separated = implode("", $result);
      $comma_separated = str_replace(array('[', ']', '(', ')', ';', '{', '}'), ' ', $comma_separated);
      $result = explode(' ', $comma_separated);

      $count = count($result);

      $comma_separated = implode("", $s1_copy);
      $comma_separated = str_replace(array('[', ']', '(', ')', ';', '{', '}'), ' ', $comma_separated);
      $s1_copy = explode(' ', $comma_separated);

      $comma_separated = implode("", $s2_copy);
      $comma_separated = str_replace(array('[', ']', '(', ')', ';', '{', '}'), ' ', $comma_separated);
      $s2_copy = explode(' ', $comma_separated);


      //var_dump($s1_copy);
      for ($k = 0; $k < $count; $k++) {
        if (($key = array_search($result[$k], $s1_copy)) !== false) {
          //echo $result[$k];
          //echo ' ';
          array_push($clean_result, $result[$k]);
          array_push($clean_result, " ");
          unset($s1_copy[$key]);
        }

        if (($key = array_search($result[$k], $s2_copy)) !== false) {
          //echo $result[$k];
          //echo ' ';
          array_push($clean_result2, $result[$k]);
          array_push($clean_result2, " ");
          unset($s2_copy[$key]);
        }
      }
      //var_dump($s1_copy);
      $comma_separated = implode("", $clean_result);
      $different = implode(" ", $s1_copy);
      $different2 = implode(" ", $s2_copy);
      $return_array[0] = $different;
      $return_array[1] = $different2;
      return $return_array;
      //return $comma_separated;
    }
}  

