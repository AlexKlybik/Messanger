<?php
include 'connectDB.php';
$query = 'SELECT * FROM messengerdb.messages WHERE sender_id=' . $_SESSION['id'] . ' AND recipient_id=' . $_POST['recipient_id'] . ' UNION SELECT * FROM messengerdb.messages WHERE sender_id=' . $_POST['recipient_id'] . ' AND recipient_id=' . $_SESSION['id'];
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $LIST[] = $row;
}

echo json_encode($LIST, JSON_UNESCAPED_UNICODE);
