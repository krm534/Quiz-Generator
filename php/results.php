<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
//turns the string passed through the 
function fixArray($string){
    $string = str_replace('[', '', $string);
    $string = str_replace(']', '', $string); 
    $string = explode(', ', $string);
    return $string; 
}
echo 'show how long the post array is using count<br>';
echo count($_POST) . "<br>";
echo 'show the contents of post array using print_r<br>';
print_r($_POST);

//the query: select answer from Answer1 where questionID = 1 and correct = 'y'
//run through fixString function

foreach($_POST as $index => $array) {
    if($index != 'submit'){
        echo "Key=" . $index . ", Value=" . $array;
        echo '<br>';
        
        $array = fixArray($array); 
        //answer
        echo $array[0] . '<br>'; 
        //questionID
        echo $array[1]; 
        echo "<br>";
    }
}

?>