<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
// include_once('/../lib/session.php');
Session::checkLogin();
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php
class adminlogin extends Database
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser, $adminPass)
    {

        $sql = "SELECT * FROM pet.tbl_admin WHERE adminUser = ? AND adminPass = ? ";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$adminUser, md5($adminPass)]);
        $count = $stmt->rowCount();
        if (empty($adminUser) || empty($adminPass)) {
            $alert = "User and Pass must be not empty";
            return $alert;
        } else {

            if ($count) {
                $admin_User = $stmt->fetch();
                Session::set('adminlogin', true);
                Session::set('adminId', $admin_User['adminID']);
                Session::set('adminUser', $admin_User['adminUser']);
                Session::set('adminName', $admin_User['adminName']);
                echo '<script>document.location.href = "./index.php"</script>';
            } else {
                $alert = "User and Pass not match";
                return $alert;
            }
        }
    }
}

?>