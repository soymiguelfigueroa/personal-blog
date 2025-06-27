<?php

class JsonFile
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $handle = $this->open();

        if (!$handle) {
            $this->createFile();
        }
    }

    public function read()
    {
        $handle = $this->open();

        $filse_size = $this->getFileSize();

        if ($filse_size > 0) {
            $content = fread($handle, $filse_size);
        } else {
            $content = json_encode([]);
        }

        $this->close($handle);

        return json_decode($content, true);
    }

    public function save($content)
    {
        $handle = $this->open(mode: 'w+');

        $content_encoded = json_encode($content);

        fwrite($handle, $content_encoded);

        $this->close($handle);
    }

    private function createFile()
    {
        $handle = $this->open(mode: 'w');
        $this->close($handle);
    }

    private function open($mode = 'r+')
    {
        return fopen(filename: $this->getFullFilename(), mode: $mode);
    }

    private function getFileSize()
    {
        return filesize($this->getFullFilename());
    }

    private function getFullFilename()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . $this->filename;
    }

    private function close($handle)
    {
        return fclose($handle);
    }
}

class post
{
    private $id;
    private $articleTitle;
    private $publishingDate;
    private $content;
    private $createdAt;
    private $updatedAt;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getArticleTitle()
    {
        return $this->articleTitle;
    }

    public function getPublishingDate()
    {
        return $this->publishingDate;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;
    }

    public function setPublishingDate($publishingDate)
    {
        $this->publishingDate = $publishingDate;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}

class Posts
{
    private $file;

    public function __construct(JsonFile $file)
    {
        $this->file = $file;
    }

    public function add(Post $post)
    {
        $data = $this->file->read();

        $current_date = $this->getCurrentDate();

        $post->setId($this->getNextId(data: $data));
        $post->setCreatedAt(createdAt: $current_date);
        $post->setUpdatedAt(updatedAt: $current_date);

        $data[] = [
            'id' => $post->getId(),
            'articleTitle' => $post->getArticleTitle(),
            'publishingDate' => $post->getPublishingDate(),
            'content' => $post->getContent(),
            'createdAt' => $post->getCreatedAt(),
            'updatedAt' => $post->getUpdatedAt(),
        ];

        $this->file->save($data);
    }

    private function getCurrentDate(): string
    {
        return date('Y-m-d H:i:s', strtotime('now'));
    }

    private function getNextId($data): int
    {
        if ($data) {
            $lastId = $data[array_key_last($data)]['id'];
        } else {
            $lastId = 0;
        }

        return ++$lastId;
    }
}

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