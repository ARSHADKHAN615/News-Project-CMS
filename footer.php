<?php
$sql = "SELECT * FROM settings";

$result = mysqli_query($connection, $sql) or die("Settings Query Failed");
$row = mysqli_fetch_assoc($result);
?>

<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $row['footerDesc'] ?> <a href="http://www.yahoobaba.net/"></a></span>
            </div>
        </div>
    </div>
</div>
</body>

</html>