<?php

set_time_limit(99999);

ini_set("memory_limit","256M");



function pizza($input) {

  global $maxsize;

  $originalsize = count($input);

    $sum = 0;
    $sumArr = [];
    $final = [];


    $countery = 0; 
    while(count($input)) {

        // echo '<br/>';
        // echo $countery++;

        $largest = $input[count($input) - 1];
        $sum += $largest;

        if($sum == $maxsize) {
          array_push($final,count($input) - 1 );   
          return [$sum, $final]; 
        } else {

          if ($sum < $maxsize) {

            array_push($final,count($input) - 1 );
          } else {
            $sum -= $largest;
          }

        }

    array_pop($input);


    
    }

    if(count($input) == 0) {
        return [$sum, $final];
    }
}



$start = microtime(TRUE);

$inputdir = "input";
$outputdir = "output";

if (is_dir($inputdir)){
  if ($dh = opendir($inputdir)){
    while (($filename = readdir($dh)) !== false){
      if($filename != "." && $filename != "..") {
                  

        $file = file_get_contents($inputdir ."/". $filename, true);

        $lines = explode("\n", $file);

        $line_1 = explode(" ", $lines[0]);


        $maxsize = $line_1[0];
        $pTypes = $line_1[1];

        $input = explode(" ", $lines[1]);

        $output = [];

        $originalsize = count($input);

        // echo "input nos = ". count($input);

        $largestSum = 0;
        $largestArray = [];

        // $counterx = 0;

        while(count($input)) {

          // echo $counterx++;

          $start2 = microtime(TRUE);
          $op = pizza($input);
          $end2 = microtime(TRUE);
          echo "<hr>The code took " . ($end2 - $start2) * 1000 . " ms to complete.";

          if($largestSum <= 0) {
            $largestSum = $op[0];
            $largestArray = $op[1];
          } else {
            if($largestSum < $op[0]) {
              $largestSum = $op[0];
              $largestArray = $op[1];

            }
          }

          

          array_pop($input);

          
          
          

        }


        // krsort($output);

        
        
        // echo "<br>";
        
          echo "Sum = ".$largestSum ;
          // print_r($largestArray);
           echo "<br>";
          

        $first = $largestArray;

        // echo '<hr>';
        // $first = array_shift($output);

        

        $content = count($first);
        $content .= "\r\n";
   //     $content .= implode(" ", $first);

        echo $content;
//         file_put_contents($outputdir ."/". substr($filename, 0, -3) .".out", $content);
      }

      
    }
    closedir($dh);
  }
}



$end = microtime(TRUE);
echo "<hr>The code took " . ($end - $start) . " seconds to complete.";






?>