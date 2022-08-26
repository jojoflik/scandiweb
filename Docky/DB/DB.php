<?php

namespace Docky\DB;

class DB {

  public function __init($host,$user,$password,$name){

    $conn = mysqli_connect($host,$user,$password,$name);

    if ($conn){

      $this->db = $conn;

      return $conn;

    }else{

      die("DB: Error!(Connect)");

    }

  }

  public function query($query){

    $query = mysqli_query($this->db, $query);

    if ($query){

      return $query;

    }else{

      die("DB: Error!(Query)");

    }

  }

}

$DB = new DB;

$DB->__init("localhost","root","","scandiweb");

