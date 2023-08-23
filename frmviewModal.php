<?php
include("../../connection.php");
include("../../endec.php");
include("actsearch.php");

if (isset($_POST['dnoso'])) {
  $dnoso = $_POST['dnoso'];
}
  if (isset($_POST['dkdbrg'])) {
  $dkdbrg = $_POST['dkdbrg'];
}

if(isset($_POST['txtpagemodal'])){
  $txtpage = $_POST['txtpagemodal'];
  $showPage = $txtpage;
  $noPage = $txtpage;
}
else{
  $txtpage = 1;
  $showPage = $txtpage;
  $noPage = $txtpage;
}

if(isset($_POST['txtperpagemodal'])){
  $txtperpage=$_POST['txtperpagemodal'];
}
else{
  $txtperpage=15;
}

$offset = ($txtpage - 1) * $txtperpage;
$sqlLIMIT = " LIMIT $offset, $txtperpage";
$sqlWHERE = " ";

if(isset($_POST['txtdatamodal'])){
  if ($_POST['txtdatamodal']!=''){
    $txtdata=$_POST['txtdatamodal'];
  }
}

if(isset($_POST['txtfield'])){
  if ($_POST['txtfield']!=''){
    $txtfield = $_POST['txtfield'];
  }
}


if($_POST['txtfield']!='' && $_POST['txtdatamodal'] !=''){

  $like_data = getsearchdata('kmsoh ',$txtfield,$txtdata);

  if(rtrim($like_data,'|') != ''){
    $datalike = php_permutasi(explode("|",rtrim($like_data,'|')));

    $arr_like = explode("|",rtrim($datalike,'|'));

    foreach ($arr_like as $value) {
      $where .= " ".$txtfield." like '%".$value."%' or ";
    }

    $sqlWHERE = $sqlWHERE." and (".rtrim($where,' or ')." ) ";

  }else{
    $sqlWHERE = $sqlWHERE." and ".$txtfield." like '%".$txtdata."%' ";
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Form View</title>
</head>

<?php
$xrdm = date("YmdHis");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css?verion=$xrdm\" />";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/frmstyle.css?version=$xrdm\" />";
?>
<!-- script type="text/javascript" src="js/jquery-latest.js"></script> -->
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#myTableModal").tablesorter();
  }
  );
</script>

<body>
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div id="frmisi">
          <table id="myTableModal1" class="table">
            <thead>
              <tr>
                <th align="center" width='15%'>Keterangan</th>
                <th align="center" width='3%'>33</th>
                <th align="center" width='3%'>33s</th>
                <th align="center" width='3%'>34</th>
                <th align="center" width='3%'>34s</th>
                <th align="center" width='3%'>35</th>
                <th align="center" width='3%'>35s</th>
                <th align="center" width='3%'>36</th>
                <th align="center" width='3%'>36s</th>
                <th align="center" width='3%'>37</th>
                <th align="center" width='3%'>37s</th>
                <th align="center" width='3%'>38</th>
                <th align="center" width='3%'>38s</th>
                <th align="center" width='3%'>39</th>
                <th align="center" width='3%'>39s</th>
                <th align="center" width='3%'>40</th>
                <th align="center" width='3%'>40s</th>
                <th align="center" width='3%'>41</th>
                <th align="center" width='3%'>41s</th>
                <th align="center" width='3%'>42</th>
                <th align="center" width='3%'>42s</th>
                <th align="center" width='3%'>43</th>
                <th align="center" width='3%'>43s</th>
                <th align="center" width='3%'>44</th>
                <th align="center" width='3%'>44s</th>
                <th align="center" width='11%'>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM kmsod a WHERE a.dnoso = '".$dnoso."' AND a.dkdbrg = '".$dkdbrg."'";
                $result = mysql_query($sql,$conn);

                while ($data =  mysql_fetch_array($result)) {
                  $dord33 = $data["dord33"];
                  $dord33s = $data["dord33s"];
                  $dord34 = $data["dord34"];
                  $dord34s = $data["dord34s"];
                  $dord35 = $data["dord35"];
                  $dord35s = $data["dord35s"];
                  $dord36 = $data["dord36"];
                  $dord36s = $data["dord36s"];
                  $dord37 = $data["dord37"];
                  $dord37s = $data["dord37s"];
                  $dord38 = $data["dord38"];
                  $dord38s = $data["dord38s"];
                  $dord39 = $data["dord39"];
                  $dord39s = $data["dord39s"];
                  $dord40 = $data["dord40"];
                  $dord40s = $data["dord40s"];
                  $dord41 = $data["dord41"];
                  $dord41s = $data["dord41s"];
                  $dord42 = $data["dord42"];
                  $dord42s = $data["dord42s"];
                  $dord43 = $data["dord43"];
                  $dord43s = $data["dord43s"];
                  $dord44 = $data["dord44"];
                  $dord44s = $data["dord44s"];
                }

                echo($sql);

              ?>

                  <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" style="margin: 0px; background-color: #89c4f4;">
                    <td align="center" nowrap>Sales Order</td>
                    <td align="center" nowrap><?=$dord33?></td>
                    <td align="center" nowrap><?=$dord33s?></td>
                    <td align="center" nowrap><?=$dord34?></td>
                    <td align="center" nowrap><?=$dord34s?></td>
                    <td align="center" nowrap><?=$dord35?></td>
                    <td align="center" nowrap><?=$dord35s?></td>
                    <td align="center" nowrap><?=$dord36?></td>
                    <td align="center" nowrap><?=$dord36s?></td>
                    <td align="center" nowrap><?=$dord37?></td>
                    <td align="center" nowrap><?=$dord37s?></td>
                    <td align="center" nowrap><?=$dord38?></td>
                    <td align="center" nowrap><?=$dord38s?></td>
                    <td align="center" nowrap><?=$dord39?></td>
                    <td align="center" nowrap><?=$dord39s?></td>
                    <td align="center" nowrap><?=$dord40?></td>
                    <td align="center" nowrap><?=$dord40s?></td>
                    <td align="center" nowrap><?=$dord41?></td>
                    <td align="center" nowrap><?=$dord41s?></td>
                    <td align="center" nowrap><?=$dord42?></td>
                    <td align="center" nowrap><?=$dord42s?></td>
                    <td align="center" nowrap><?=$dord43?></td>
                    <td align="center" nowrap><?=$dord43s?></td>
                    <td align="center" nowrap><?=$dord44?></td>
                    <td align="center" nowrap><?=$dord44s?></td>
                  </tr>
                  <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" style="margin: 0px; background-color: #87d37c;">
                    <td align="center" nowrap>Output Produksi</td>
                  </tr>
                  <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" style="margin: 0px; background-color: #fef160;">
                    <td align="center" nowrap>Gudang Jadi</td>
                  </tr>
                  <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" style="margin: 0px; background-color: #87d37c;">
                    <td align="center" nowrap>Shipment</td>
                  </tr>

                  <?php
              //   }
              //   mysql_free_result($result);
              // }
              ?>
            </tbody>
          </table>
        </div>
      </td>
    </tr>
  </tr>
  <tr>
    <td>
      &nbsp;
    </td>
  </tr>
  <tr>
    <td>
      &nbsp;
    </td>
  </tr>
  <tr>
    <td>
      &nbsp;
    </td>
  </tr>
</table>
</body>

</html>
<?php
mysql_close($conn);
unset($_POST['inid']);
?>
