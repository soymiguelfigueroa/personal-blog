<?php

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

    public function getAll($order = 'asc')
    {
        $data = $this->file->read();

        if ($order == 'desc') {
            $data = array_reverse($data);
        }

        return $data;
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