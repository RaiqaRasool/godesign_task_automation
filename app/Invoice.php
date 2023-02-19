<?php
require_once("Database.php");

class Invoice extends Database
{
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
        $amount,
        $invoice_currency
    ) {
        $date_due_converted = $this->date_resolution($due_date);
        try {
            $query = "INSERT INTO `invoice` (
                `user_id`,
                `invoice_due_date`,
                `invoice_receiver_name`,
                invoice_receiver_company,
                invoice_receiver_street,
                invoice_receiver_city,
                invoice_receiver_state,
                invoice_receiver_country,
                invoice_receiver_zip,
                invoice_currency
                )  
            VALUES(
                 ?,?,?,?,?,?,?,?,?,?
            )";
            $this->prepare_query($query);
            $this->stmt->bind_param(
                "isssssssss",
                $_SESSION['user_id'],
                $date_due_converted,
                $client_name,
                $client_company,
                $client_street,
                $client_city,
                $client_state,
                $client_country,
                $client_zip,
                $invoice_currency
            );
            $this->execute_query('i');
            $invoice_id = $this->connection->insert_id;

            //if invoice data inserted only then insert invoice items
            if ($this->status) {

                for ($i = 0; $i < count($desc); $i++) {
                    $query = "INSERT INTO `invoice_item` 
                            (
                                `invoice_id`,
                                invoice_item_desc,
                                invoice_item_hours,
                                invoice_item_hr_rate,
                                invoice_item_amount
                            )
                            VALUES
                            (?,?,?,?,?)
                            ";
                    $this->prepare_query($query);
                    //returning false on failing statement preparation
                    if (!$this->status) {
                        break;
                    }
                    $this->stmt->bind_param(
                        "isiii",
                        $invoice_id,
                        $desc[$i],
                        $hours[$i],
                        $hr_rate[$i],
                        $amount[$i]
                    );
                    $this->execute_query('i');
                    if (!$this->status) {
                        break;
                    }
                }
            }
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            return $this->status;
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
        $amount,
        $invoice_currency
    ) {
        try {
            $date_due_converted = $this->date_resolution($due_date);
            $query = "UPDATE `invoice`  SET 
            `invoice_due_date`=?,
            `invoice_receiver_name`=?,
            invoice_receiver_company=?,
            invoice_receiver_street=?,
            invoice_receiver_city=?,
            invoice_receiver_state=?,
            invoice_receiver_country=?,
            invoice_receiver_zip=?,
            invoice_currency=?
             WHERE invoice_id=?";
            $this->prepare_query($query);
            $this->stmt->bind_param(
                "ssssssssis",
                $date_due_converted,
                $client_name,
                $client_company,
                $client_street,
                $client_city,
                $client_state,
                $client_country,
                $client_zip,
                $invoice_id,
                $invoice_currency
            );
            $this->execute_query('u');
            //if invoice data updated only then insert invoice items
            if ($this->status) {
                //as number of items is changing so we have to delete previous ones and then insert new
                $this->delete_by_single_condition('invoice_item', 'invoice_id', $invoice_id);
                if ($this->status) {
                    //now insert updated items
                    for ($i = 0; $i < count($desc); $i++) {

                        $query = "INSERT INTO `invoice_item` 
                                        (
                                            `invoice_id`,
                                            invoice_item_desc,
                                            invoice_item_hours,
                                            invoice_item_hr_rate,
                                            invoice_item_amount
                                        )
                                        VALUES
                                        (?,?,?,?,?)
                                        ";
                        $this->prepare_query($query);
                        $this->stmt->bind_param(
                            "isiii",
                            $invoice_id,
                            $desc[$i],
                            $hours[$i],
                            $hr_rate[$i],
                            $amount[$i]
                        );
                        $this->execute_query('i');
                        if (!$this->status) {
                            break;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            return $this->status;
        }
    }
}
