<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<style>
  .success {
    font-size: 18px;
    color: green !important;
  }

  .error {
    font-size: 18px;
    color: red !important;
  }
</style>


<?php



class cart extends Database
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  //thêm sp vào gio hang
  public function add_to_cart($quantity, $id, $customer_id)
  {
    $quantity =  $this->fm->validation($quantity);
    $ssId = session_id();
    $sql = "INSERT INTO pet.tbl_cart( productId, quantity, ssId,customer_id) VALUES (?,?,?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $quantity, $ssId, $customer_id]);
    $count = $stmt->rowCount();
    if ($count) {
      echo '<script>document.location.href = "./donhang.php"</script>';
    } else {
      echo '<script>document.location.href = "./404.php"</script>';
    }
  }

  // lay san pham vao don hang
  public function get_product_cart()
  {
    $ssId = session_id();

    $sql = "SELECT pet.tbl_product.*, pet.tbl_cart.*
    FROM pet.tbl_product INNER JOIN pet.tbl_cart ON pet.tbl_product.productId = pet.tbl_cart.productId
    WHERE ssId = ? AND status_cart= ?";

    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$ssId, 0]);
    return $stmt;
  }

  public function update_quantity_cart($quantity, $cartId)
  {

    $sql = "UPDATE pet.tbl_cart SET quantity = ? WHERE cartId = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$quantity, $cartId]);
    if ($stmt) {
      $msg = "<span class='success'>Product Quantity Update Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Product Quantity Update Not Successfully</span>";
      return $msg;
    }
  }

  public function del_product_cart($cartid)
  {

    $sql = "DELETE FROM pet.tbl_cart WHERE cartId = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$cartid]);
    $count = $stmt->rowCount();
    if ($count) {
      $msg = "<span class='success'>Product Deleted Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Product Deleted Not Successfully</span>";
      return $msg;
    }
  }

  public function del_all_data_cart()
  {
    $ssId = session_id();
    $sql = "DELETE FROM pet.tbl_cart WHERE ssId = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$ssId]);
  }

  public function insertOrder()
  {
    $ssId = session_id();
    $sql = "SELECT *
     FROM pet.tbl_cart WHERE ssId = ? AND status_cart = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$ssId, '0']);
    if ($stmt) {
      while ($result = $stmt->fetch()) { // lấy dư lieu đe truyen
        $cartId = $result['cartId'];


        $query_order = "INSERT INTO pet.tbl_order (`cartId`) VALUES (?)";
        $insert_order = $this->connect()->prepare($query_order);
        $insert_order->execute([$cartId]);


        $query_upCart_status = "UPDATE pet.tbl_cart SET status_cart= ? WHERE cartId = ? ";
        $upCart_status = $this->connect()->prepare($query_upCart_status);
        $upCart_status->execute(['1', $cartId]);
      }
      return $insert_order;
    }
  }

  public function getAmountPrice($customer_id)
  {
    $ssId = session_id();
    $sql = "SELECT *
    FROM pet.tbl_cart JOIN pet.tbl_product ON pet.tbl_product.productId = pet.tbl_cart.productId 
    JOIN pet.tbl_order ON pet.tbl_order.cartId = pet.tbl_cart.cartId where pet.tbl_cart.customer_id = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$customer_id]);
    return $stmt;
  }

  public function get_cart_ordered($customer_id)
  {
    $sql = "SELECT *
    FROM pet.tbl_cart 
    JOIN pet.tbl_product ON tbl_product.productId = tbl_cart.productId 
    JOIN pet.tbl_order ON tbl_order.cartId = tbl_cart.cartId where tbl_cart.customer_id = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$customer_id]);
    return $stmt;
  }
  //   public function get_cart_ordered($customer_id){


  public function get_inbox_cart()
  {
    $sql = "SELECT *
  FROM pet.tbl_cart 
  JOIN pet.tbl_product ON tbl_product.productId = tbl_cart.productId 
  JOIN pet.tbl_order ON tbl_order.cartId = tbl_cart.cartId ORDER BY date_order";
    $stmt = $this->connect()->query($sql);
    return $stmt;
  }

  public function shifted_admin($order_id, $time, $adminid)
  {

    $sql = "UPDATE pet.tbl_order SET `status` = ?, adminID = ? WHERE order_id= ? AND `date_order`= ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['1', $adminid, $order_id, $time]);
    $count = $stmt->rowCount();
    if ($count) {
      $msg = "<span class='success'>Update Order Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Update Order Not Successfully</span>";
      return $msg;
    }
  }


  public function shifted_confirm($order_id, $time)
  {

    $sql = "UPDATE pet.tbl_order SET `status` = ? WHERE order_id = ? AND date_order = ? "; //dang lam
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['2', $order_id, $time]);
    $count = $stmt->rowCount();
    if ($count) {
      $msg = "<span class='success'>Update Order Successfully</span>";
      return $msg;
    } else {
      $msg = "<span class='error'>Update Order Not Successfully</span>";
      return $msg;
    }
  }
}
?>