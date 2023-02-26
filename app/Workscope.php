<?php

require_once("Database.php");

class Workscope extends Database
{

    public function create_workscope(
        $client_name,
        $client_company,
        $client_city,
        $total_cost,
        $initialAmt_percent,
        $work_scope,
        $work_notes,
        $user_id
    ) {
        $workscope_date = date("Y-m-d H:i:s");
        try {
            $query = 'INSERT INTO workscope (workscope_client,workscope_company,workscope_city,workscope_totalCost,workscope_initialAmtPercent,workscope_scope,workscope_notes,`user_id`,workscope_date)
        VALUES(?,?,?,?,?,?,?,?,?)';
            $this->prepare_query($query);
            $work_scope = $this->content_resolution($work_scope);
            $work_notes = $this->content_resolution($work_notes);
            $this->stmt->bind_param(
                'sssiissis',
                $client_name,
                $client_company,
                $client_city,
                $total_cost,
                $initialAmt_percent,
                $work_scope,
                $work_notes,
                $user_id,
                $workscope_date
            );
            $this->execute_query('i');
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            $this->set_modifiedOrEdited_id($this->connection->insert_id);
            return $this->status;
        }
    }

    public function edit_workscope(
        $workscope_id,
        $client_name,
        $client_company,
        $client_city,
        $total_cost,
        $initialAmt_percent,
        $work_scope,
        $work_notes,
        $user_id
    ) {
        try {
            $query = "UPDATE workscope SET workscope_client=?,workscope_company=?,workscope_city=?,workscope_totalCost=?,workscope_initialAmtPercent=?,workscope_scope=?,workscope_notes=?,`user_id`=? WHERE workscope_id=?";
            $this->prepare_query($query);
            $work_scope = $this->content_resolution($work_scope);
            $work_notes = $this->content_resolution($work_notes);
            $this->stmt->bind_param(
                'sssiissii',
                $client_name,
                $client_company,
                $client_city,
                $total_cost,
                $initialAmt_percent,
                $work_scope,
                $work_notes,
                $user_id,
                $workscope_id
            );
            $this->execute_query('u');
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            $this->set_modifiedOrEdited_id($workscope_id);
            return $this->status;
        }
    }
}
