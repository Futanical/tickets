<?php

class resizeImage {
    protected $original;
    protected $originalWidth;
    protected $originalHeight;
    protected $newWidth;
    protected $newHeight;
    protected $maxSize = 120;
    protected $canProcess = false;
    protected $imageType;
    protected $destination;
    protected $name;
    protected $suffix = '_rsz';
    protected $messages = array();
    protected $x;
    protected $y;
    protected $smallestSide;

    public function __construct($image) {
        if (is_file($image) && is_readable($image)) {
            $details = getimagesize($image);
        } else {
            $details = null;
            $this->messages[] = "Cannot open $image";
        }

        // if getimagesize() returns an array, it looks like an image
        if (is_array($details)) {
            $this->original = $image;
            $this->originalWidth = $details[0];
            $this->originalHeight = $details[1];

            // check the mime type
            $this->checkType($details['mime']);
        } else {
            $this->messages[] = "$image doesn't appear to be an image";
        }
    }

    protected function checkType($mime) {
        $mimeTypes = array('image/jpeg', 'image/png', 'image/gif');
        if (in_array($mime, $mimeTypes)) {
            $this->canProcess = true;

            // extract the characters after 'image/'
            $this->imageType = substr($mime, 6);
        }
    }

    public function setDestination($destination) {
        if (is_dir($destination) && is_writable($destination)) {
            // get last character
            $last = substr($destination, -1);
            // add a trailing slash if missing
            if ($last == '/' || $last == '\\') {
                $this->destination = $destination;
            } else {
                $this->destination = $destination . DIRECTORY_SEPARATOR;
            }
        } else {
            $this->messages[] = "Cannot write to $destination";
        }
    }

    public function setMaxSize($size) {
        if (is_numeric($size) && $size > 0) {
            $this->maxSize = abs($size);
        } else {
            $this->messages[] = 'The value for setMaxSize() must be a positive number';
            $this->canProcess = false;
        }
    }

    public function setSuffix($suffix) {
        if (preg_match('/^\w+$/', $suffix)) {
            if (strpos($suffix, '_') !== 0) {
                $this->suffix = '_' . $suffix;
            } else {
                $this->suffix = $suffix;
            }
        } else {
            $this->suffix = '';
        }
    }

    public function create() {
        if ($this->canProcess && $this->originalWidth != 0) {
            $this->calculateSize($this->originalWidth, $this->originalHeight);
            $this->getName();
            $fileName = $this->createThumbnail();
            return $fileName;
        } elseif ($this->originalWidth == 0) {
            $this->messages[] = 'Cannot determine size of ' . $this->original; }
    }

    public function getMessages() {
        return $this->messages;
    }

    protected function calculateSize($width, $height) {
        if ($width <= $this->maxSize && $height <= $this->maxSize) {
            $ratio = 1;
        } elseif ($width > $height) {
            $this->y = 0;
            $this->x = ($width - $height) / 2;
            $this->smallestSide = $height;
        } else {
            $this->x = 0;
            $this->y = ($height - $width) / 2;
            $this->smallestSide = $width;
        }
    }

    protected function getName() {
        $extensions = array('/\.jpg$/i', '/\.jpeg$/i', '/\.png$/i', '/\.gif$/i');
        $this->name = preg_replace($extensions, '', basename($this->original));
    }

    protected function createImageResource() {
        if ($this->imageType == 'jpeg') {
            return imagecreatefromjpeg($this->original);
        } elseif ($this->imageType == 'png') {
            return imagecreatefrompng($this->original);
        } elseif ($this->imageType == 'gif') {
            return imagecreatefromgif($this->original);
        }
    }

    protected function createThumbnail() {
        $resource = $this->createImageResource();
        $thumbSize = 120;
        $thumb = imagecreatetruecolor($thumbSize, $thumbSize);

        imagecopyresampled($thumb, $resource, 0, 0, $this->x, $this->y, $thumbSize, $thumbSize, $this->smallestSide, $this->smallestSide);

        $newName = $this->name . $this->suffix;
        if ($this->imageType == 'jpeg') {
            $newName .= '.jpg';
            $success = imagejpeg($thumb, $this->destination . $newName, 100);
        } elseif ($this->imageType == 'png') {
            $newName .= '.png';
            $success = imagepng($thumb, $this->destination . $newName, 0);
        } elseif ($this->imageType == 'gif') {
            $newName .= '.gif';
            $success = imagegif($thumb, $this->destination . $newName);
        }
        if ($success) {
            $this->messages[] = '';
            return $this->destination . $newName;
        } else {
            $this->messages[] = "Couldn't create a thumbnail for " . basename($this->original);
        }


        imagedestroy($resource);
        imagedestroy($thumb);
    }


}