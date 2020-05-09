<html>
<head>
<body>



<?php

function checkAccount($zone)
{
    // zone is either 'user' or 'admin', anything else is considered 
    // 'none' or publicly accessible

}


function getConnection(){
                                  
   $conn = mysqli_connect("localhost","ecouch2","ecouch2","ecouch2");        

       // Check connection and shutdown if broken
   if (mysqli_connect_errno()) {
      die("<b>Failed to connect to MySQL: " . mysqli_connect_error() . "</b>");
   }   

      return $conn;
  
}

function printUserTable($conn)
{   // build the SQL that pulls the data from the database
    $sql = "SELECT * FROM users;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {   // loop through all the rows
        while( $row = $result->fetch_assoc() )
        {   // output the data from each row
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>"
            . "<td>" . $row["username"] . "</td>"
            . "<td>" . $row["encrypted"] . "</td>" 
            . "<td>" . $row["usergroup"] . "</td>"
            . "<td>" . $row["email"] . "</td>"
            . "<td>" . $row["firstname"] . ' ' . $row["lastname"] . "</td>";
            echo "</tr>";

        }
    }
    else
    {   // empty table
    }
}


function checkAndStoreLogin( $conn, $usernameToTest, $passwordToTest )
{

    $result=lookupUserName($conn, $usernameToTest);
    if ($result != FALSE)
    {
        $row = $result->fetch_assoc();
        $encrpytedFromDB = $row['encrypted_password'];
        if ( password_verify($passwordToTest, $encrpytedFromDB) )
        {
          
            $_SESSION['username'] = $row['username'];
            $_SESSION['usergroup'] = $row['usergroup'];
            return TRUE;
        }
    }
    return FALSE;
}

function lookUpUserName($conn, $usernameToFind)
{
    $sql = "SELECT * FROM users WHERE username=? ;"; // SQL with parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usernameToFind);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows == 1) {
            return $result;
        }
            else {
        return FALSE;
    }

}


?>

</html>
</head>
</body>
