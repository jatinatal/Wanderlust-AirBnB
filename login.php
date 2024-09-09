<?php
include("connection.php");
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    //for check data are filled or not
    if($username!="" && $email!="" && $password!="")
    {
        $sql = "INSERT INTO userdata VALUES('$username','$email','$password');";

        if(mysqli_query($conn, $sql))
        {
        echo "Data inserted Succesfully";
        }
    }
    else
    {
        echo "All fields are required";
    }   
}
 ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css"></link>
    
</head>
<body>
    <div class ="home">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick = "Login()">Log In</button>
                <button type="button" class="toggle-btn" onclick= "SignIn()">Sign Up</button>
            
            </div>
            <form action= "" method="POST" id="Login" class="input-group">
                <input type="text" class="input-field" name="username" placeholder="Username" required>
                <input type="text" class="input-field" name="password" placeholder="Enter Password" required>
                <input type="checkbox" class="checkbox"><span class="st">Remember Password </span>
                <button type="submit" class="submit-btn">Login</button> 

            </form>
    
            <form action="" method="POST" id="SignIn" class="input-group">
                <input type="text" class="input-field" name="username" placeholder="User name"
                required>
                <input type="text" class="input-field" name="email"placeholder="Email Id"
                required>
                <input type="text" class="input-field" name="password"placeholder="Enter Password"
                required>
                <input type="checkbox" class="checkbox"><span class="st">I agree with your terms and conditions </span>
                <button type="submit" class="submit-btn" id="sign" name="submit">Sign In</button>
            </form> 
        </div>
    </div>
    
     <script>
        var x = document.getElementById("Login");
        var y = document.getElementById("SignIn");
        var z = document.getElementById("btn");
		
        function SignIn(){
            x.style.left = "-850px"; // changes in here:~ increased left position
            y.style.left = "50px";
            z.style.left = "110px";
			
        }
        function Login(){
            x.style.left = "50px";
            y.style.left = "-850px"; // changes in here:~ increased left position
            z.style.left = "0";
        }
    </script>
</body>
</html>

