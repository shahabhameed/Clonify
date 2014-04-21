<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class StringCompare{
  
  function __construct(){
    $this->ci =& get_instance();
  }
  
  function getDifferenceBetweenStrings($s1, $s2, $line_number, $line_number2) {
//$a[strlen($s1)+1][strlen($s2)+1];	
    $output = array();
    $string1 = $s1;
    $string2 = $s2;

    $i = 0;
    $s1_len = strlen($s1);
    $s2_len = strlen($s2);
    $a = array_fill(0, ($s1_len + 1), array_fill(0, ($s2_len + 1), 0));
//    $max = 0;
//    if ($s1 > $s2){
//      $max = $s1;
//    }else{
//      $max = $s2;
//    }
//    
//    for($k = 0; $k < $max; $k++){
//      for ($z = 0; $z < $max; $z++){
//        $a[$k][$z] = 0;
//      }
//    }
    
//echo "<pre>",print_r($a),"<pre>";
    $line_word_arr = array_fill(0, ($s1_len + 1), array_fill(0, ($s2_len + 1), 0));
    $s1 = str_split($s1);
//echo "<pre>",print_r($s1),"<pre>";
    $s2 = str_split($s2);
//echo "<pre>",print_r($s2),"<pre>";
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
    
//    echo "BREFORE : <pre>",print_r($result),"<pre>";
    $result = array_reverse($result);
    
//    echo "AFTER : <pre>",print_r($result),"<pre>";
    
    //echo("My result is");

    $s1_copy = $s1;
    $s2_copy = $s2;

    $comma_separated = implode("", $result);
//    echo($comma_separated);
    $comma_separated = str_replace(array('[', ']', '(', ')', ';', '{', '}'), ' ', $comma_separated);
    $result = explode(' ', $comma_separated);

    $count = count($result);

    $comma_separated = implode("", $s1_copy);
    $comma_separated = str_replace(array('[', ']', '(', ')', ';', '{', '}'), ' ', $comma_separated);
    $s1_copy = explode("\n", $comma_separated);

    $comma_separated = implode("", $s2_copy);
    $comma_separated = str_replace(array('[', ']', '(', ')', ';', '{', '}'), ' ', $comma_separated);
    $s2_copy = explode("\n", $comma_separated);
    
    for ($j = 0; $j < count($s1_copy); $j++) {
      $s1_copy[$j] = explode(" ", $s1_copy[$j]);
    }

    for ($j = 0; $j < count($s2_copy); $j++) {
      $s2_copy[$j] = explode(" ", $s2_copy[$j]);
    }
    
//    echo "<br /> **************************************** <br />";
//    echo "<pre>",print_r($s1_copy),"<pre>";
//    echo "<pre>",print_r($s2_copy),"<pre>";
//    echo "<br /> **************************************** <br />";
//    
//    echo "<br /> ********************* RESULT ******************* <br />";
//    echo "<pre>",print_r($result),"<pre>";
////    echo "<pre>",print_r($s2_copy),"<pre>";
//    echo "<br /> **************************************** <br />";
    

    // till now both s1_copy and s2_copy have been made in to a 2d array
    //convert $s1_copy in to array of array of strings
    //output append words to the specific line number
    $save_result = $result;
    for ($k = 0; $k < $count; $k++) {
      $k_found = 0;
      for ($m = 0; $m < count($s1_copy); $m++) {

        if (!empty($s1_copy[$m])) {

          $s1_copy[$m];
          //echo(var_dump($temp_arr));
          if (($key = array_search($result[$k], $s1_copy[$m])) !== false and $k_found == 0 and !empty($result[$k])) {
            //echo $result[$k];
            //echo ' ';
//            echo "<br /> ---- KEY : $m ---- <br />";
            array_push($clean_result, $result[$k]);
            array_push($clean_result, " ");
            $line_real = $m + $line_number;
//            echo ("<br />ACTUAL LINE NUMBER : ".($m + $line_number)."<br />");
//            echo(" line number in which to highlight the follwing word in file 1 is");
//            echo($line_real);
//            echo("<br />");
//            echo(" word to highlight in file 1 is ");
//            echo"<b>".($result[$k])."</b>";
//            echo("<br />");
            $output['string_1'][$line_real][] = $result[$k];
            $k_found = 1;
            unset($s1_copy[$m][$key]);
          }
        }
      }
    }

//    echo "<br /> ****************************** SECOND STRING ********************* <br />";
    
    
    for ($k = 0; $k < $count; $k++) {
      $k_found = 0;
      for ($m = 0; $m < count($s2_copy); $m++) {

        if (!empty($s2_copy[$m])) {

          $s2_copy[$m];
          //echo(var_dump($temp_arr));
          if (($key = array_search($result[$k], $s2_copy[$m])) !== false and $k_found == 0 and !empty($result[$k])) {
//            echo "<br /> ---- KEY : $m ---- <br />";
            //echo $result[$k];
            //echo ' ';
            array_push($clean_result, $result[$k]);
            array_push($clean_result, " ");
            $line_real2 = $m + $line_number2;
//            echo ("<br />ACTUAL LINE NUMBER : ".($m + $line_number2)."<br />");
//            echo(" line number in which to highlight the follwing word in file 2 is :<br />");
//            echo($line_real2);
//            echo("<br />");
//            echo("word to highlight in file is ");
//            echo"<b>".($result[$k])."</b>";
//            echo("<br />");
            $k_found = 1;
            $output['string_2'][$line_real2][] = $result[$k];
            unset($s2_copy[$m][$key]);
          }
        }
      }
    }

    return $output;
//    echo "<pre>", print_r($output), "</pre>";

  }  
  
  function getDifferenceBetweenStrings1($s1, $s2, $s1_start_line, $s2_start_line, $start_col, $end_col) {
      $s1 = substr($s1, $start_col, strlen($s1));
      $s2 = substr($s2, $start_col, strlen($s2));
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
      
      return array_merge($s1_copy, $s2_copy);
      
//      $different = implode(" ", $s1_copy);
//      $different2 = implode(" ", $s2_copy);
//      $return_array[0] = $different;
//      $return_array[1] = $different2;
      return $return_array;
    }
}  

