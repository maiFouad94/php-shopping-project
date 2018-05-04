<?php

class Reviews extends BaseEntity
{

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getReviews($prodId)
    {
        $query = "SELECT * FROM comment where prod_id = " .$prodId;
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $output[] = new Review($this->conn, $row);
            }
        }
        return $output;
    }

}
