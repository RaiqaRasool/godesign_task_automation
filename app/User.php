<?php

use function PHPUnit\Framework\throwException;

require_once "config.php";

class User
{
    private $username;
    private $host;
    private $password;
    private $dbname;

    function __construct()
    {
        $this->username = DB_USER;
        $this->host = DB_HOST;
        $this->password = DB_PWD;
        $this->dbname = DB_NAME;
    }

    function login($email, $password)
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            $query=$connection->prepare("SELECT * FROM invoice_user WHERE email=?");
            if(!$query){
                $status=false;
            }
            else{
                $query->bind_param("s",$email);
                if($query->execute()){
                    $result=$query->get_result();
                    $row=$result->fetch_assoc();
                    if (password_verify($password,$row["password"])) {
                        $status = true;
                        $_SESSION['user_id'] = $row["id"];
                        $_SESSION['user_email'] = $row["email"];
                        $_SESSION['user_name'] = $row["first_name"] . " " . $row["last_name"];
                        $_SESSION['admin'] = $row["admin"];
                        $status=true;
                    } else {
                        $status = false;
                    }
                }
                else{
                    $status=false;
                }
            }
        } catch (Exception $e) {
            die("Something went Wrong while Loggin In.");
        } finally {
            $connection->close();
            return $status;
        }
    }

    //will return user data when id is given
    function get_user($id)
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            $query = $connection->prepare("SELECT * FROM invoice_user WHERE id=?");
            if (!$query) {
                $status = false;
            }
            $query->bind_param("i", $id);
            if ($query->execute()) {
                $result = $query->get_result();
                $user_data = $result->fetch_assoc();
                $status = $user_data;
            } else {
                $status = false;
            }
        } catch (Exception $e) {
            die("Something went Wrong while getting user data");
        } finally {
            $connection->close();
            return $status;
        }
    }

    function create_user(
        $user_email,
        $user_password,
        $user_fname,
        $user_lname,
        $admin
    ) {
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception("Connection failed");
            }
            $insert_user = $connection->prepare("INSERT INTO `invoice_user` (
                    `email`,
                    `password`,
                    first_name,
                    last_name,
                    `admin`
                    )  
                VALUES(
                     ?,?,?,?,?
                )");
            //checking if statement is preparable
            if (!$insert_user) {
                $status = false;
            }
            $user_password = password_hash($user_password,PASSWORD_DEFAULT);
            $insert_user->bind_param(
                "ssssi",
                $user_email,
                $user_password,
                $user_fname,
                $user_lname,
                $admin
            );
            $user_insertion_status = $insert_user->execute();
            if ($user_insertion_status <= 0) {
                $status = false;
            } else
                $status = true;
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $status;
        }
    }

    function list_users()
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }
            $query = "SELECT * FROM `invoice_user` ORDER BY id DESC";
            $queried = $connection->query($query);
            $list = $queried->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $list;
        }
    }

    function edit_user(
        $user_id,
        $user_fname,
        $user_lname,
        $user_email,
        $user_password,
        $user_role
    ) {
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }
            $update_user = $connection->prepare("UPDATE `invoice_user`  SET 
                    `first_name`=?,
                    `last_name`=?,
                    email=?,
                    `password`=?,
                    `admin`=?
                     WHERE id=?");
            //checking if statement is preparable
            if (!$update_user) {
                $status = false;
            }
            $user_password = password_hash($user_password,PASSWORD_DEFAULT);
            if (!$update_user->bind_param(
                "ssssii",
                $user_fname,
                $user_lname,
                $user_email,
                $user_password,
                $user_role,
                $user_id

            )) {
                $status = false;
            };

            $user_updation_status = $update_user->execute();
            //if user data not updated return it
            if ($user_updation_status <= 0) {
                $status = false;
            } else
                $status = true;
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $status;
        }
    }

    function delete_user($user_id)
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }
            $user_delete = $connection->prepare("DELETE FROM `invoice_user` WHERE id=?");
            if (!$user_delete) {
                $status = false;
            }
            $user_delete->bind_param("i", $user_id);
            if (!$user_delete->execute()) {
                $status = false;
            } else
                $status = true;
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $status;
        }
    }
}
