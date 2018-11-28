<!doctype html>
<html lang="en">
<meta charset="UTF-8">
<head>
  <title> Quiz Results </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<?php

echo
'
	<div class="container">
  	<br><h2>Quiz Results Page</h2><br>
';

error_reporting(E_ALL); ini_set('display_errors', '1');

//turns the string into in an array
function fixArray($string){
    $string = str_replace('[', '', $string);
    $string = str_replace(']', '', $string);
    $string = explode(', ', $string);
    return $string;
}

//there was an error with unicode and apostrophes so this should fix it
function fixString($string) {
    return preg_replace('/[^\x00-\x7f]/', '\'', $string);
}

require 'loginInfo.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// counter for question number
$counter = 0;

//run through fixString function
foreach($_POST as $index => $array) {
    if($index != 'submit'){
        $counter += 1;
        echo $counter . '. ';
        $array = fixArray($array);

        // select question asked to user
        $getQuestion = "select question from Questions where questionID=".$array[1];

        // select answer that user entered from Answer1-Answer5
        if ($array[0] == 'a') {
          $getUserAnswer = "select answer from Answer1 where questionID=$array[1]";
        }
        else if ($array[0] == 'b') {
          $getUserAnswer = "select answer from Answer2 where questionID=$array[1]";
        }
        else if ($array[0] == 'c') {
          $getUserAnswer = "select answer from Answer3 where questionID=$array[1]";
        }
        else if ($array[0] == 'd') {
          $getUserAnswer = "select answer from Answer4 where questionID=$array[1]";
        }
        else if ($array[0] == 'e') {
          $getUserAnswer = "select answer from Answer5 where questionID=$array[1]";
        }

        // Convert questions query to array
        $questionResult = $conn->query($getQuestion) or die($conn->error);
        
        $questionArray = $questionResult->fetch_assoc();

        // Display questions that were asked
        echo $questionArray["question"] . "<br>";

        // Display what letter user chose
        echo "* you answered: " . $array[0] . " (";

        // Convert user's answer query to array
        $userAnswerResult = $conn->query($getUserAnswer);
        $userAnswerArray = $userAnswerResult->fetch_assoc();

        // Display user's answer
        echo $userAnswerArray["answer"] . ") <br>";

        // select the correct answer of the question
        $getCorrectAnswer1 = "select answer from Answer1 where questionID=$array[1] and correct='y'";
        $getCorrectAnswer2 = "select answer from Answer2 where questionID=$array[1] and correct='y'";
        $getCorrectAnswer3 = "select answer from Answer3 where questionID=$array[1] and correct='y'";
        $getCorrectAnswer4 = "select answer from Answer4 where questionID=$array[1] and correct='y'";
        $getCorrectAnswer5 = "select answer from Answer5 where questionID=$array[1] and correct='y'";

        // Display correct answer beginning message
        echo "* correct answer: ";

        // Display correct answers if the answer is A or in answers 1 table
        $correctAnswerResult1 = $conn->query($getCorrectAnswer1);
        if ($correctAnswerResult1->num_rows > 0) {
          $correctAnswer1 = $correctAnswerResult1->fetch_assoc();
          echo $correctAnswer1["answer"] . "<br>";

          // compare user input to correct input
          if ($userAnswerArray["answer"] == $correctAnswer1["answer"]) {
            echo "* you are correct";
            echo "<br><br>";
          }
          else {
            echo "* you are incorrect";
            echo "<br><br>";
          }
        }
        else {
        }

        // Display correct answers if the answer is B or in answers 2 table
        $correctAnswerResult2 = $conn->query($getCorrectAnswer2);
        if ($correctAnswerResult2->num_rows > 0) {
          $correctAnswer2 = $correctAnswerResult2->fetch_assoc();
          echo $correctAnswer2["answer"] . "<br>";

          // compare user input to correct input
          if ($userAnswerArray["answer"] == $correctAnswer2["answer"]) {
            echo "* you are correct";
            echo "<br><br>";
          }
          else {
            echo "* you are incorrect";
            echo "<br><br>";
          }
        }
        else {
        }

        // Display correct answers if the answer is C or in answers 3 table
        $correctAnswerResult3 = $conn->query($getCorrectAnswer3);
        if ($correctAnswerResult3->num_rows > 0) {
          $correctAnswer3 = $correctAnswerResult3->fetch_assoc();
          echo $correctAnswer3["answer"] . "<br>";

          // compare user input to correct input
          if ($userAnswerArray["answer"] == $correctAnswer3["answer"]) {
            echo "* you are correct";
            echo "<br><br>";
          }
          else {
            echo "* you are incorrect";
            echo "<br><br>";
          }
        }
        else {
        }

        // Display correct answers if the answer is D or in answers 4 table
        $correctAnswerResult4 = $conn->query($getCorrectAnswer4);
        if ($correctAnswerResult4->num_rows > 0) {
          $correctAnswer4 = $correctAnswerResult4->fetch_assoc();
          echo $correctAnswer4["answer"] . "<br>";

          // compare user input to correct input
          if ($userAnswerArray["answer"] == $correctAnswer4["answer"]) {
            echo "* you are correct";
            echo "<br><br>";
          }
          else {
            echo "* you are incorrect";
            echo "<br><br>";
          }
        }
        else {
        }

        // Display correct answers if the answer is E or in answers 5 table
        $correctAnswerResult5 = $conn->query($getCorrectAnswer5);
        if ($correctAnswerResult5->num_rows > 0) {
          $correctAnswer5 = $correctAnswerResult5->fetch_assoc();
          echo $correctAnswer5["answer"] . "<br>";

          // compare user input to correct input
          if ($userAnswerArray["answer"] == $correctAnswer5["answer"]) {
            echo "* you are correct";
            echo "<br><br>";
          }
          else {
            echo "* you are incorrect";
            echo "<br><br>";
          }
          }
          else {
          }
    }
}

echo '</div>';
?>

</body>
</html>
