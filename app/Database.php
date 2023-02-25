<?php
require_once("config.php");

class Database
{
    protected $dbhost;
    protected $dbuser;
    protected $dbpass;
    protected $dbname;
    protected $connection;
    protected $stmt;
    protected $status;
    protected $modifiedOrEdited_id; #will be used for redirecting to pdf on success with id

    function __construct()
    {
        $this->dbhost = DB_HOST;
        $this->dbuser = DB_USER;
        $this->dbpass = DB_PWD;
        $this->dbname = DB_NAME;
    }

    //------------------------------------------------------
    //                 utility functions
    //------------------------------------------------------

    protected function open_connection()
    {
        if (!$this->connection) {
            $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if ($this->connection->connect_error) {
                die("Something went wrong while making connection to DB");
            }
        }
    }
    protected function prepare_query($query)
    {
        $this->open_connection();
        $this->stmt = $this->connection->prepare($query);
        if (!$this->stmt) {
            $this->status = false;
            return;
        } else {
            $this->status = true;
        }
    }

    function close_connection() //have to make it public for search_by_id external closure
    {
        // if ($this->connection->ping())
        //     $this->connection->close();
    }

    protected function check_type($var)
    {
        if (gettype($var) == "string") {
            return 's';
        } else {
            return 'i';
        }
    }
    protected function content_resolution($content)
    {
        $content = $this->connection->real_escape_string(htmlspecialchars($content));
        return $content;
    }
    //$mode=
    //'i' for insert
    //'u' for update
    //'d' for delete
    //'s' for select
    protected function execute_query($mode)
    {
        if (!$this->stmt->execute()) {
            $this->status = false;
            return;
        } else {
            if (($mode == 'i' || $mode == 'd') && $this->connection->affected_rows == 0) {
                $this->status = false;
                return;
            } else if ($mode == 's') {
                $result = $this->stmt->get_result();
                $data = $result->fetch_assoc();
                $this->status = true;
                return is_null($data) ? array() : $data;
            } else {
                $this->status = true;
            }
        }
    }


    function content_preparation($content)
    {
        $content = str_replace('\r\n', '', $content);
        return $content;
    }

    protected function date_resolution($date)
    {
        $date_converted = date("Y-m-d H:i:s", strtotime($date));
        return $date_converted;
    }
    //for html forms date -- have that format
    protected function date_to_str($date)
    {
        return date('Y-m-d', $date);
    }

    //------------------------------------------------------
    //                  public functions
    //------------------------------------------------------

    public function delete_item($table, $id_name, $id)
    {
        $query = "DELETE FROM $table WHERE $id_name=?";
        try {
            $this->prepare_query($query);
            $this->stmt->bind_param('i', $id);
            $this->execute_query('d');
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            $this->close_connection();
            return $this->status;
        }
    }
    //have to apply close connection everytime whenever search_by_id is used
    // using close connection inside it is causing issue while using it within 
    // functions as in delete_item
    public function search_by_id($table, $id_name, $id) //id here means anything which is unique
    {
        $type = $this->check_type($id);
        $query = "SELECT * FROM $table WHERE $id_name=?";
        try {
            $this->prepare_query($query);
            $this->stmt->bind_param($type, $id);
            $this->status = $this->execute_query('s');
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            return $this->status;
        }
    }
    public function list_all($table)
    {
        $query = "SELECT * FROM $table";
        $this->open_connection();
        $result = $this->connection->query($query);
        $data = $result->fetch_all();
        return $data;
    }
    //don't write e at the end of operation if you want to have correct msg
    public function status_msg_withRedirect($status, $op, $doc_type, $id)
    {
        $root_path = explode('/', $_SERVER['DOCUMENT_ROOT'])[0];
        if ($status == true) {
            header("Location:" . $root_path . "/pdf_templates//" . strtolower($doc_type) . '_pdf.php?mode=p&id=' . $id);
        } else {
            echo '<div class="alert alert-danger">Some issue occured while
           ' . $op . 'ing ' . $doc_type . '.' . '
            </div>';
        }
    }
    public function status_msg($status, $op, $doc_type)
    {
        if ($status == true) {
            echo '<div class="alert alert-success" role="alert">
            ' . $op . 'ed ' . $doc_type . ' successfully!
            </div>';
        } else {
            echo '<div class="alert alert-danger">Some issue occured while
           ' . $op . 'ing ' . $doc_type . '.' . '
            </div>';
        }
    }

    public function search_by_single_condition($table, $condition_name, $condition_value)
    {
        $query = "SELECT * FROM $table WHERE $condition_name=?";
        $type = $this->check_type($condition_value);
        $this->prepare_query($query);
        $this->stmt->bind_param($type, $condition_value);
        $this->execute_query('a');
        $result = $this->stmt->get_result();
        $data = $result->fetch_all();
        $this->status = (count($data) == 0) ? array() : $data;
        $this->close_connection();
        return $this->status;
    }


    public function delete_by_single_condition($table, $condition_name, $condition_value)
    {
        try {
            $query = "DELETE FROM $table WHERE $condition_name=?";
            $this->prepare_query($query);
            $this->stmt->bind_param($this->check_type($condition_value), $condition_value);
            $this->execute_query('d');
        } catch (Exception $e) {
            $this->status = false;
        } finally {
            return $this->status;
        }
    }

    protected function set_modifiedOrEdited_id($id)
    {
        if ($this->status) {
            $this->modifiedOrEdited_id = $id;
        } else {
            unset($this->modifiedOrEdited_id);
        }
    }
    public function get_modifiedOrEdited_id()
    {
        return $this->modifiedOrEdited_id;
    }
}
