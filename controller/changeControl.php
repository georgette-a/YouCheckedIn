<?php 

require('model/db_class.php');
require('session.php');

//variable to create an instance of the database

$db = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);

if(isset($_POST['lgnbtn'])) {

    $email = $_POST['uemail'];

    $password = $_POST['ucpassword1'];

    $cpassword = $_POST['ucpassword2'];
    
    //this is a variable to hold the query that will run and fetch the users data.
    $loginAdmin = "SELECT * FROM `administrator` WHERE `adminEmail` = '$email'";
    $loginUser = "SELECT * FROM `users` WHERE `usermail` = '$email'";
    //this is a variable to hold the query that will change the users data.
   
    
    $changeUser = "UPDATE `users` SET `upassword`= '$password' WHERE usermail = '$email'";

    

    //variable to store the query response
    $result_admin = $db->query($loginAdmin);
    $result_user = $db->query($loginUser);

    //variable to store the query response
    
    


    if($result_admin->num_rows > 0){

        while($row = $result_admin->fetch_assoc()){
            //get the email of the user
            $u_email = $row['adminEmail'];
            
            //check if passwords are same
            if($password == $cpassword){

                $changeAdmin = "UPDATE `administrator` SET `adminPassword`= '$password' WHERE adminEmail = $u_email";

                $effectChange = mysqli_query($db,$changeAdmin);
                if($effectChange){
                    echo("<script> 
                    alert('Successful updatw');
                    window.location.href ='../changepassword.php';
                    </script>");
                

               

                //direct the user to login
                session_destroy();
                header('Location: ../index.php');}
                else{
                    
                }

            }
            else{
                echo ("<script> 
                    alert('Passwords Do not match');
                    window.location.href ='../changepassword.php';
                    </script>");

            }

        }

    }
    else if($result_user->num_rows > 0){

        while($row = $result_user->fetch_assoc()){
            //get the email of the user
            $u_email = $row['usermail'];
            
            //get the password
            $loginPassword = $row['upassword'];

            //compare the entered password with the database password
            if(
                $email == $u_email &&
                md5($loginPassword) == md5($password)
            ){

                //create a session for the user that logs in succefully
                $_SESSION['user_id'] = $row['userID'];

                $_SESSION['username'] = $row['username'];

                $_SESSION['email'] = $row['usermail'];
                
                //direct the user to their dashboard
                header('Location: ../view/user/dashboard.php');

            }
            else{
                echo "<script> 
                    alert('Invalid Username or Password!');
                    window.location.href ='../index.php';
                    </script>";

            }

        }

    }
    else{
        echo "<script> 
            alert('Invalid Username or Password!');
            window.location.href ='../index.php';
            </script>";
    }

}

?>