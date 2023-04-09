<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

//$currentUserId = 23;
if (isset($_SESSION['user']['id'])) {
    $user_id = $_SESSION['user']['id'];
} else {
    $user_id = 0;
}

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $user_id);


view("notes/show.view.php", [
    'heading' => "Note",
    'note' => $note,
]);


