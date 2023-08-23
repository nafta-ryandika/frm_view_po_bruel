<?php
  include("../../configuration.php");
  include("../../connection.php");
  include("../../endec.php");

  //Class For Pdf
  require('../../mpdf/mpdf.php');

  //Cek Get Data
  if(isset($_POST['nmSQL'])){
    $txtSQL = $_POST['nmSQL'];
  }else{
    $txtSQL = "";
  }

  if(isset($_POST['nmField'])){
    $nmField = strtoupper($_POST['nmField']);
  }
  if(isset($_POST['nmParameter'])){
    $nmParameter = $_POST['nmParameter'];
  }
  if(isset($_POST['nmData'])){
    $nmData = strtoupper($_POST['nmData']);
  }

  $nmField = explode("|", $nmField);
  $nmParameter = explode("|", $nmParameter);
  $nmData = explode("|", $nmData);
  $count = count($nmField);

  $xname = $_SESSION[$domainApp."_myname"];
  $xgroup = $_SESSION[$domainApp."_mygroup"];
  date_default_timezone_set("Asia/Bangkok");
  $today = date("d/m/Y H:i:s");

  $header .=   "<img src='img/logokmbs.jpg' style='height: 5%;'></img><br/>
               <b style='font-size: 15px;'>PT KARYAMITRA BUDISENTOSA</b><br/>
               <b style='font-size: 10px;'>LAPORAN CHECK PO, SO, dan MP</b><br/><br/>
              ";

  if ($count == 1) {
    $parameter = $nmParameter[0];
    if ($parameter == 'equal') {
      $parameter = '=';
    }

    if ($parameter == 'notequal') {
      $parameter = '<>';
    }

    if ($parameter == 'less') {
      $parameter = '<';
    }

    if ($parameter == 'lessorequal') {
      $parameter = '<=';
    }

    if ($parameter == 'greater') {
      $parameter = '>';
    }

    if ($parameter == 'greaterorequal') {
      $parameter = '>=';
    }    

    $field = $nmField[0];
    if ($field == 'A.SLNOPO') {
      $field = 'No. PO';
    }
    else if ($field == 'A.SLNOSO') {
      $field = 'No. SO';
    }
    else if ($field == 'RNOMP') {
      $field = 'No. MP';
    }

    $data = $nmData[0];

    if ($field != '' && $parameter != '' && $data != '') {
     $header .= $field.' '.$parameter.' '.$data.'<br/>';
    }
  }
  else{
    for ($i=0; $i < $count-1 ; $i++) {
      $parameter = $nmParameter[$i];
      if ($parameter == 'equal') {
        $parameter = '=';
      }

      if ($parameter == 'notequal') {
        $parameter = '<>';
      }

      if ($parameter == 'less') {
        $parameter = '<';
      }

      if ($parameter == 'lessorequal') {
        $parameter = '<=';
      }

      if ($parameter == 'greater') {
        $parameter = '>';
      }

      if ($parameter == 'greaterorequal') {
        $parameter = '>=';
      }    

      $field = $nmField[$i];
      if ($field == 'A.SLNOPO') {
        $field = 'No. PO';
      }
      else if ($field == 'A.SLNOSO') {
        $field = 'No. SO';
      }
      else if ($field == 'RNOMP') {
        $field = 'No. MP';
      }

      $data = $nmData[$i];

      if ($field != '' && $parameter != '' && $data != '') {
        $header .= $field.' '.$parameter.' '.$data.'<br/>';
      }
    }
  }

  $content .= "<table id='myTable' class='table'>
                <thead>
                  <tr>
                    <th align='center' width='3%'>No</th>
                    <th align='center' width='11%'>No. Sales Order</th>
                    <th align='center' width='12%'>Kode Barang Jadi</th>
                    <th align='center' width='7%'>No. MP</th>
                    <th align='center' width='2.5%'>33</th>
                    <th align='center' width='2.5%'>33s</th>
                    <th align='center' width='2.5%'>34</th>
                    <th align='center' width='2.5%'>34s</th>
                    <th align='center' width='2.5%'>35</th>
                    <th align='center' width='2.5%'>35s</th>
                    <th align='center' width='2.5%'>36</th>
                    <th align='center' width='2.5%'>36s</th>
                    <th align='center' width='2.5%'>37</th>
                    <th align='center' width='2.5%'>37s</th>
                    <th align='center' width='2.5%'>38</th>
                    <th align='center' width='2.5%'>38s</th>
                    <th align='center' width='2.5%'>39</th>
                    <th align='center' width='2.5%'>39s</th>
                    <th align='center' width='2.5%'>40</th>
                    <th align='center' width='2.5%'>40s</th>
                    <th align='center' width='2.5%'>41</th>
                    <th align='center' width='2.5%'>41s</th>
                    <th align='center' width='2.5%'>42</th>
                    <th align='center' width='2.5%'>42s</th>
                    <th align='center' width='2.5%'>43</th>
                    <th align='center' width='2.5%'>43s</th>
                    <th align='center' width='2.5%'>44</th>
                    <th align='center' width='2.5%'>44s</th>
                    <th align='center' width='7%'>Status</th>
                  </tr>
                </thead>
                <tbody>";

  $row = 0;
  $result = mysql_query($txtSQL,$conn);
  while ($data = mysql_fetch_array($result)){
    $row += 1;
    $slnoso = $data["slnoso"];
    $rkdbrgjd = $data["rkdbrgjd"];
    $rnomp = $data["rnomp"];

    $sql_1 = "select * from kmsod a where a.dnoso = '".$slnoso."'";
    $result_1 = mysql_query($sql_1,$conn);
    $data_1 = mysql_fetch_array($result_1);

    $dord33 = $data_1["dord33"];
    $dord34 = $data_1["dord34"];
    $dord35 = $data_1["dord35"];
    $dord36 = $data_1["dord36"];
    $dord37 = $data_1["dord37"];
    $dord38 = $data_1["dord38"];
    $dord39 = $data_1["dord39"];
    $dord40 = $data_1["dord40"];
    $dord41 = $data_1["dord41"];
    $dord42 = $data_1["dord42"];
    $dord43 = $data_1["dord43"];
    $dord44 = $data_1["dord44"];


    $dord33s = $data_1["dord33s"];
    $dord34s = $data_1["dord34s"];
    $dord35s = $data_1["dord35s"];
    $dord36s = $data_1["dord36s"];
    $dord37s = $data_1["dord37s"];
    $dord38s = $data_1["dord38s"];
    $dord39s = $data_1["dord39s"];
    $dord40s = $data_1["dord40s"];
    $dord41s = $data_1["dord41s"];
    $dord42s = $data_1["dord42s"];
    $dord43s = $data_1["dord43s"];
    $dord44s = $data_1["dord44s"];

    $sql_2 = "select * from clmpdet3 a where a.mpno = '".$rnomp."' and kdbrg = '".$rkdbrgjd."'";
    $result_2 = mysql_query($sql_2,$conn);
    $data_2 = mysql_fetch_array($result_2);

    $d33 = $data_2["d33"];
    $d34 = $data_2["d34"];
    $d35 = $data_2["d35"];
    $d36 = $data_2["d36"];
    $d37 = $data_2["d37"];
    $d38 = $data_2["d38"];
    $d39 = $data_2["d39"];
    $d40 = $data_2["d40"];
    $d41 = $data_2["d41"];
    $d42 = $data_2["d42"];
    $d43 = $data_2["d43"];
    $d44 = $data_2["d44"];

    $d33s = $data_2["d33s"];
    $d34s = $data_2["d34s"];
    $d35s = $data_2["d35s"];
    $d36s = $data_2["d36s"];
    $d37s = $data_2["d37s"];
    $d38s = $data_2["d38s"];
    $d39s = $data_2["d39s"];
    $d40s = $data_2["d40s"];
    $d41s = $data_2["d41s"];
    $d42s = $data_2["d42s"];
    $d43s = $data_2["d43s"];
    $d44s = $data_2["d44s"];

    $status = 0;

    for ($i=32; $i < 44 ; $i++) { 
      if ($data_2[d.$i] != $data_1[dord.$i]) {
      $status = 1;
      break;
      }
      else if ($data_2[d.$i.s] != $data_1[dord.$i.s]) {
      $status = 1;
      break;
      }
    }

    if ($status == 1) {
      $status = "CHECK";
    }
    else{
      $status = "OK";
    }
    
    $content .= "<tr>
                  <td rowspan='2' align='center'>
                    ".$row."
                  </td>
                  <td rowspan='2' style='text-align: left;'>
                    ".$slnoso."
                  </td>
                  <td rowspan='2' style='text-align: left;'>
                    ".$rkdbrgjd."
                  </td>
                  <td rowspan='2' align='center'>
                    ".$rnomp."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord33."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord33s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord34."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord34s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord35."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord35s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord36."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord36s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord37."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord37s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord38."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord38s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord39."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord39s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord40."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord40s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord41."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord41s."
                  </td>
                  <td  align='center' style='background-color: #7befb2;'>
                    ".$dord42."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord42s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord43."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord43s."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord44."
                  </td>
                  <td align='center' style='background-color: #7befb2;'>
                    ".$dord44s."
                  </td>
                  <td rowspan='2' align='center'>
                    ".$status."
                  </td>
                </tr>
                <tr>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d33."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d33s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d34."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d34s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d35."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d35s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d36."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d36s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d37."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d37s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d38."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d38s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d39."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d39s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d40."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d40s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d41."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d41s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d42."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d42s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d43."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d43s."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d44."
                  </td>
                  <td align='center' style='background-color: #f1a9a0;'>
                    ".$d44s."
                  </td>
                </tr>";

    $totdord33 += $dord33;
    $totdord33s += $dord33s;
    $totdord34 += $dord34;
    $totdord34s += $dord34s;
    $totdord35 += $dord35;
    $totdord35s += $dord35s;
    $totdord36 += $dord36;
    $totdord36s += $dord36s;
    $totdord37 += $dord37;
    $totdord37s += $dord37s;
    $totdord38 += $dord38;
    $totdord38s += $dord38s;
    $totdord39 += $dord39;
    $totdord39s += $dord39s;
    $totdord40 += $dord40;
    $totdord40s += $dord40s;
    $totdord41 += $dord41;
    $totdord41s += $dord41s;
    $totdord42 += $dord42;
    $totdord42s += $dord42s;
    $totdord43 += $dord43;
    $totdord43s += $dord43s;
    $totdord44 += $dord44;
    $totdord44s += $dord44s;
  }
  $content .= "<tr>
                <td rowspan='2' colspan='4' align='center'>
                  TOTAL
                </td>
              </tr>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord33."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord33s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord34."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord34s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord35."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord35s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord36."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord36s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord37."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord37s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord38."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord38s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord39."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord39s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord40."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord40s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord41."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord41s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord42."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord42s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord43."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord43s."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord44."
              </td>
              <td align='center' style='background-color: #6bb9f0;'>
                ".$totdord44s."
              </td>
              <td>
                
              </td>";

  $content .= " </tbody>
              </table>";


  $footer = "Printed : ".$_SESSION[$domainApp."_myname"]." ".$today."";

  $mpdf=new mPDF('','A4-L','7','Arial','5','5','45','10','5','5');
  $mpdf->simpleTables = true;
  $mpdf->packTableData = true;
  $keep_table_proportions = TRUE;
  $mpdf->shrink_tables_to_fit=1;
  $mpdf->SetHTMLHeader($header);
  $mpdf->SetHTMLFooter($footer);
  $stylesheet = file_get_contents('css/table.css');
  $mpdf->WriteHTML($stylesheet,1);

  $mpdf->WriteHTML($content);
   
  //save the file put which location you need folder/filname
  $mpdf->Output("check_po.pdf", 'I');
   
   
  //out put in browser below output function
  $mpdf->Output();
?>