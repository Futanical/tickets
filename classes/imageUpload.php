<?php

class imageUpload {

    protected $uploaded = array();
    protected $destination;
    protected $max = 5120000;
    protected $messages = array();
    protected $permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
    protected $renamed = false;

    public function __construct($path) {
        if (!is_dir($path) || !is_writable($path)) {
            throw new Exception("$path must be a valid and writable directory");
        }

        $this->destination = $path;
        $this->uploaded = $_FILES;
    }

    public function move($overwrite = false) {
        $field = current($this->uploaded);
        $OK = $this->checkError($field['name'], $field['error']);

        if ($OK) {
            $sizeOK = $this->checkSize($field['name'], $field['size']);
            $typeOK = $this->checkType($field['name'], $field['type']);

            if ($sizeOK && $typeOK) {
                $name = $this->checkName($field['name'], $overwrite);
                $success = move_uploaded_file($field['tmp_name'], $this->destination . $name);

                if ($success) {
                    if (!$this->deleteOriginal) {
                        $message = '';

                        if ($this->renamed) {
                            $message .= '';
                        }

                        $this->messages[] = $message;

                    }

                    // create a thumbnail from the uploaded image
                    $fileName = $this->createThumbnail($this->destination . $name);
                    // delete the uploaded image if required
                    if ($this->deleteOriginal) {
                        unlink($this->destination . $name);
                    }

                    return $fileName;

                    }
                } else {
                    $this->messages[] = 'Could not upload ' . $field['name'];
                }
            }
        }

    public function getMessages() {
        return $this->messages;
    }

    protected function checkError($fileName, $error) {
        switch ($error) {
            case 0:
                return true;
            case 1:
            case 2:
                $this->messages[] = "$fileName exceeds maximum size: " . $this->getMaxSize();
                return true;
            case 3:
                $this->messages[] = "Error uploading $fileName. Please try again.";
                return false;
            case 4:
                $this->messages[] = 'No file selected.';
                return false;
            default:
                $this->messages[] = "System error uploading $fileName. Contact your webmaster.";
                return false;
        }
    }

    protected function checkSize($fileName, $size) {
        if ($size == 0) {
            return false;
        } elseif ($size > $this->max) {
            $this->messages[] = "$fileName exceeds maximum size: " . $this->getMaxSize();
            return false;
        } else {
            return true;
        }
    }

    protected function checkType($fileName, $type) {
        if (empty($type)) {
            return false;
        } elseif (!in_array($type, $this->permitted)) {
            $this->messages[] = "$fileName is not a permitted type of file";
            return false;
        } else {
            return true;
        }
    }

    public function getMaxSize() {
        return number_format($this->max/1024, 1) . 'kB';
    }

    public function setMaxSize($num) {
        if (!is_numeric($num)) {
            throw new Exception("Maximum size must be a number");
        }

        $this->max = (int) $num;
    }

    protected function checkName($name, $overwrite) {
        $noSpaces = str_replace(' ', '_', $name);
        if ($noSpaces != $name) {
            $this->renamed = true;
        }

        if (!$overwrite) {
            // rename the file if it already exists

            $existing = scandir($this->destination);
            if (in_array($noSpaces, $existing)) {
                $dot = strrpos($noSpaces, '.');

                if ($dot) {
                    $base = substr($noSpaces, 0, $dot);
                    $extension = substr($noSpaces, $dot);
                } else {
                    $base = $noSpaces;
                    $extension = '';
                }

                $i = 1;

                do {
                    $noSpaces = $base . '_' . $i++ . $extension;
                } while (in_array($noSpaces, $existing));

                $this->renamed = true;
            }

        }

        return $noSpaces;
    }
}



