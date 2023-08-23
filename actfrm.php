<?php

include("../../configuration.php");
include("../../connection.php");
include("../../endec.php");

// Action input php
if(isset($_POST['intxtmode'])){
  $intxtmode = $_POST['intxtmode'];
}
if(isset($_POST['inkdjenis'])){
  $inkdjenis = strtoupper(htmlspecialchars($_POST['inkdjenis']));
}
if(isset($_POST['innmjenis'])){
  $innmjenis = strtoupper(htmlspecialchars($_POST['innmjenis']));
}

function cekKdjenis($inkdjenis,$conn){
  $sqlkdjenis = "SELECT COUNT(kdjenis) AS numRow FROM kmjeniskulit WHERE kdjenis = '".$inkdjenis."'";
  $kdjenis = mysql_query($sqlkdjenis,$conn);
  $numRow = mysql_result($kdjenis,0);

  if($numRow > 0) {
    return "Kode Sudah Ada !";
  }
  else{
    return "OK";
  }
}

if($intxtmode=='add'){
  $cekKdjenis = cekKdjenis($inkdjenis,$conn);
  if ($cekKdjenis == "OK") {
    $sqlINSERT="INSERT into kmjeniskulit (
                kdjenis
                ,nmjenis
                ,access
                ,komp
                ,userby
                ) VALUES (
                '".$inkdjenis."' 
                ,'".$innmjenis."' 
                ,now()
                ,'".$_SESSION[$domainApp."_mygroup"]." # ".$_SESSION[$domainApp."_mylevel"]."' 
                ,'".$_SESSION[$domainApp."_myname"]."'
                )";

    if (!mysql_query($sqlINSERT,$conn)){
      die('Error: ' . mysql_error());
    }

    echo "OK";
  }
  else{
    echo "<span id='status-not-available' class='status-not-available'> Kode Sudah Ada !</span>";
  }
}
elseif($intxtmode=='edit'){
  $sqlUPDATE="UPDATE kmjeniskulit SET
              kdjenis = '".$inkdjenis."' 
              ,nmjenis = '".$innmjenis."'
              ,access = now()
              ,komp = '".$_SESSION[$domainApp."_mygroup"]." # ".$_SESSION[$domainApp."_mylevel"]."' 
              ,userby = '".$_SESSION[$domainApp."_myname"]."'
              where
              kdjenis = '".$inkdjenis."'
              ";

  if (!mysql_query($sqlUPDATE,$conn)){
    die('Error: ' . mysql_error());
  }
  echo "Data berhasil diubah";
}
elseif($intxtmode=='delete'){
  mysql_query("SET @user_id='".$_SESSION[$domainApp."_myname"]."'");
  $sqlDELETE="DELETE FROM kmjeniskulit WHERE kdjenis = '".$inkdjenis."' ";
    //execute query
  if (!mysql_query($sqlDELETE,$conn))
  {
    die('Error: ' . mysql_error());
  }
  // echo "Data berhasil dihapus";
}
elseif($intxtmode=='getedit'){
  $sql="SELECT
        kdjenis
        ,nmjenis
        FROM
        kmjeniskulit
        WHERE kdjenis = '".$inkdjenis."' ";

  $result=mysql_query($sql,$conn);
  while ($data = mysql_fetch_array($result, MYSQL_BOTH)){
    echo "<span id='getkdjenis'>".$data['kdjenis']."</span>";
    echo "<span id='getnmjenis'>".$data['nmjenis']."</span>";
  }
  mysql_free_result($result);
}


// close connection !!!!
mysql_close($conn)


?>