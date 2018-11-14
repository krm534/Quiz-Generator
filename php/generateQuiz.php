<!doctype html>
<html lang="en">
<head>
  <title>  </title>
  <link rel="stylesheet" href=""> 
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
//your password
$password = "";
$database = "seQuiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
/*
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";
*/

//each index corresponds with a chapter and each value corresponds with the number of questions
$questions = array(2,1,2,0,0,5,0,1,0,10);

/*
1) get the array of different amounts of questions
2) for each chapter wanted get that many questions
3) print it out in the form of question and X answers
*/

$chapterQuestionPair = array(); 
//create pairs of chapters and amount of questions
for($it = 0; $it < 10; $it++){
	if($questions[$it] > 0){
        array_push($chapterQuestionPair, array(($it+1), $questions[$it]));
	}
}
/*
debugging the chapter-question pairs
for($i = 0; $i < count($chapterQuestionPair); $i++){
    for($j = 0; $j < count($chapterQuestionPair[$i]); $j++){
        if($j == 0) echo 'Chapter = ';
        else echo 'Number Of Questions = ';
        echo $chapterQuestionPair[$i][$j] . "<br>";
    }
}
*/
//selects every question and answer
//select question, Answer1.answer as A,Answer2.answer as B,Answer3.answer as C, Answer4.answer as D, Answer5.answer as E from Questions, Answer1, Answer2,Answer3,Answer4,Answer5 where Questions.questionID = Answer1.questionID and Questions.questionID = Answer2.questionID and Questions.questionID = Answer3.questionID and Questions.questionID = Answer4.questionID and Questions.questionID = Answer5.questionID;

//Make each query and send it off to find the results
for($i = 0; $i < count($chapterQuestionPair); $i++){
    $questionAnswerQuery = "select chapter, question, Answer1.answer as A,Answer2.answer as B,Answer3.answer as C, Answer4.answer as D, Answer5.answer as E from Questions, Answer1, Answer2,Answer3,Answer4,Answer5 where Questions.questionID = Answer1.questionID and Questions.questionID = Answer2.questionID and Questions.questionID = Answer3.questionID and Questions.questionID = Answer4.questionID and Questions.questionID = Answer5.questionID";
    $chapter = $chapterQuestionPair[$i][0];
    $numberOfQuestions = $chapterQuestionPair[$i][1];
    $questionCounter = 0; 
    $questionAnswerQuery = $questionAnswerQuery . " and Questions.chapter = " . $chapter;
    $results = $conn->query($questionAnswerQuery);
    
    if($results->num_rows > 0){
        //output the data found
        while($row = $results->fetch_assoc()){
            //compare the questionCounter to the numberOfQuestions to only print out
            //the amount of questions the array calls for
            if($questionCounter < $numberOfQuestions){
                echo 'Chapter = ' . $row["chapter"] . ' Question = ' . $row["question"];
                echo '<br>';
                echo 'A = ' . $row["A"] . '<br>';
                echo 'B = ' . $row["B"] . '<br>';
                echo 'C = ' . $row["C"] . '<br>';
                echo 'D = ' . $row["D"] . '<br>';
                echo 'E = ' . $row["E"] . '<br>';
            }
            $questionCounter++;
        }
    }
    else{
        echo 'Result is 0';
    }
    
}

?>
  
</body>
</html>
