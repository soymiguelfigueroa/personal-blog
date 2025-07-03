<?php

require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'JsonFile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Posts.php';

$id = filter_input(INPUT_GET, 'id') ?? null;

if ($id) {
    $file = new JsonFile('/../posts.json');
    $posts = new Posts($file);
    $article = $posts->getPost($id);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal Blog</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body>
        <div class="max-w-lg border-2 my-4 mx-auto p-4 rounded-sm">
            <?php if($article): ?>
                <h1 class="text-2xl font-bold mb-4"><?= $article['articleTitle'] ?></h1>
                <p class="text-md mb-4"><?= $article['createdAt'] ?></p>
                <p class="text-md font-bold mb-4"><?= $article['content'] ?></p>
                <a href="index.php" class="block text-center hover:underline">Back</a>
            <?php else: ?>
                <span class="text-xl font-bold text-center mt-4">404 Not found</span>
            <?php endif ?>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "You nedd to set the article id to continue\n";
    echo "<a href=\"/personal-blog/admin/\">Back</a>";
}