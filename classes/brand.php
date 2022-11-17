<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php



class brand extends Database
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_brand($brandName)
    {
        if (empty($brandName)) {
            $alert = "<span class='error'>Brand must be not empty</span>";
            return $alert;
        } else {
            $sql = "INSERT INTO pet.tbl_brand(brandName) VALUES(?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$brandName]);
            $count = $stmt->rowCount();
            if ($count) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function show_brand()
    {
        $sql = "SELECT * FROM pet.tbl_brand order by brandId desc";
        $stmt = $this->connect()->query($sql);
        return $stmt;
    }
    public function getbrandbyId($id)
    {
        $sql = "SELECT * FROM pet.tbl_brand WHERE brandId = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function update_brand($brandName, $id)
    {

        if (empty($brandName)) {
            $alert = "<span class='error'>Brand must be not empty</span>";
            return $alert;
        } else {
            $sql = "UPDATE pet.tbl_brand SET brandName = ? WHERE brandId= ? ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$brandName, $id]);
            $count = $stmt->rowCount();
            if ($count) {
                $alert = "<span class='success'>Update Brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Brand Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function del_brand($id)
    {
        $sql = "DELETE FROM pet.tbl_brand WHERE brandId = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $count = $stmt->rowCount();
        if ($count) {
            $alert = "<span class='success'> Deleted Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Deleted Not Successfully</span>";
            return $alert;
        }
    }
}

?>