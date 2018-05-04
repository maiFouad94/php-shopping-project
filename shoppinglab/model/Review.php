<?php

class Review extends BaseEntity
{

    public $id;
    public $comment;
    public $userId;
    public $createdAt;
    public $prodId;
    public $conn;

    public function __construct($conn, $reviewArray)
    {
        $this->conn = $conn;
        $this->id = $reviewArray['id'];
        $this->text = $reviewArray['comment'];
        $this->userId = new User($this->conn, $reviewArray['user_id']);
         $this->prodId = $reviewArray['prod_id'];
        $this->createdAt = $reviewArray['created_at'];
    }
}