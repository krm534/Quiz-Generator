# Quiz Generator
This software will take a list of questions from chapters 1-10 of our software engineering textbook and interact with the user to generate a quiz.

###folder structure
index.html - The starting page where the user generates the quiz
php - holds all of the php documents. These are the pages that interact with the database 
css - holds all the styling done for the webapp
js - holds all of the javaScript files used for the webapp
sql - holds all of the files that create and populate the database and tables in the database

###specific files
generateQuiz.php - takes input from index.html to generate a random quiz that uses the users input 
results.php - takes input from generateQuiz.php to show the results of the users quiz

makeDB - text file to intialize the database and most of the tables
createSaveQuizDB - text file to intialize the SavedQuizzes table
chaptersTable_Anthony - text file to populate the table Chapters
LoganQuestionsTable.sql - populates the Questions table
brandonSQL.sql - populates the tables Answer1 and Answer2
answer3and4.sql - populates the tables Answer3 and Answer4
UpdatedAnswer5 - text file to populate the table Answer5

### How to use the software
For all Operating Systems, you can use XAMPP which can be found https://www.apachefriends.org/index.html 
There is a set up guide for windows, linux, and mac. It should come with all the different technologies that we use, being PHP and MySQL. 

	1) Start your apache and mysql services. This is done by opening xampp and clicking start on both of these option. 
	2) The files in the sql folder will need to be put into your database. This can be done by just copying and pasting the contents into your phpMyAdmin SQL page terminal. 
	3) The rest of the project needs to be stored in the location of your localhost. For example, on windows it is stored at C:xampp/htdocs.
	4) Open localhost in your browser. You may need to navigate to the correct folder, but once you are in the correct folder the app will load up.  
	
