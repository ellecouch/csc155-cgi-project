<html>
<head>
<body>

<?php

require ('functions.php');

$conn = getConnection();

if (isset($_POST['selection'])) // form loaded itself
{

    if ($_POST['selection'] == "Create Account") // insert new record chosen
    {
       $stmt = $conn->prepare("INSERT INTO users                                        
                       (username, encrypted_password, usergroup, email,firstname,lastname,fullname)                  
                       VALUES (?,?,?,?,?,?,?)" );
        $stmt->bind_param("sssssss", $username, $encrypted_password,
                                  $usergroup, $email, $firstname, $lastname, $fullname);
        $username=$_POST['username'];
        $encrypted_password=password_hash($_POST['password'],
                                          PASSWORD_DEFAULT);
        $usergroup=$_POST['usergroup'];
        $email=$_POST['email'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $fullname=$firstname . " " . $lastname;
        //$stmt->execute();
        
        //if ($conn->connect_error) {
           //die("Connection failed: " . $conn->connect_error);}
       

        if($stmt->execute()) {
            header("Location: welcome.php");
        } else {
            echo "That username has already been chosen. Please try again." ;
        }

        // store the record (next slide) 
    }
    if ($_POST['selection'] == "Cancel") // insert new record chosen
    {
        header("Location: welcome.php");
    }
}

?>

                                                 
<form method='POST'>
Firstname: <input type='text' name='firstname' /> <br />
Lastname: <input type='text' name='lastname' /> <br />
Email Address: <input type='text' name='email' /> <br />
Username: <input type='text' name='username' /> <br />
Password: <input type='text' name='password' /> This is visible to you so do not put in a real password. This site is unsecure! <br />
Confirm Password: <input type='text' name='password' />This is visible to you so do not put in a real password. This site is unsecure! <br />
<input type="radio" name="usergroup"
<?php if (isset($usergroup) && $usergroup=="admin") echo "checked";?>
value="admin">Admin
<input type="radio" name="usergroup"
<?php if (isset($usergroup) && $usergroup=="user") echo "checked";?>
value="user">User
<input type="radio" name="usergroup"
<?php if (isset($usergroup) && $usergroup=="superuser") echo "checked";?>
value="superuser">Super User
<input type='submit' name='selection' value='Create Account' />
<input type='submit' name='selection' value='Cancel' />
</form>


</body>
</head>
</html>

