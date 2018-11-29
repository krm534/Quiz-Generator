<!doctype html>
<html lang="en">
<head>
  <title>  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

  <?php
  function chapterInfo($string){
    $returnString ='';
    $arr = explode(',', $string);
    for($x=0; $x < count($arr); $x++){
      if($arr[$x] != 0){
        $returnString = $returnString . $arr[$x] . ' from chapter ' . ($x+1) . '<br>';
      }
    }
    return $returnString; 
  }
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
  echo '<table class="table table-striped">';
  echo '  <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Chapters</th>
            <th scope="col">Submit</th>
          </tr>
          </thead>
          <tbody>';
  if($result->num_rows > 0){
    $count = 0; 
    while($row = $result->fetch_assoc()){
      $count += 1;
      
      echo '
      <tr>
      <th scope="row">'.$count.'</th>
      <td>'.chapterInfo($row['chapters']).'</td>
      <td><button type="submit" class="btn btn-primary" name="savedQuestions" value ="'.$row['questions'].'">Generate Quiz</button><br></td>
      </tr>';
     
      
      // echo 
      // "
      //   <button type=\"submit\" class=\"btn btn-primary\" name=\"savedQuestions\" value ='".$row['questions']."'>Submit</button><br>
      // ";
     

    }
  }


echo '</form>';
echo '</tbody>';
echo '</table>';
echo '<span><a href="../index.html" class="btn btn-primary">Home</a>    </span>';
  ?>
  
</body>
</html>
