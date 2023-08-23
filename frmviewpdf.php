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
               <b style='font-size: 10px;'>LAPORAN VIEW PO BRUEL</b><br/><br/>
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
    if ($field == 'SLNOPO') {
      $field = 'No. PO';
    }
    else if ($field == 'NOSO') {
      $field = 'No. SO';
    }
    else if ($field == 'KDBRG') {
      $field = 'Kode Barang';
    }
    else if ($field == 'BARCODE') {
      $field = 'Barcode';
    }
    else if ($field == 'ITEM_CODE') {
      $field = 'Item Code';
    }
    else if ($field == 'SKU') {
      $field = 'sku';
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
      if ($field == 'SLNOPO') {
        $field = 'No. PO';
      }
      else if ($field == 'NOSO') {
        $field = 'No. SO';
      }
      else if ($field == 'KDBRG') {
        $field = 'Kode Barang';
      }
      else if ($field == 'BARCODE') {
        $field = 'Barcode';
      }
      else if ($field == 'ITEM_CODE') {
        $field = 'Item Code';
      }
      else if ($field == 'SKU') {
        $field = 'sku';
      }

      $data = $nmData[$i];

      if ($field != '' && $parameter != '' && $data != '') {
        $header .= $field.' '.$parameter.' '.$data.'<br/>';
      }
    }
    $h = 32 +((($count - 1)/2)*8);
  }

  $content .= "<table id='myTable' class='table'>
                <thead>
                  <tr>
                    <th align='center' width='2%'>No</th>
                    <th align='center' width='10%'>PO</th>
                    <th align='center' width='10%'>Sales Order</th>
                    <th align='center' width='10%'>Kode Barang Jadi</th>
                    <th align='center' width='12.5%'>Barcode</th>
                    <th align='center' width='10%'>Item Code</th>
                    <th align='center' width='10%'>SKU</th>
                    <th align='center' width='2%'>35</th>
                    <th align='center' width='2%'>35s</th>
                    <th align='center' width='2%'>36</th>
                    <th align='center' width='2%'>36s</th>
                    <th align='center' width='2%'>37</th>
                    <th align='center' width='2%'>37s</th>
                    <th align='center' width='2%'>38</th>
                    <th align='center' width='2%'>38s</th>
                    <th align='center' width='2%'>39</th>
                    <th align='center' width='2%'>39s</th>
                    <th align='center' width='2%'>40</th>
                    <th align='center' width='2%'>40s</th>
                    <th align='center' width='2%'>41</th>
                    <th align='center' width='2%'>41s</th>
                    <th align='center' width='2%'>42</th>
                    <th align='center' width='5%'>Subtotal</th>
                  </tr>
                </thead>
                <tbody>";

  $row = 0;
  $result = mysql_query($txtSQL,$conn);
  while ($data = mysql_fetch_array($result)){
    $row += 1;

    $noso = $data["noso"];
    $kdbrg = $data["kdbrg"];
    $barcode = $data["barcode"];
    $item_code = $data["item_code"];
    $sku = $data["sku"];
    $nopo = $data["slnopo"];
    $u_t35 = $data["u_t35"];
    $u_t35_5 = $data["u_t35_5"];
    $u_t36 = $data["u_t36"];
    $u_t36_5 = $data["u_t36_5"];
    $u_t37 = $data["u_t37"];
    $u_t37_5 = $data["u_t37_5"];
    $u_t38 = $data["u_t38"];
    $u_t38_5 = $data["u_t38_5"];
    $u_t39 = $data["u_t39"];
    $u_t39_5 = $data["u_t39_5"];
    $u_t40 = $data["u_t40"];
    $u_t40_5 = $data["u_t40_5"];
    $u_t41 = $data["u_t41"];
    $u_t41_5 = $data["u_t41_5"];
    $u_t42 = $data["u_t42"];
    $total = (float) $data["slsub_total"];
    
    $content .= "<tr>
                  <td rowspan='' align='center'>
                    ".$row."
                  </td>
                  <td rowspan='' style='text-align: left;'>
                    ".$nopo."
                  </td>
                  <td rowspan='' style='text-align: left;'>
                    ".$noso."
                  </td>
                  <td rowspan='' style='text-align: left;'>
                    ".$kdbrg."
                  </td>
                  <td rowspan='' style='text-align: left;'>
                    ".$barcode."
                  </td>
                  <td rowspan='' style='text-align: left;'>
                    ".$item_code."
                  </td>
                  <td rowspan='' style='text-align: left;'>
                    ".$sku."
                  </td>
                  <td align='center' >
                    ".$u_t35."
                  </td>
                  <td align='center' >
                    ".$u_t35_5."
                  </td>
                  <td align='center' >
                    ".$u_t36."
                  </td>
                  <td align='center' >
                    ".$u_t36_5."
                  </td>
                  <td align='center' >
                    ".$u_t37."
                  </td>
                  <td align='center' >
                    ".$u_t37_5."
                  </td>
                  <td align='center' >
                    ".$u_t38."
                  </td>
                  <td align='center' >
                    ".$u_t38_5."
                  </td>
                  <td align='center' >
                    ".$u_t39."
                  </td>
                  <td align='center' >
                    ".$u_t39_5."
                  </td>
                  <td align='center' >
                    ".$u_t40."
                  </td>
                  <td align='center' >
                    ".$u_t40_5."
                  </td>
                  <td align='center' >
                    ".$u_t41."
                  </td>
                  <td align='center' >
                    ".$u_t41_5."
                  </td>
                  <td align='center' >
                    ".$u_t42."
                  </td>
                  <td align='center' >
                    ".$total."
                  </td>
                </tr>";
  }

  $content .= " </tbody>
              </table>";


  $footer = "Printed : ".$_SESSION[$domainApp."_myname"]." ".$today."";

  $mpdf=new mPDF('','A4-L','7','Arial','5','5',$h,'10','5','5');
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