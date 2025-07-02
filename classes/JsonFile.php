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