<?php

namespace Core;

class File
{
    private $fileName;
    private $fileSize;
    private $fileType;
    private $fileError;
    private $fileTmpName;
    public $fileSizeType = 'bytes';

    public function __construct(array $file)
    {
        $this->fileName = $file['name'];
        $this->fileSize = $file['size'];
        $this->fileType = $file['type'];
        $this->fileError = $file['error'];
        $this->fileTmpName = $file['tmp_name'];

    } // end construct

    public function rename(): File
    {
       $parts = explode('.', $this->fileName);
       $extension = end($parts);
       $this->fileName = rand().uniqid().'.'.$extension;
       return $this;
    } // end rename

    public function getFileSize(): void
    {
        if ($this->fileSize > 1024) {
            $this->fileSize = floor($this->fileSize / 1024);
            $this->fileSizeType = 'kb';
            if ($this->fileSize > 1024) {
                $this->filSize = $this->fileSize / 1024;
                $this->fileSizeType = 'mb';
            }
        }
    } // end getFileSize

    public function upload(string $folderName)
    {
        move_uploaded_file($this->fileTmpName,$folderName);
    }
}
?>