<?php

class Comment {

    protected $commentBody;

    public function __construct($commentBody) {
        $this->commentBody = $commentBody;
    }
}