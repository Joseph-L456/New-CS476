<?php

    $awnumber = "";
    if (isset($_GET["awNumber"])){
        $awnumber = $_GET['awNumber'];
    }
?>


<!DOCTYPE html>
<body>
    <div class="topGrid">
      <div class="title"><h1>Artwork Details of #


<?php

  echo $awnumber;
 
?>

<a href="main.php">Return</a>

</body>
</html>