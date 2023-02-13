<?php
require_once("Database.php");

class User extends Database
{

    function login($email, $password)
    {
        try {
            $row = $this->search_by_id('invoice_user', 'email', $email);
            print_r($row);
            if (count($row) != 0) {
                if (password_verify($password, $row["password"]) && $row["email"] == $email) {
                    $_SESSION['user_id'] = $row["id"];
                    $_SESSION['user_email'] = $row["email"];
                    $_SESSION['user_name'] = $row["first_name"] . " " . $row["last_name"];
                    $_SESSION['admin'] = $row["admin"];
                } else {
                    $this->status = false;
                }
            } else {
                $this->status = false;
            }
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            return $this->status;
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

            $query = "INSERT INTO `invoice_user` (
                    `email`,
                    `password`,
                    first_name,
                    last_name,
                    `admin`
                    )  
                VALUES(
                     ?,?,?,?,?
                )";
            $this->prepare_query($query);
            $user_password = password_hash($user_password, PASSWORD_DEFAULT);
            $this->stmt->bind_param(
                "ssssi",
                $user_email,
                $user_password,
                $user_fname,
                $user_lname,
                $admin
            );
            $this->execute_query('i');
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            return $this->status;
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
            $query = "UPDATE `invoice_user`  SET 
                    `first_name`=?,
                    `last_name`=?,
                    email=?,
                    `password`=?,
                    `admin`=?
                     WHERE id=?";
            $this->prepare_query($query);
            $user_password = password_hash($user_password, PASSWORD_DEFAULT);
            $this->stmt->bind_param(
                "ssssii",
                $user_fname,
                $user_lname,
                $user_email,
                $user_password,
                $user_role,
                $user_id
            );
            $this->execute_query('u');
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            return $this->status;
        }
    }
}
