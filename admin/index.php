<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You don't have access to this resource";
    exit;
} else {
    if ($_SERVER['PHP_AUTH_USER'] == 'admin' && $_SERVER['PHP_AUTH_PW'] == 'admin') {
        require_once __DIR__ . DIRECTORY_SEPARATOR .  'JsonFile.php';
        require_once __DIR__ . DIRECTORY_SEPARATOR .  'Post.php';
        require_once __DIR__ . DIRECTORY_SEPARATOR .  'Posts.php';
        $file = new JsonFile('/../posts.json');
        $posts = new Posts($file);
        $articles = $posts->getAll(order: 'desc');
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Personal Blog | Admin</title>
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        </head>
        <body>
            <div class="max-w-lg border-2 my-4 mx-auto p-4 rounded-sm">
                <div class="flex justify-between mb-4">
                    <h1 class="text-2xl font-bold">Personal blog</h1>
                    <a class="hover:underline" href="/personal-blog/admin/new.php">+ add</a>
                </div>
                <?php if($articles): ?>
                    <?php foreach($articles as $article): ?>
                        <div class="flex justify-between">
                            <span class="text-md font-bold"><?= $article['articleTitle'] ?></span>
                            <div class="flex justify-between gap-4 ">
                                <a class="hover:underline" href="/personal-blog/admin/edit.php?id=<?= $article['id'] ?>">Edit</a>
                                <form action="/personal-blog/admin/delete.php" method="POST">
                                    <button type="submit" class="hover:underline cursor-pointer" onclick="return confirm('Do you want to delete this item?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <span class="text-xl font-bold text-center mt-4">There's not articles right now</span>
                <?php endif ?>
            </div>
        </body>
        </html>
        <?php
    } else {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo "You don't have access to this resource";
        exit;
    }
}