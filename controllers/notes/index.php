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

$notes = $db->query('select * from notes where user_id = :user_id', ['user_id' => $user_id])->get();
//$notes = $db->query("select * from notes where user_id = 22")->get();
//$notes = $db->query('select * from notes where id = :id', [
//    'id' => $_POST['id']
//])->get();

view("notes/index.view.php", [
    'heading' => "My Notes",
    'notes' => $notes,
]);