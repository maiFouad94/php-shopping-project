<?php

$conn;

class Product extends BaseEntity
{

    public $id;
    public $name;
    public $photo;
    public $description;
    public $cid;
    public $price;
    public $rate;
    public $count;
    
   public function __construct($conn, $productArray= false)
    {
        $this->conn = $conn;
        if($productArray)
        {
        $this->id = $productArray['id'];
        $this->name = $productArray['name'];
      //  $this->categoryId = new Category($this->conn, $productArray['category_id']);
        $this->cid = $productArray['cid'];
        $this->price = $productArray['price'];
        $this->description = $productArray['description'];
        $this->photo = $productArray['photo'];
        $this->rate = $productArray['rate'];
        $this->count = $productArray['count'];

        }

        }
    public function save()
    {
        $time = date("Y-m-d H:i:s");
        $query = "INSERT INTO `product` (`id`, `name`, `photo`, `price`, `cid`, `description`) "
                . "VALUES (NULL, '{$this->getName()}', '{$this->getPhoto()}', '{$this->getPrice()}', '{$this->getCid()}', '{$this->getDescription()}');";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        $this->id = mysqli_insert_id($this->conn);
        return $this->id;
    }
public function update()
    {
        $query = "UPDATE `product` SET `name`='{$this->getName()}',`description`='{$this->getDescription()}',`photo`='{$this->getPhoto()}',`cid`={$this->getCid()},`price`={$this->getPrice()} WHERE id= {$this->id}";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
    }

}
