<?php
    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $pw = $_POST['pw'];
    }

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "14store";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    if(!empty($email) && !empty($pw) && !is_numeric($email))
    {

        //read from database
        $query = "select * from registration where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

        if($email == "admin" && $pw == "123"){
            header("Location: admin.html");
            die;
        }

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['pw'] === $pw)
                {

                    $_SESSION['id'] = $user_data['id'];
                    header("Location: mainpage.html");
                    die;
                }
            }
        }
        
        echo "wrong username or password!";
    }else
    {
        echo "wrong username or password!";
    }
	
    mysqli_close($con);

?>