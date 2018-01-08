<?php

class MysqlConnection {

    static function connect() {
        $DB_NAME = "ppms";
        $DB_HOST = "localhost";
        $DB_USER = "root";
        $DB_PASS = "";
        return mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    }

    /**
     * @param input $query
     * @return primary key for the table
     */
    static function executeQuery($query) {
        $connect = MysqlConnection::connect();
        return mysqli_query($connect, $query);
    }

    /**
     * @param data
     * input the data for posted data
     * it automatically generate and insert the values
     * but name of the database colum must equal to name of the element field
     */
    static function insert($tbl = "", $data = array()) {
        try {
            $str = "";
            $keysset = "";
            $valuesset = "";
            foreach ($data as $key => $values) {
                $keysset .= "`" . $key . "`,";
                $valuesset .= "'" . trim($values) . "',";
            }
            $query = " INSERT INTO $tbl (" . substr($keysset, 0, strlen($keysset) - 1) . ") VALUES (" . substr($valuesset, 0, strlen($valuesset) - 1) . ");";
            MysqlConnection::executeQuery($query);
            return mysqli_insert_id();
        } catch (Exception $exc) {
            echo "<span style='color:red'>SQL QUERY ERROR !!! INSERT !!!<span>";
        }
    }

    /**
     * @param string $tbl table name
     * @param string $data array of the table
     * @return string boolean values
     */
    static function edit($tbl = "", $data = array(), $pkvalue) {
        unset($data[$pkcolumn]);
        try {
            $str = "";
            $update = "";
            foreach ($data as $key => $values) {
                $update .= "`" . $key . "` = " . "'" . trim($values) . "',";
            }
            $query = " UPDATE $tbl SET " . substr($update, 0, strlen($update) - 1) . " WHERE txtId = $pkvalue; ";
            return MysqlConnection::executeQuery($query);
        } catch (Exception $exc) {
            echo "<span style='color:red'>SQL QUERY ERROR !!! EDIT !!!<span>";
        }
    }

    /**
     *
     * @param String $tbl table name
     * @param int  $id primary key of the table
     */
    static function delete($tbl , $id ) {
        try {
            echo $query = "DELETE FROM $tbl where id = $id ";
            MysqlConnection::executeQuery($query);
        } catch (Exception $exc) {
            echo "<span style='color:red'>SQL QUERY ERROR !!! DELETE !!!<span>";
        }
    }

    /**
     * @param resource $resource
     * @return array
     */
    static function toArrays($resource) {
        $arrayList = array();
        while ($rows = mysqli_fetch_assoc($resource)) {
            array_push($arrayList, $rows);
        }
        return $arrayList;
    }

    /**
     * @param String $tbl
     * @param Array $sql
     * @return Array
     */
    static function fetchAll($tbl, $sql = array()) {
         $query = "SELECT * FROM $tbl ORDER BY id DESC";
        $resource = MysqlConnection::executeQuery($query);
        return MysqlConnection::toArrays($resource);
    }

    /**
     *
     * @param String $tbla
     * @param String $pkvalue
     * @return type
     */
    static function fetchByPrimary($tbl, $pkvalue, $pkcolumn) {
        $query = "SELECT * FROM $tbl WHERE $pkcolumn = $pkvalue  ";
        $resource = MysqlConnection::executeQuery($query);
        $result = MysqlConnection::toArrays($resource);
        return $result[0];
    }

    /**
     *
     * @param String $tbl table name a
     * @param Array $data data posted from text field
     * @param Array $sql condition such as limit order by
     * @return Aray
     */
    static function fetchByFilter($tbl, $data = array(), $sql = array()) {
        $str = "";
        $srno = 1;
        foreach ($data as $kyes => $values) {
            if (trim($values) != "") {
                $str .= " `$kyes` LIKE '%$values%' AND ";
                $srno++;
            }
        }
        $search = "AND";
        if (( $pos = strrpos($str, $search) ) !== false) {
            $search_length = strlen($search);
            $str = " AND " . substr_replace($str, "", $pos, $search_length);
        }
        $query = "SELECT * FROM   $tbl   WHERE txtIsDelete = '0' " . $str . "" . $sql["order"] . "" . $sql["limit"] . "";
        $resource = MysqlConnection::executeQuery($query);
        return MysqlConnection::toArrays($resource);
    }

    static function fetchCustom($query) {
        $resource = MysqlConnection::executeQuery($query);
        return MysqlConnection::toArrays($resource);
    }

    static function exchangeArray($POST, $unset_array = array()) {
        foreach ($unset_array as $keys) {
            unset($POST[$keys]);
        }
        return $POST;
    }

    static function uploadFile($objfile, $destination) {
        $modifiedName = str_replace(" ", "_", $objfile["name"]);
        $fname = $destination . time() . "_" . $modifiedName;
        move_uploaded_file($objfile["tmp_name"], $fname);
        return empty($objfile["name"]) ? "" : $fname;
    }

    static function readFile($file_name) {
        $handle = fopen($file_name, 'rb') or die("error opening file");
        $contains = fread($handle, filesize($file_name));
        fclose($handle) or die("error closing file handle");
        return $contains;
    }

}
