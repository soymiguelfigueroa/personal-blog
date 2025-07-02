<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You don't have access to this resource";
    exit;
} else {
    if ($_SERVER['PHP_AUTH_USER'] == 'admin' && $_SERVER['PHP_AUTH_PW'] == 'admin') {
        require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'JsonFile.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Post.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'personal-blog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR .  'Posts.php';

        $id = filter_input(INPUT_GET, 'id');
        $file = new JsonFile('/../posts.json');
        $posts = new Posts($file);
        $post = $posts->getPost($id);
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
                <h1 class="text-2xl font-bold">Update Article</h1>

                <form action="/personal-blog/admin/update.php" method="POST">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <div class="my-4">
                        <label for="article-title" class="block mb-2 text-sm font-medium text-gray-900">Article title</label>
                        <input type="text" id="article-title" name="article-title" value="<?= $post['articleTitle'] ?>" class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>

                    <div class="my-4">
                        <label for="publishing-date" class="block mb-2 text-sm font-medium text-gray-900">Publishing date</label>
                        <input type="date" id="publishing-date" name="publishing-date" value="<?= $post['publishingDate'] ?>" class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>

                    <div class="my-4">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Content</label>
                        <textarea rows="10" id="content" name="content" class="bg-black-50 border border-black-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required><?= $post['content'] ?></textarea>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                </form>
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