<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You don't have access to this resource";
    exit;
} else {
    if ($_SERVER['PHP_AUTH_USER'] == 'admin' && $_SERVER['PHP_AUTH_PW'] == 'admin') {
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
            <div class="max-w-lg border-2 my-4 mx-auto p-4 rounded-sm flex justify-between">
                <h1 class="text-2xl font-bold">Personal blog</h1>
                <a class="hover:underline" href="/personal-blog/admin/new.php">+ add</a>
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