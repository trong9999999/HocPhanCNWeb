<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php



class product extends Database
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }
  public function insert_product($data, $files)
  {


    $productName = $data['productName'];
    $category = $data['category'];
    $brand =  $data['brand'];
    $productdesc = $data['productdesc'];
    $price = $data['price'];
    $type_1 = $data['type_1'];

    // Kiem tre hinh anh va lay hinh anhcho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if (empty($productName) || empty($category) ||  empty($brand) || empty($productdesc) || empty($price) || empty($type_1) || empty($file_name_1)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      move_uploaded_file($file_temp, $uploaded_image);
      $sql = "INSERT INTO pet.tbl_product( productName, catId,brandId, productdesc, type_1, price, image_1) VALUES (?,?,?,?,?,?,?)";
      $stmt = $this->connect()->prepare($sql);

      if ($stmt) {
        $stmt->execute([$productName, $category, $brand, $productdesc, $type_1, $price, $unique_image]);
        $alert = "<span class='success'>Insert Product Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Product Not Successfully</span>";
        return $alert;
      }
    }
  }
  public function show_product()
  {
    $sql = "SELECT pet.tbl_product.*, pet.tbl_category.catName, pet.tbl_brand.brandName
        FROM pet.tbl_product INNER JOIN pet.tbl_category ON pet.tbl_product.catId = pet.tbl_category.catId
        INNER JOIN pet.tbl_brand ON pet.tbl_product.brandId = pet.tbl_brand.brandId
        order by pet.tbl_product.productId desc";
    $stmt = $this->connect()->query($sql);
    return $stmt;
  }


  public function update_product($data, $files, $id)
  {

    $productName = $data['productName'];
    $category = $data['category'];
    $brand =  $data['brand'];
    $productdesc = $data['productdesc'];
    $price = $data['price'];
    $type_1 = $data['type_1'];

    // Kiem tre hinh anh va lay hinh anhcho vao folder upload
    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name_1 = $_FILES['image_1']['name'];
    $file_size = $_FILES['image_1']['size'];
    $file_temp = $_FILES['image_1']['tmp_name'];

    $div = explode('.', $file_name_1);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if (empty($productName) || empty($category) ||  empty($brand) || empty($productdesc) || empty($price) || empty($type_1)) {
      $alert = "<span class='error'>Files must be not empty</span>";
      return $alert;
    } else {
      if ($file_name_1) {
        // neu nguoi dung chon anh
        if ($file_size > 1009600) {
          $alert = "<span class='success'>Image Size should be less hen 2MB!</span>";
          return $alert;
        } else if (in_array($file_ext, $permited) === false) {

          $alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
          return $alert;
        }
        move_uploaded_file($file_temp, $uploaded_image);
        $sql = "UPDATE pet.tbl_product SET 
             productName = ?,
             brandId = ?,
             catId = ?,
             type_1 = ?,
             price = ?,
             image_1 = ?,
             productdesc = ?
             WHERE productId = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productName, $brand, $category, $type_1, $price, $unique_image, $productdesc, $id]);
      } else {
        //neu nguoi dung khong chon anh
        $sql = "UPDATE pet.tbl_product SET 
        productName = ?,
        brandId = ?,
        catId = ?,
        type_1 = ?,
        price = ?,
        productdesc = ?
        WHERE productId = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productName, $brand, $category, $type_1, $price, $productdesc, $id]);
      }
      $count = $stmt->rowCount();
      if ( $count) {
        $alert = "<span class='success'>Product Upload Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Product Upload Not Successfully</span>";
        return $alert;
      }
    }
  }

  public function del_product($id)
  {
    $sql = "DELETE FROM pet.tbl_product WHERE productId = ? ";
    $stmt = $this->connect()->prepare($sql);

    if ($stmt) {
      $stmt->execute([$id]);
      $alert = "<span class='success'>Deleted Successfully</span>";
      return $alert;
    } else {
      $alert = "<span class='error'> Deleted Not Successfully</span>";
      return $alert;
    }
  }

  public function getproductbyId($id)
  {
    $sql = "SELECT * FROM pet.tbl_product WHERE productId = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt;
  }

  // //END Back end
  // SAN PHAM NỔI BẬT
  public function getproduct_feathered()
  {
    $sql = "SELECT * FROM pet.tbl_product where type_1 = '1'";
    $stmt = $this->connect()->query($sql);

    return $stmt;
  }
  /// SAN PHAM MỚI
  public function getproduct_new()
  {
    $sql = "SELECT * FROM pet.tbl_product order by productId desc LIMIT 4";
    $stmt = $this->connect()->query($sql);

    return $stmt;
  }
  //   // show san pham trang sanpham.php
  public function getproduct_binhthuong()
  {
    $sql = "SELECT * FROM pet.tbl_product ";
    $stmt = $this->connect()->query($sql);
    return $stmt;
  }

  public function get_details($id)
  {
    $sql = "SELECT pet.tbl_product.*, pet.tbl_category.catName, pet.tbl_brand.brandName
            FROM pet.tbl_product INNER JOIN pet.tbl_category ON pet.tbl_product.catId = pet.tbl_category.catId
            INNER JOIN pet.tbl_brand ON pet.tbl_product.brandId = pet.tbl_brand.brandId 
            WHERE pet.tbl_product.productId = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt;
  }

  public function getproduct_timkiem($search_1)
  {

    $sql = "SELECT * from pet.tbl_product where productName like ? or ? or ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(["%" . $search_1 . "%", "%" . $search_1, $search_1 . "%"]);
    $count = $stmt->rowCount();
    if (empty($count)) {
      echo "Không có sản phẩm nào như vậy!";
    } else {
      return $stmt;
    }
  }
}


?>