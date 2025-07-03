<?php
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'JsonFile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Post.php';
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Posts.php';
$file = new JsonFile('/../posts.json');
$posts = new Posts($file);
$articles = $posts->getAll(order: 'desc');
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
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Personal blog</h1>
        </div>
        <?php if($articles): ?>
            <?php foreach($articles as $article): ?>
                <a href="article.php?id=<?= $article['id'] ?>">
                    <div class="flex justify-between">
                        <span class="text-md font-bold hover:underline"><?= $article['articleTitle'] ?></span>
                        <span class="text-md hover:underline"><?= $article['createdAt'] ?></span>
                    </div>
                </a>
            <?php endforeach ?>
        <?php else: ?>
            <span class="text-xl font-bold text-center mt-4">There's not articles right now</span>
        <?php endif ?>
    </div>
</body>
</html>