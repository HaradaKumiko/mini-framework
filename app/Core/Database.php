<?php

class Database{

  private static $INSTANCE = null;
  private $mysqli,
          $HOST = 'localhost',
          $USER = 'root',
          $PASS = '',
          $DEBE = 'auth';


  public function __construct()
  {
    $this->mysqli = new mysqli ( $this->HOST, $this->USER, $this->PASS, $this->DEBE );
    if(mysqli_connect_error()){
      die('Koneksi ke Database gagal !');
    }
  }


  //singleton pattern, menguji agar koneksi tidak double
  public static function getInstance()
  {
    if( !isset(self::$INSTANCE) ){
      self::$INSTANCE = new Database();
    }
    return self::$INSTANCE;
  }


  public function insert($table, $fields = array() )
  {

    //mengambil column
    $column = implode(", ", array_keys($fields) );

    //mengambil nilai
    $valueArrays = array();
      $i = 0;
    foreach ($fields as $key => $values) {
      if( is_int($values) ){
        $valueArrays[$i] = $this->escape($values);
      }else{
        $valueArrays[$i] = "'" . $this->escape($values) . "'";
        $i++;
      }
    }
    $values = implode(", ", $valueArrays);

    $query = "INSERT INTO $table ($column) VALUES ($values)";

    return $this->run_query($query, 'masalah saat memasukkan data ke database');
  }

  public function get_info($table, $column = '', $value = '')
  {
    if( !is_int($value) ) $value = "'" . $value . "'";

    if($column != '')
    {
      $query = "SELECT * FROM $table WHERE $column = $value";
      $result = $this->mysqli->query($query);
      while($row = $result->fetch_assoc()){
          return $row;
        }
    }else{
      $query = "SELECT * FROM $table";
      $result = $this->mysqli->query($query);
      while($row = $result->fetch_assoc()){
            $results[] = $row;
        }
        return $results;
    }
  }

  public function update($table, $fields, $id)
  {
    //mengambil nilai
    $valueArrays = array();
      $i = 0;
    foreach ($fields as $key => $values) {
      if( is_int($values) ){
        $valueArrays[$i] = $key . "=" . $this->escape($values);
      }else{
        $valueArrays[$i] =  $key . "='" . $this->escape($values) . "'";
        $i++;
      }
    }
    $values = implode(", ", $valueArrays);

    $query = "UPDATE $table SET $values WHERE id = $id";

    return $this->run_query($query, 'masalah saat mengupdate data ke database');
  }


  public function run_query($query, $msg)
  {
    if($this->mysqli->query($query)) return true;
    else die($msg);
  }

  public function escape($name)
  {
    return $this->mysqli->real_escape_string(htmlspecialchars($name));
  }




}
?>
