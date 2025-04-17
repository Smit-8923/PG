<?php
    session_start();
    $connection = new mysqli("localhost", "root", "", "bookmypg");

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "SELECT * from tbl_admin where admin_email ='$email'";
        $result = $connection->query($sql);

            $row = $result->fetch_assoc();
            if($row['admin_password'] == $password){
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['user_name']=$row['user_name'];
                echo "<script> alert ('Password match')</script>"; 
                header("location:home.php");
            } else {
                echo "<script> alert ('Email and password not match')</script>";
            }
        }
?>