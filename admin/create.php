<?php

require_once __DIR__ . DIRECTORY_SEPARATOR .  'JsonFile.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .  'Post.php';
require_once __DIR__ . DIRECTORY_SEPARATOR .  'Posts.php';

$articleTitle = filter_input(INPUT_POST, 'article-title') ?? null;
$publishingDate = filter_input(INPUT_POST, 'publishing-date') ?? null;
$content = filter_input(INPUT_POST, 'content') ?? null;

if ($articleTitle && $publishingDate && $content) {
    $file = new JsonFile('/../posts.json');
    $post = new Post();
    $post->setArticleTitle($articleTitle);
    $post->setPublishingDate($publishingDate);
    $post->setContent($content);
    $posts = new Posts($file);
    $posts->add($post);

    echo 'Post created successfully<br />';
    echo '<a href="/personal-blog/admin/">Back</a><br />';
    echo '<a href="/personal-blog/admin/new.php">Add another</a><br />';
} else {
    echo "You nedd to fill all the fields to continue\n";
    echo '<a href="/personal-blog/admin/new.php">Back</a>';
}