<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
<!-- dbfJoin.php - Demonstrate joins
  Class: CSC 235 Server Side Development
  Week 3: prjCRUD
  Student Name: Brittany Schaefer
  Written: 4/2/22
  Revised: 
-->
<link rel="stylesheet" href= "style.css">
<title>Week 3 Project</title>
</head>
<body> 
  <?php
  /****************************************
  * Create connection to dbfCreate.php
  ****************************************/
  include 'dbfCreate.php';
  echo "<h1>Project CRUD</h1>";
  /****************************************
  * Function to print <pre>
  ****************************************/
  function statement($sql){
    echo "<pre>";
    echo $sql;
    echo"</pre>";
  }
  /****************************************
  * Join Table
  ****************************************/
  echo "<h2>Join</h2>";
    $sql = "SELECT student.studentFname, student.studentLname,
    course.courseName, course.courseDay, course.courseStartTime, 
    course.courseEndTime, instructor.instructorFname, instructor.instructorLname,
    clocation.clocationHall, clocation.clocationRoom
    FROM registration
    JOIN student
    ON registration.student_ID = student.student_ID
    JOIN course
    ON registration.course_ID = course.course_ID
    JOIN instructor
    ON course.instructor_ID = instructor.instructor_ID
    JOIN clocation
    ON course.clocation_ID = clocation.clocation_ID";
    statement($sql);
    $result = $conn->query($sql);
    displayResult($result,$sql);
  
  /****************************************
  * Left Outer Join
  ****************************************/
  echo "<h2>Left Outer Join</h2>";
    $sql = "SELECT student.studentFname, student.studentLname,
    course.courseName, course.courseDay, course.courseStartTime, 
    course.courseEndTime, instructor.instructorFname, instructor.instructorLname,
    clocation.clocationHall, clocation.clocationRoom
    FROM registration
    LEFT JOIN student
    ON registration.student_ID = student.student_ID
    LEFT JOIN course
    ON registration.course_ID = course.course_ID
    LEFT JOIN instructor
    ON course.instructor_ID = instructor.instructor_ID
    LEFT JOIN clocation
    ON course.clocation_ID = clocation.clocation_ID";
    statement($sql);
    $result = $conn->query($sql);
    displayResult($result,$sql);
  
  /****************************************
  * Right Outer Join
  ****************************************/
  echo "<h2>Right Outer Join</h2>";
  $sql = "SELECT student.studentFname, student.studentLname,
    course.courseName, course.courseDay, course.courseStartTime, 
    course.courseEndTime, instructor.instructorFname, instructor.instructorLname,
    clocation.clocationHall, clocation.clocationRoom
    FROM registration
    RIGHT JOIN student
    ON registration.student_ID = student.student_ID
    RIGHT JOIN course
    ON registration.course_ID = course.course_ID
    RIGHT JOIN clocation
    ON course.clocation_ID = clocation.clocation_ID
    RIGHT JOIN instructor
    ON course.instructor_ID = instructor.instructor_ID";
    statement($sql);
    $result = $conn->query($sql);
    displayResult($result,$sql);
  ?>
  <h2>Explaining Joins<h2>
  <p>
    I ended up making my database more complicated than it needed to be, 
    but it still effectively shows an inner join, left outer join and a right outer 
    join. An inner join, or also known as just a join will show only the records that have
    values in the foreign keys. In the join output, student_ID and course_ID are used to connect students
    to their registered classes. Then the course table is used to connect the location and 
    professor to each course and outputs all the information that connects. In a left outer join, all the data
    is displayed in the left table, and then anything else that matches the other foreign keys. Notice that the python
    class is shown even though there is no instructor for the course yet. This is because the course table is to the 
    left of the instructor table. The final output is from a right outer join, and therefore all data in the table to
    the right is shown, and then only data that is matched is shown in the rest. When joining multiple tables together
    with the right and left joins the priority cascades from one side to the other. I changed the order of the joins 
    on the right outer join so that would give instructor information the priority.
  </p>
  
</body>
</html>