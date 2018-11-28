<!doctype html>
<html lang="en">
<head>
  <title>  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
</head>
<body>

<?php

print "<div class='container'>";
print "<h2> Retake Quiz </h2> </br>";

$servername = "localhost";
$username = "root";
//your password
$password = "";
$database = "se_quiz";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// getting all data in saved_quizzes table 
$quizIDQuery = "select * from saved_quizzes";
$result = $conn->query($quizIDQuery);
$quizIDs = array();

// add quizIDs to an array
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    array_push($quizIDs,$row["quizID"]);
  }
}

// query all saved quizzes that have quiz IDs
for ($i =0; $i <= sizeof($quizIDs);$i++){
  $quizQuery = "select * from saved_quizzes where quizID=".$i;
  $result = $conn->query($quizQuery);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        // string of all questions IDs in each saved quiz
        $questionString = $row["questions"];
        // string of size 10 - (ex: 2 0 0 4 0 0 0 5 0 0)
        $chapterString = $row["chapters"];
      }

    // sending strings to session
    $_SESSION['savedQuestions'] = $questionString;
    $_SESSION['questions'] = $chapterString;

    // used to count how many questions are in a quiz
    $questionIDarray = explode(' ', $questionString);
    // made the string into an array
    $chapterIDarray = explode(' ',$chapterString);  
    $chaptersArray=array();

  for ($x = 0; $x < 10;$x++) {

    if ($chapterIDarray[$x] != 0) {
      // this array is the same as $chapterIDarray without all the zeros
      array_push($chaptersArray,$x+1);
    }
    // a string of all chapters involved in quiz
    $chapters_short = implode(',',$chaptersArray);
  }  

  // form for user select a quiz; they are given the quiz ID, what chapters are involved, and how many question are on the quiz
  echo '<form id="inputForm" action="generateQuiz.php" method="post" >';
  echo '<input type="radio" name="name" value="'.$i.'">';
  echo ' Quiz '.$i.' - Includes chapters '.$chapters_short.', with '.sizeof($questionIDarray).' questions in total';
  echo '<br><br>';

  }
}

echo '</form>';
echo '<button type="submit" name = "submit" form="inputForm" value = "Submit">Submit</button>';
echo '<br><br>';

?>



</body>
</html>
