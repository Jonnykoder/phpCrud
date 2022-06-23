

<?php
    //create a session 
    session_start();
    //server config ---- put your database config here
    $servername = "localhost";
    $username = "root";
    $password = "aA09107458420";
    $dbname = "crud";

    // Create connection
    $mysqli = new mysqli($servername, $username, $password , $dbname) or die(mysqli_error($mysqli));

    //Empty the string if the edit is not clicked.
    $id = 0;
    $Fullname = '';
    $Course = '';
    $Year = '';
    $Email = '';
    $update = false;

    if(isset($_POST['submit'])){
        //Save these data to the database: [Fullname, Course,Year,Email] 
        $Fullname = $_POST['fullname'];
        $Course = $_POST['course'];
        $Year = $_POST['year'];
        $Email = $_POST['email'];

        $mysqli->query("INSERT INTO php_crud (fullname,course,year,email) VALUES ('$Fullname' , '$Course','$Year','$Email')") or 
        die ($mysqli->error);

        $_SESSION['message'] = "Student has been added!";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
    }
    if(isset($_GET['delete'])){
        //delete user based on id 

        $id = $_GET['delete'];      
        $mysqli->query("DELETE FROM php_crud WHERE id=$id") or die($mysqli->error()) ;
    
        $_SESSION['message'] = "Student has been deleted!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
       
    }

    if(isset($_GET['edit'])){
        $update = true;
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM php_crud WHERE id=$id") or die($mysqli->error());
        if(count(array($result))==1){
            $row = $result->fetch_array();
            $Fullname = $row['fullname'];
            $Course = $row['course'];
            $Year = $row['year'];
            $Email = $row['email'];

        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $Fullname = $_POST['fullname'];
        $Course = $_POST['course'];
        $Year = $_POST['year'];
        $Email = $_POST['email'];

        $mysqli->query("UPDATE php_crud SET fullname='$Fullname',course='$Course',year='$Year',email='$Email' WHERE id=$id") or 
        die ($mysqli->error);
       
        $_SESSION['message'] = "Student profile has been updated!";
        $_SESSION['msg_type'] = "warning";
        header("location: index.php");
    }