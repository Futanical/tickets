<?php

require_once('../classes/imageUpload.php');
require_once('../classes/resizeImage.php');

class resizeUpload extends imageUpload {
    protected $thumbDestination;
    protected $deleteOriginal;
    protected $suffix = '_rsz';

    public function __construct($path, $deleteOriginal = false) {
        parent::__construct($path);
        $this->thumbDestination = $path;
        $this->deleteOriginal = $deleteOriginal;
    }

    public function setThumbDestination($path) {
        if (!is_dir($path) || !is_writable($path)) {
            throw new Exception("$path must be a valid, writable directory.");
        }
        $this->thumbDestination = $path;
    }

    public function setThumbSuffix($suffix) {
        if (preg_match('/\w+/', $suffix)) {
            if (strpos($suffix, '_') !== 0) {
                $this->suffix = '_' . $suffix;
            } else {
                $this->suffix = $suffix;
            }
        } else {
            $this->suffix = '';
        }
    }

    protected function createThumbnail($image) {
        $thumb = new resizeImage($image);
        $thumb->setDestination($this->thumbDestination);
        $thumb->setSuffix($this->suffix);
        $fileName = $thumb->create();
        $messages = $thumb->getMessages();
        $this->messages = array_merge($this->messages, $messages);
        return $fileName;
    }
}