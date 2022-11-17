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



class customer extends Database
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  // dang ki
  public function insert_customers($data)
  {
    $name = $data['name'];
    $email = $data['email'];
    $password_1 = md5($data['password_1']);
    $diachi = $data['diachi'];
    $sodienthoai = $data['sodienthoai'];
    if (empty($name) || empty($email) || empty($password_1) || empty($diachi) || empty($sodienthoai)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $check_email = "SELECT * FROM pet.tbl_customer where email = ? LIMIT 1";
      $stmt = $this->connect()->prepare($check_email);
      $stmt->execute([$email]);
      $count=$stmt->rowCount();
      if ($count) {
        $alert = "<span class='error'>Email Already Existed</span>";
        return $alert;
      } else {
        $sql = "INSERT INTO pet.tbl_customer( `name`, `email`, `password_1`, `sodienthoai`, `diachi`) VALUES (?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $email, $password_1, $sodienthoai, $diachi]);
        if ($stmt) {
          $alert = "<span class='success'>Customer Creates Successfully</span>";
          return $alert;
        } else {
          $alert = "<span class='error'>Customer Creates Not Successfully</span>";
          return $alert;
        }
      }
    }
  }

  public function login_customers($data)
  {

    $email = $data['email'];
    $password_1 = md5($data['password_1']);

    $sql = "SELECT * FROM pet.tbl_customer WHERE email = ? AND password_1 = ? ";
    $stmt = $this->connect()->prepare($sql);




    if (empty($email) || empty($password_1)) {
      $alert = "User and Pass must be not empty";
      return $alert;
    } else {
      $stmt->execute([$email, $password_1]);
      $count = $stmt->rowCount();
      if ($count) {
        $User = $stmt->fetch();
        Session::set('customer_login', true);
        Session::set('customer_id', $User['customer_id']);
        Session::set('customer_name', $User['name']);
        // header('Location:index.php');
        echo '<script>document.location.href = "./trangchu.php"</script>';
      } else {
        $alert = "User and Pass not match";
        return $alert;
      }
    }
  }

  //  //cap nhat thong tin khach hang
  public function show_customers($id)
  {
    $sql = "SELECT * FROM pet.tbl_customer WHERE customer_id = ?"; //do doi ten cot id thanh customer_id
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt;
  }
  public function update_customers($data, $id)
  {
    $name = $data['name'];
    $email = $data['email'];
    $sodienthoai =  $data['sodienthoai'];
    $diachi = $data['diachi'];
    if (empty($name) || empty($email) || empty($diachi) || empty($sodienthoai)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      $sql = "UPDATE pet.tbl_customer SET `name`= ? , `email`= ?,`sodienthoai`= ?, `diachi`= ? WHERE customer_id= ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$name, $email, $sodienthoai, $diachi, $id]);
      $count = $stmt->rowCount();
      if ($count) {
        $alert = "<span class='success'>Customer Creates Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Customer Creates Not Successfully</span>";
        return $alert;
      }
    }
    // return $stmt;
  }


}
?>