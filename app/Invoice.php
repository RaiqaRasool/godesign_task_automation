<?php
require_once("./config.php");

class Invoice
{
    private $host;
    private $username;
    private $pwd;
    private $dbname;

    function __construct()
    {
        $this->host = DB_HOST;
        $this->username = DB_USER;
        $this->pwd = DB_PWD;
        $this->dbname = DB_NAME;
    }
    function create_invoice(
        $client_name,
        $client_company,
        $client_street,
        $client_city,
        $client_state,
        $client_country,
        $client_zip,
        $due_date,
        $desc,
        $hours,
        $hr_rate,
        $amount
    ) {
        $date_due_converted = date("Y-m-d H:i:s", strtotime($due_date));
        try {
            $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }
            $insert_invoice = $connection->prepare("INSERT INTO `invoice` (
                `user_id`,
                `invoice_due_date`,
                `invoice_receiver_name`,
                invoice_receiver_company,
                invoice_receiver_street,
                invoice_receiver_city,
                invoice_receiver_state,
                invoice_receiver_country,
                invoice_receiver_zip
                )  
            VALUES(
                 ?,?,?,?,?,?,?,?,?
            )");
            //checking if statement is preparable
            if (!$insert_invoice) {
                $status = false;
            } else {
                $insert_invoice->bind_param(
                    "issssssss",
                    $_SESSION['user_id'],
                    $date_due_converted,
                    $client_name,
                    $client_company,
                    $client_street,
                    $client_city,
                    $client_state,
                    $client_country,
                    $client_zip
                );

                $invoice_insertion_status = $insert_invoice->execute();
                $invoice_id = $connection->insert_id;

                //if invoice data not inserted return it
                if ($invoice_insertion_status <= 0) {
                    $status = false;
                } else {
                    for ($i = 0; $i < count($desc); $i++) {

                        $insert_invoice_item = $connection->prepare("INSERT INTO `invoice_item` 
            (
                `invoice_id`,
                invoice_item_desc,
                invoice_item_hours,
                invoice_item_hr_rate,
                invoice_item_amount
            )
            VALUES
            (?,?,?,?,?)
            ");
                        //returning false on failing statement preparation
                        if (!$insert_invoice_item) {
                            $status = false;
                        }
                        $insert_invoice_item->bind_param(
                            "isiii",
                            $invoice_id,
                            $desc[$i],
                            $hours[$i],
                            $hr_rate[$i],
                            $amount[$i]
                        );
                        $invoice_item_insertion_status = $insert_invoice_item->execute();
                        if ($invoice_item_insertion_status <= 0) {
                            $status = false;
                            break;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            if(!isset($status))
            $status=true;
            return $status;
        }
    }

    function list_invoice()
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }
            $query = "SELECT * FROM `invoice` ORDER BY invoice_id DESC";
            $queried = $connection->query($query);
            $list = $queried->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $list;
        }
    }

    function delete_invoice($invoice_id)
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }

            //delete invoice items first
            $invoice_items_delete = $connection->prepare("DELETE FROM `invoice_item` WHERE invoice_id=?");
            if (!$invoice_items_delete) {
                $status = false;
            }
            $invoice_items_delete->bind_param("i", $invoice_id);
            if (!$invoice_items_delete->execute()) {
                $status = false;
                throw new Exception();
            }
            //delete invoice now
            $invoice_delete = $connection->prepare("DELETE FROM `invoice` WHERE invoice_id=?");
            if (!$invoice_delete) {
                $status = false;
            }
            else{
            $invoice_delete->bind_param("i", $invoice_id);
            if (!$invoice_delete->execute()) {
                $status = false;
            }
            if ($invoice_items_delete && $invoice_delete)
                $status = true;
            else {
                $status = false;
            }
        }
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $status;
        }
    }

    function get_invoice($invoice_id)
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);
            $query = $connection->prepare("SELECT * FROM invoice WHERE invoice_id=?");
            if (!$query) {
                $status = false;
            }
            $query->bind_param("i", $invoice_id);
            if ($query->execute()) {
                $result = $query->get_result();
                $invoice_data = $result->fetch_assoc();
                $status = $invoice_data;
            } else {
                $status = false;
            }
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $status;
        }
    }


    function get_invoice_item($invoice_id)
    {
        try {
            $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }

            //delete invoice items first
            $invoice_items_get = $connection->prepare("SELECT * FROM `invoice_item` WHERE invoice_id=?");
            if (!$invoice_items_get) {
                $status = false;
            }
            $invoice_items_get->bind_param("i", $invoice_id);
            if ($invoice_items_get->execute()) {
                $invoice_items = $invoice_items_get->get_result();
                $status = $invoice_items->fetch_all();
            } else {
                $status = false;
            }
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            return $status;
        }
    }

    function edit_invoice(
        $invoice_id,
        $client_name,
        $client_company,
        $client_street,
        $client_city,
        $client_state,
        $client_country,
        $client_zip,
        $due_date,
        $desc,
        $hours,
        $hr_rate,
        $amount
    ) {
        $date_due_converted = date("Y-m-d H:i:s", strtotime($due_date));
        try {
            $connection = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);
            if ($connection->connect_error) {
                throw new Exception();
            }
            $update_invoice = $connection->prepare("UPDATE `invoice`  SET 
            `invoice_due_date`=?,
            `invoice_receiver_name`=?,
            invoice_receiver_company=?,
            invoice_receiver_street=?,
            invoice_receiver_city=?,
            invoice_receiver_state=?,
            invoice_receiver_country=?,
            invoice_receiver_zip=?
             WHERE invoice_id=?");
            //checking if statement is preparable
            if (!$update_invoice) {
                $status = false;
            }
            if (!$update_invoice->bind_param(
                "ssssssssi",
                $date_due_converted,
                $client_name,
                $client_company,
                $client_street,
                $client_city,
                $client_state,
                $client_country,
                $client_zip,
                $invoice_id
            )) {
                $status = false;
            };

            $invoice_updation_status = $update_invoice->execute();
            //if invoice data not updated return it
            if ($invoice_updation_status <= 0) {
                $status = false;
                throw new Exception();
            }
            else{
            //as number of items is changing so we have to delete previous ones and then insert new
            $invoice_items_delete = $connection->prepare("DELETE FROM `invoice_item` WHERE invoice_id=?");
            if (!$invoice_items_delete) {
                $status = false;
            }
            $invoice_items_delete->bind_param("i", $invoice_id);
            if (!$invoice_items_delete->execute()) {
                $status = false;
            }
            //now insert updated items
            for ($i = 0; $i < count($desc); $i++) {

                $insert_invoice_item = $connection->prepare("INSERT INTO `invoice_item` 
        (
            `invoice_id`,
            invoice_item_desc,
            invoice_item_hours,
            invoice_item_hr_rate,
            invoice_item_amount
        )
        VALUES
        (?,?,?,?,?)
        ");
                //returning false on failing statement preparation
                if (!$insert_invoice_item) {
                    $status = false;
                    throw new Exception();
                }
                $insert_invoice_item->bind_param(
                    "isiii",
                    $invoice_id,
                    $desc[$i],
                    $hours[$i],
                    $hr_rate[$i],
                    $amount[$i]
                );
                $invoice_item_insertion_status = $insert_invoice_item->execute();
                if ($invoice_item_insertion_status <= 0) {
                    $status = false;
                }
            }
        }
        } catch (Exception $e) {
            die("Something went Wrong while saving Invoice Data");
        } finally {
            $connection->close();
            if(!isset($status)){
                $status=true;
            }
            return $status;
        }
    }
}
