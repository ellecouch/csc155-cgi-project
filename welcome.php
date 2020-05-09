<html>
<head>
<title>CSC155 001DR Survey Thing</title>
<?php

require ('functions.php');

// depending on the zone, call one of
//checkAccount("none");
checkAccount("user");
checkAccount("admin");

$conn = getConnection();


if (isset($_POST['selection']))
{
    if ($_POST['selection'] == 'Login')
    {
        if (checkAndStoreLogin($conn, $_POST['username'], $_POST['password']))
        {
            header('Location: admin.php');
        }
        else
        {
            echo "Login Failed";
        }
    }
    else if ($_POST['selection'] == 'Create Account')
    {
        header("Location: createAccount.php");
    }
   
    else if ($_POST['selection'] == 'Login')
    {
        header("Location: admin.php");
    }
}

 
?>

<form method='POST'>
Username: <input type='text' name='username' /> <br />
Password: <input type='text' name='password' /> <br />
<input type='submit' name='selection' value='Login' />
<input type='submit' name='selection' value='Create Account' />
<input type='submit' name='selection' value='Cancel' />

</form>


</head>
<body>
Welcome Page!
Click the Create Account Button if you do not have an account, and would like to make one!
</body>
