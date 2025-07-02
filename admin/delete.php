<?php

require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'JsonFile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Posts.php';

$id = filter_input(INPUT_POST, 'id') ?? null;

if ($id) {
    $file = new JsonFile('/../posts.json');
    $posts = new Posts($file);
    $posts->delete($id);

    echo 'Post deleted successfully<br />';
    echo '<a href="/personal-blog/admin/">Back</a><br />';
} else {
    echo "You nedd to set the article id to continue\n";
    echo "<a href=\"/personal-blog/admin/\">Back</a>";
}