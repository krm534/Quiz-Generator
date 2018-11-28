<!doctype html>
<html lang="en">
<head>
  <title>  </title>
  <link rel="stylesheet" href=""> 
</head>
<body>

  <?php
  print "<div class='container'>";
  print "<h2> Retake Quiz </h2> </br>";
  
  require 'loginInfo.php';
  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // getting all data in saved_quizzes table 
  $quizIDQuery = "select * from SavedQuizzes";
  $result = $conn->query($quizIDQuery) or die($conn->error);
  $quizIDs = array();
  echo '<form action="generateQuiz.php" method="post">';
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo $row['quizID'];
      
      echo 
      "
        <button type=\"submit\" class=\"btn btn-primary\" name=\"savedQuestions\" value ='".$row['questions']."'>Submit</button><br>
      ";
      echo '<br>';
    }
  }


echo '</form>';
  ?>
  
</body>
</html>
