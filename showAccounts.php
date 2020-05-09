</html>
</head>
</body>


<html>
<head>
<?php
require ('functions.php');

// depending on the zone, call one of
//checkAccount("none");
//checkAccount("user");
checkAccount("admin");

$conn = getConnection();
?>
</head>
<body>
<?php printUserTable($conn); ?>
</body>


