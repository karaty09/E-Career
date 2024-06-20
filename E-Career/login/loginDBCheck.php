<?php
require_once '../db/connect.php';
session_start();

$errors = array();

if (isset($_POST['btn_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        $_SESSION['error'] = "username required";
    } else if (empty($password)) {
        $_SESSION['error'] = "password required";
    } else if ($username and $password and (count($errors) == 0)) {
        try {
            $stmt = $db->prepare("SELECT * FROM tb_user WHERE trim(emp_code)=:username AND trim(phone_number)=:password");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $db_id = $row['emp_id'];
                $db_username = $row['emp_code'];
                $db_password = $row['phone_number'];
                $db_role = $row['role_id'];
                $db_status = $row['status_name'];
            }
            if ($username != null and $password != null) {
                if ($stmt->rowCount() > 0) {
                    if ($db_status == 'Active') {
                        switch ($db_role) {
                            case 1:
                                $_SESSION['success'] = "Login Admin Successfully";
                                $user = $db->prepare("SELECT * FROM tb_user WHERE emp_id = $db_id");
                                $user->execute();
                                while ($row = $user->fetch(PDO::FETCH_BOTH)) {
                                    $_SESSION['user_login_id'] = $row[0];
                                    $_SESSION['user_login'] = $row['emp_code'];
                                    $_SESSION['firstname'] = $row['firstname_thai'];
                                    $_SESSION['lastname'] = $row['lastname_thai'];
                                    $_SESSION['role'] = $row['role_id'];
                                    $_SESSION['status'] = $row['status_name'];
                                }
                                header("location: ../admin/homeAdmin.php");
                                break;

                            // case 2:
                            //     $_SESSION['success'] = "Login MD Successfully";
                            //     $user = $db->prepare("SELECT * FROM tb_employee WHERE emp_id = $db_id");
                            //     $user->execute();
                            //     while ($row = $user->fetch(PDO::FETCH_BOTH)) {
                            //         $_SESSION['user_login_id'] = $row[0];
                            //         $_SESSION['user_login'] = $row['emp_code'];
                            //         $_SESSION['firstname'] = $row['firstname_thai'];
                            //         $_SESSION['lastname'] = $row['lastname_thai'];
                            //         $_SESSION['role'] = $row['role_id'];
                            //         $_SESSION['status'] = $row['status_name'];
                            //     }
                            //     header("location: ../md/infoMD.php");
                            //     break;

                            // case 3:
                            //     $_SESSION['success'] = "Login HR Successfully";
                            //     $user = $db->prepare("SELECT * FROM tb_employee WHERE emp_id = $db_id");
                            //     $user->execute();
                            //     while ($row = $user->fetch(PDO::FETCH_BOTH)) {
                            //         $_SESSION['user_login_id'] = $row[0];
                            //         $_SESSION['user_login'] = $row['emp_code'];
                            //         $_SESSION['firstname'] = $row['firstname_thai'];
                            //         $_SESSION['lastname'] = $row['lastname_thai'];
                            //         $_SESSION['role'] = $row['role_id'];
                            //         $_SESSION['status'] = $row['status_name'];
                            //     }
                            //     header("location: ../hr/infoHR.php");
                            //     break;

                            // case 4:
                            //     echo "Login User Successfully";
                            //     $_SESSION['success'] = "Login User Successfully";
                            //     $user = $db->prepare("SELECT * FROM tb_employee WHERE emp_id = $db_id");
                            //     $user->execute();
                            //     while ($row = $user->fetch(PDO::FETCH_BOTH)) {
                            //         $_SESSION['user_login_id'] = $row[0];
                            //         $_SESSION['user_login'] = $row['emp_code'];
                            //         $_SESSION['firstname'] = $row['firstname_thai'];
                            //         $_SESSION['lastname'] = $row['lastname_thai'];
                            //         $_SESSION['role'] = $row['role_id'];
                            //         $_SESSION['status'] = $row['status_name'];
                            //     }
                            //     header("location: ../user/infoUser.php");
                            //     break;
                        }
                    } else {
                        $_SESSION['error'] = "Your account is Inactive";
                        header("location: ./login.php");
                    }
                } else {
                    $_SESSION['error'] = "Wrong username or password";
                    header("location: ./login.php");
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
} else {
    header("location: ./login.php");
}
