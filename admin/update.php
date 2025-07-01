<?php

require_once __DIR__ . DIRECTORY_SEPARATOR .  'JsonFile.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .  'Post.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .  'Posts.php';

$id = filter_input(INPUT_POST, 'id') ?? null;
$articleTitle = filter_input(INPUT_POST, 'article-title') ?? null;
$publishingDate = filter_input(INPUT_POST, 'publishing-date') ?? null;
$content = filter_input(INPUT_POST, 'content') ?? null;

if ($id && $articleTitle && $publishingDate && $content) {
    $file = new JsonFile('/../posts.json');
    $post = new Post();
    $post->setId($id);
    $post->setArticleTitle($articleTitle);
    $post->setPublishingDate($publishingDate);
    $post->setContent($content);
    $posts = new Posts($file);
    $posts->update($post);

    echo 'Post updated successfully<br />';
    echo '<a href="/personal-blog/admin/">Back</a><br />';
} else {
    echo "You nedd to fill all the fields to continue\n";
    echo "<a href=\"/personal-blog/admin/edit.php?id={$id}\">Back</a>";
}