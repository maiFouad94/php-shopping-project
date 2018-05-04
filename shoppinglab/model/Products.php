<?php

class Products extends BaseEntity
{

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProducts()
    {
        $query = "SELECT * FROM product ";
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $output[] = new Product($this->conn, $row);
            }
        }
        return $output;
    }
    public function getCategory($categoryId){
        $query = "select name from category where id = ".$categoryId;
        if ($result = $this->conn->query($query)) {
    $row = $result->fetch_assoc();
   // echo 'value = ' . $row['name'];
}
        return  $row['name'];        
    }
public function getProductBycat($catid)
    {
        $query = "SELECT * FROM product WHERE cid = ".$catid;
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $output[] = new Product($this->conn, $row);
            }
        }
        return $output;
    }
    public function getProductById($prodId)
    {
        $query = "SELECT * FROM product WHERE id = ".$prodId;
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
        }
        return $row;
    }
     public function filter($keyword)
    {
        $query = "SELECT * FROM product WHERE name LIKE '%{$keyword}%' ";
        $result = $this->conn->query($query);
        $output = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $output[] = new Product($this->conn, $row);
            }
        }
        return $output;
    }
}

