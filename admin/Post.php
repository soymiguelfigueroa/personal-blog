<?php

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