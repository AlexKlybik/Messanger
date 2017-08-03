<?php
include 'connectDB.php';

$query = 'INSERT INTO messengerdb.messages (recipient_id,sender_id,message) VALUES ('.$_POST['recipient_id'].','. $_SESSION['id'].','.$_POST['text'].')';
mysqli_query($link, $query);
echo mysqli_error();

