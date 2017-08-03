<?php
include 'connectDB.php';
$query = 'SELECT id,login FROM messengerdb.users ';
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)){
    $LIST[] = $row;
}
echo json_encode($LIST,JSON_UNESCAPED_UNICODE);