<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function getRowById($table, $primary_key, $primary_key_value, $where = "") {
        $sql = "SELECT * FROM " . $table . " WHERE " . $primary_key . "='" . $primary_key_value . "' " . $where;
        $query = $this->db->query($sql);
        $data = $query->result();
        if ($data) {
            return $data[0];
        }
        return false;
    }    

    public function getColumnValue($column_name, $table, $primary_key, $primary_key_value, $where = "") {
        if (is_int($primary_key_value)) {
            $sql = "SELECT " . $column_name . " FROM " . $table . " WHERE " . $primary_key . "=" . $primary_key_value . " " . $where;
        } else {
            $sql = "SELECT " . $column_name . " FROM " . $table . " WHERE " . $primary_key . "='" . $primary_key_value . "' " . $where;
        }

        $query = $this->db->query($sql);
        $data = $query->result();
        if ($data) {
            return $data[0]->$column_name;
        } else {
            return false;
        }
    }

    public function getAllData($table, $where = "") {
        if ($where != "") {
            $sql = "SELECT * FROM " . $table . " WHERE " . $where;
            $query = $this->db->query($sql);
        } else {
            $query = $this->db->get($table);
        }
        $result = $query->result();
        if ($result) {
            return $result;
        }
        return array();
    }

    public function getUserListByDeptId($dept, $where="") {
        $sql = "SELECT user_id FROM users WHERE department_id=" . $dept." ".$where;
        $query = $this->db->query($sql);
        $result = $query->result();
        if ($result) {
            return $result;
        }
        return array();
    }
    public function getUserListByDeptIdAllColumn($dept, $where="") {
        $sql = "SELECT * FROM users WHERE department_id=" . $dept." ".$where;
        $query = $this->db->query($sql);
        $result = $query->result();
        if ($result) {
            return $result;
        }
        return array();
    } 

    public function getListData($array, $key_field, $value_field) {
        $list_array = array();
        if ($array) {
            foreach ($array as $row) {
                $list_array[$row->$key_field] = $row->$value_field;
            }
        }
        return $list_array;
    }

    public function deleteRow($table, $primary_key, $value) {
        $this->db->delete($table, array($primary_key => $value));
        return "deleted successfully";
    }
}
