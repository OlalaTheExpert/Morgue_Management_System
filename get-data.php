<?php 
$selectedKey = $_GET['selected_key'];
$query = "SELECT * FROM incoming_deceased WHERE id= '".$selectedKey."'";
$run = mysql_query($query);
while($row = mysql_fetch_assoc($run)) {
    echo "<option value='..'>..</option>";
    } ?>