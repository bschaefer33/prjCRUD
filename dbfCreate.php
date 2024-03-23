<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
<!-- dbfCreate.php - Createa a database
  Class: CSC 235 Server Side Development
  Week 3: prjCRUD
  Student Name: Brittany Schaefer
  Written: 3/30/22
  Revised: 4/2/22 BS
-->
<link rel="stylesheet" href= "style.css">
<title>Week 3 Project</title>
</head>
<body> 
    <?php
/****************************************
* Create Database connections
****************************************/
    //set up connection constants
    //forlocalhost and
    define("SERVER_NAME","localhost");
    define("DBF_USER_NAME","root");
    define("DBF_PASSWORD", "mysql");
    define("DATABASE_NAME","prjCRUD");
    //bluehost
    //define("SERVER_NAME","localhost");
    //define("DBF_USER_NAME","dsemachi_Brittany");
    //define("DBF_PASSWORD", "#database333");
    //define("DATABASE_NAME","dsemachi_prjCRUD");
    //create connection object
    $conn=new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
   
    //Start with new database
    $sql="Drop Database " . DATABASE_NAME;
    runQuery($sql, "DROP " . DATABASE_NAME, false);

    //check connection
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }
    //Create DB
        createDB();
    //Populate DB
        populateTable();

/****************************************
* createDB()
****************************************/
    function createDB(){ 
        global $conn;
        $sql = "CREATE DATABASE IF NOT EXISTS ". DATABASE_NAME;
        //if($conn->query($sql)===TRUE){
        //    echo "The database " . DATABASE_NAME . " exists or was created successfully!<br />";
        //}else {
        //    echo "Error creating database " . DATABASE_NAME . ": " . $conn->error;
        //    echo "<br />";
        //}
        runQuery($sql,"Creating " . DATABASE_NAME, false);
        //select the database
        $conn->select_db(DATABASE_NAME);

        /****************************************
         * Create the Tables
         ****************************************/
        //student
        $sql = "CREATE TABLE IF NOT EXISTS student (
            student_ID INT AUTO_INCREMENT PRIMARY KEY,
            studentFNAME VARCHAR(50) NOT NULL,
            studentLNAME VARCHAR(50) NOT NULL
            )";
        //if($conn->query($sql) === TRUE){
        //    echo "The table student exists or was created successfully!<br />";
        //} else{
        //    echo "Error creating table: student " . $conn->error;
        //    echo "<br />";
        //}
        runQuery($sql,"Creating student", false);

        //instructor
        $sql = "CREATE TABLE IF NOT EXISTS instructor (
            instructor_ID INT AUTO_INCREMENT PRIMARY KEY,
            instructorFNAME VARCHAR(50) NOT NULL,
            instructorLNAME VARCHAR(50) NOT NULL
            )";
        runQuery($sql,"Creating instructor", false);

        //location
        $sql = "CREATE TABLE IF NOT EXISTS clocation (
            clocation_ID INT AUTO_INCREMENT PRIMARY KEY,
            clocationHall VARCHAR(50) NOT NULL,
            clocationRoom VARCHAR(50) NOT NULL
            )";
        runQuery($sql,"Creating location", false);

        //course
        $sql = "CREATE TABLE IF NOT EXISTS course (
            course_ID INT AUTO_INCREMENT PRIMARY KEY,
            courseName VARCHAR(50) NOT NULL,
            courseDay VARCHAR(10),
            courseStartTime TIME,
            courseEndTime TIME,
            clocation_ID INT,
            instructor_ID INT
            )";
        runQuery($sql,"Creating course", false);

        //registration
        $sql = "CREATE TABLE IF NOT EXISTS registration (
            registration_ID INT AUTO_INCREMENT PRIMARY KEY,
            student_ID INT,
            course_ID INT 
            )";
        runQuery($sql,"Creating registration", false);
    }
    /****************************************
     * populateTable()
     ****************************************/
    //Populate Table: student
    //$sql= "INSERT INTO student (studentFNAME,studentLNAME) "
    //    . "VALUES('Lindsay','Haller')";
    //if ($conn->query($sql)===TRUE) {
    //    echo "New record created successfully.<br />";
    //}else {
    //    echo "<strong>Error:</strong> " . $sql . "<br>" . $conn->error;
    //}
    function populateTable(){
        global $conn;
        $studentArray = array(
            array("Lindsay", "Haller"),
            array("Mikayla", "Miller"),
            array("Bob", "Johnson"),
            array("Brittany", "Schaefer")
        );
        foreach($studentArray as $student){
            $sql = "INSERT INTO student(studentFNAME, studentLNAME) "
            ."VALUES ('" . $student[0] . "','"
            .$student[1] . "')";
            runQuery($sql, "Record inserted for: " . $student[0], false);
        }

        //Populate Table: instructor
        $instructorArray = array(
            array("Susan", "Furtney"),
            array("Octavia", "Spencer"),
            array("Mark","Walker"),
            array("David", "Larson")
        );
        foreach($instructorArray as $instructor){
            $sql = "INSERT INTO instructor(instructorFNAME, instructorLNAME) "
            ."VALUES ('" . $instructor[0] . "','"
            .$instructor[1] . "')";
            runQuery($sql, "Record inserted for: " . $instructor[0], false);
        }
        
        $clocationArray = array(
            array("Elm Hall", "342"),
            array("Pine Hall", "112"),
            array("Oak Hall", "132")
        );
        foreach($clocationArray as $clocation){
            $sql = "INSERT INTO clocation(clocationHall, clocationRoom) "
            ."VALUES ('" . $clocation[0] . "','"
            .$clocation[1] . "')";
            runQuery($sql, "Record inserted for: " . $clocation[0], false);
        }

        //Populate Table: course
        $courseArray = array(
            array("Server Side Development", "M", "10:00:00", "12:00:00", "1","1"),
            array("Discrete Math", "T", "08:00:00", "10:00:00", "2", "2"),
            array("Self Defense", "F", "08:00:00", "10:00:00", "2", "2"),
            array("Database Design", "MW", "13:00:00", "14:00:00", "3","3")
        );
        foreach($courseArray as $course){
            $sql = "INSERT INTO course(courseName, courseDay, courseStartTime, courseEndTime, clocation_ID, instructor_ID) "
            ."VALUES ('" . $course[0] . "','"
            .$course[1] . "','"
            .$course[2] . "','"
            .$course[3] . "','"
            .$course[4] . "','"
            .$course[5] . "')";
            runQuery($sql, "Record inserted for: " . $course[0], false);
        }

        //add course with no instructor
        $sql ="INSERT INTO course(courseName, courseDay, courseStartTime, courseEndTime, clocation_ID)
        VALUES ('Python','W','10:00:00','12:00:00', '2')";
        runQuery($sql, "Record inserted for: " . $course[0], false);

        //course with no instructor or location
        $sql ="INSERT INTO course(courseName, courseDay, courseStartTime, courseEndTime)
        VALUES ('Arts and Crafts','Th','10:00:00','12:00:00')";
        runQuery($sql, "Record inserted for: " . $course[0], false);

        //Populate Table: registration
        $registrationArray = array(
            array("1", "1"),
            array("2", "3"),
            array("2", "1"),
            array("4", "1"),
            array("4", "2"),
            array("4", "3"),
            array("1", "5")
        );
        foreach($registrationArray as $registration){
            $sql = "INSERT INTO registration(student_ID, course_ID) "
            ."VALUES ('" . $registration[0] . "','"
            .$registration[1] . "')";
            runQuery($sql, "Record inserted for: " . $registration[0], false);
        }
        //insert student without class
        $sql="INSERT INTO registration(student_ID)
        VALUES ('3')";
        runQuery($sql, "Record inserted for: " . $registration[0], false);
    }
    //close database
    //$conn->close();


     /****************************************
     * runQuery()
     ****************************************/
    function runQuery($sql,$msg,$echoSuccess) {
        global $conn;
        //run the query
        if($conn->query($sql)===TRUE) {
            if($echoSuccess){
                echo $msg . " successful.<br />";
            }
        } else{
            echo "<strong>Error when: " . $msg . "</strong> using SQL: " .$sql . "<br />" . $conn->error;
        }
    }
    /****************************************
     * displayResult()
     ****************************************/
    function displayResult($result,$sql){
        if ($result-> num_rows>0){
            echo "<table border='1'>";
            $heading = $result-> fetch_assoc();
            echo "<tr>";
            foreach($heading as $key=>$value){
                echo "<th>". $key . "</th>";
            }
            echo "</tr>";
            echo "<tr>";
            foreach($heading as $key=>$value){
                echo "<td>" . $value . "</td>";
            }
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                foreach($row as $key=>$value) {
                    echo "<td>" . $value. "</td>";
                }
                echo"</tr>";
            }
            echo "</table>";
        }else{
            echo "<strong>zero results using SQL: </strong>". $sql;
        }
    }
    ?>
</body>
</html>