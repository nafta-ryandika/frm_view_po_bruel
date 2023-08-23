$(document).ready(function(){
    $("#frmloading").hide();
    $("#tabelinput").hide();
  }
);

function enterfind(event){
  if(event.keyCode==13){
    findclick();
  }else{
    return ;
  }
};

function findclick(){
  var stat = 0;

  $(".txtdata").each(function(){
    if ($(this).val() == "") {
      stat = 1;
    }
  });

  if(stat == 1){
    alert("Parameter Harus di Isi !");
  }
  else {

    var n = $(".txtfield").length;
    var txtfield = '';
    var txtparameter = '';
    var txtdata = '';
    var data = '';
    
    if(n > 1){
      $(".txtfield").each(function () {
        txtfield += $(this).val()+"|";
      });
      
      $(".txtparameter").each(function () {
        txtparameter += $(this).val()+"|";
      });
          
      $(".txtdata").each(function () {
        txtdata += $(this).val()+"|";
      });
              
      data = "txtpage="+$("#txtpage").val()+
           "&txtperpage="+$("#txtperpage").val()+
           "&txtfield="+txtfield+
           "&txtparameter="+txtparameter+
           "&txtdata="+txtdata+
           "";   
    }
    else{
      data = "txtpage="+$("#txtpage").val()+
           "&txtperpage="+$("#txtperpage").val()+
           "&txtfield="+$(".txtfield").val()+
           "&txtparameter="+$(".txtparameter").val()+
           "&txtdata="+$(".txtdata").val()+
           "";
    }
                 
    $("#frmbody").slideUp('slow',function(){
      $("#frmloading").slideDown('slow',function(){
      	$.ajax({
      		url: "frmview.php",
      		type: "POST",
      		data: data,
      		cache: false,
      		success: function (html) {
            			$("#frmcontent").html(html);
                  $("#frmbody").slideDown('slow',function(){
                  $("#frmloading").slideUp('slow');
            });
            }
      	});
      });
    });
  }
};

function addnewclick(){
  showinput();
  clearinput();
  $("#intxtmode").val('add');
  $("#mode").text('Add New');
  $("#tabelview").fadeOut("slow",function(){
    $("#tabelinput").fadeIn("slow");
    $("#inkdjenis").focus();
    disabled();
  });
};
    
function showinput(){
  $.ajax({
    url: "frminput.php",
    cache: false,
    success: function(html) {
            $("#areainput").html(html);
    }
  });
}

function deleteclick(){
  var n = $("input:checked").length;
  if(n==0){
    alert('Pilih data untuk menghapus');
  }
  else if (confirm("Hapus Data ?")){
    var check = $("#chk:checked").length;
    $("input:checked").each(function () {
      $("#intxtmode").val('delete');
      var data = "intxtmode=delete&inkdjenis="+$(this).val()+"";
      $.ajax({
      	url: "actfrm.php",
      	type: "POST",
      	data: data,
      	cache: false,
      	success: function(data) {
                // alert(data);
        }
      });
    });
    alert(check+" data berhasil dihapus");
    findclick();
  }
};

function editclick(){
  var n = $("input:checked").length;
  if (n>1){
    alert('Maksimal pilih 1 data');
  }
  else if(n==0){
    alert('Pilih data untuk mengubah');
  }
  else{
    showinput();
    clearinput();
    $("#intxtmode").val('edit');
    $("#mode").text('Edit');
    var data = "intxtmode=getedit&inkdjenis="+$("input:checked").val()+"";
    $.ajax({
    	url: "actfrm.php",
    	type: "POST",
    	data: data,
    	cache: false,
    	success: function(data) {
              // alert(data);
              $("#areaedit").html(data);
              setinput();
              $("#tabelview").fadeOut("slow",function(){
              $("#tabelinput").fadeIn("slow");
              $("#availability-status").hide();
              $("#loader").hide();
              document.getElementById("inkdjenis").readOnly = true;
              $("#inkdjenis").attr('disabled',true);
        });
        }
    });
  };
};

function exportclick(){
  if ($("#txtSQL").val() == "") {
    alert("Search Data Terlebih Dahulu !");
  }
  else {
    var randomnumber=Math.floor(Math.random()*11)
    var exptype = $("#exporttype").val();
    switch (exptype)
    {
    case 'grd':
      $("#formexport").attr('action', 'frmviewgrid.php');
      $("#formexport").submit();
      break;
    case 'pdf':
      $("#formexport").attr('action', 'frmviewpdf.php');
      $("#formexport").submit();
      break;
    case 'xls':
      $("#formexport").attr('action', 'frmviewxls.php');
      $("#formexport").submit();
      break;
    case 'csv':
      $("#formexport").attr('action', 'frmviewcsv.php');
      $("#formexport").submit();
      break;
    case 'txt':
      $("#formexport").attr('action', 'frmviewtxt.php');
      $("#formexport").submit();
      break;
    default:
      alert('Unidentyfication Type');
    }
  }
};

function setinput(){
  $("#inkdjenis").val($("#getkdjenis").text());
  $("#innmjenis").val($("#getnmjenis").text());
};

function clearinput(){
  $("#inkdjenis").val('');
  $("#innmjenis").val('');
  $("#areainput").html('');
};

function disabled(){
  $("#innmjenis").attr('disabled',true);
};

function enabled(){
  $("#innmjenis").attr('disabled',false);
};

function saveclick(){
  if ($("#inkdjenis").val() == "") {
    alert("Input Kode Kulit Kosong !");
    $("#inkdjenis").focus();
    $("#status-not-available").text('Input Kode Kulit Kosong !');
  } else if ($("#innmjenis").val() == "") {
    alert("Input Nama Kulit Kosong !");
    $("#innmjenis").focus();
  } else if ($("#status-available").text() != "Available" && $("#intxtmode").val() == "add"){
    alert("Kode Sudah Ada!");
    $("#inkdjenis").val("");
  } else if (confirm("Simpan Data ?")){

    $("#cmdsave").attr('disabed','disabled');

    var data = "intxtmode="+$("#intxtmode").val()+
               "&inkdjenis="+encodeURIComponent($("#inkdjenis").val())+
               "&innmjenis="+encodeURIComponent($("#innmjenis").val())+
               "";
    // alert(data);

    $.ajax({
    	url: "actfrm.php",
    	type: "POST",
    	data: data,
    	cache: false,
    	success: function(data) {
              if ($("#intxtmode").val()=='edit'){
                $("#inkdjenis").attr('disabled',false);
                alert(data);
                document.getElementById("inkdjenis").readOnly = false;
                cancelclick();
                findclick();
              }
              else{
                if (data == 'OK'){
                  alert('Data berhasil disimpan');
                  cancelclick();
                }
                else {
                  alert('Kode Sudah Ada !');
                  $("#availability-status").html(data);
                  $("#inkdjenis").val('');
                  $("#inkdjenis").focus();
                }
              }
              
              $("#cmdsave").attr('disabed','');
      }
    });
  }
};

function cancelclick(){
  clearinput();
  $("#intxtmode").val('');
  $("#mode").text('');
  $("#tabelinput").fadeOut("slow",function(){
    $("#tabelview").fadeIn("slow");
  });
  $("#frmcontent").html("");
};

function checkKdjenis(){
  if ($("#inkdjenis").val() == "") {
    $("#status-available").text('Input Kode Kulit Kosong !');
    $("#status-available").css('color','red');
  }
  else if ($("#inkdjenis").val() != "" && $("#mode").text() != 'Edit') {
    var data ="inkdjenis=" + $("#inkdjenis").val() +"";
    $.ajax({
      url: "checkKdjenis.php",
      data: data,
      type: "POST",
      dataType: "html",
      beforeSend: function() {
        // alert(data);
        $("#loader").show();
      },
      success:function(data){
              $("#availability-status").html(data);
              $("#loader").hide();

              if ($("#status-available").text() == 'Available'){
                enabled();
              }
              else{
                disabled();
                // $("#inkdjenis").val('');
              }
      },
      error:function ( jqXHR, textStatus ){
            alert("error: " + textStatus);
            console.log("error: " + textStatus);
      }
    });
  }
}

function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i);
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }


function openDialog(id,dnoso,dkdbrg) {
  if (id == "detail") {
    var data = "dnoso="+dnoso+"&dkdbrg="+dkdbrg;
    $.ajax({
      url: "frmModal.php",
      data: data, 
      type: "POST",
      cache: false,
      success: function(html) {
        $("#frmbody").slideDown("slow");
        $("#dialog-open").html(html);

        var width = screen.width;
        var height = screen.height;
        var lebar = width * 85 / 100;
        var tinggi = height * 30 / 100;

        $("#dialog-open").dialog({
          autoOpen: true,
          modal: true,
          height: tinggi,
          width: lebar,
          title: "View Detail",
          close: function(event) {
            $("#dialog-open").hide();
            $("#dialog-open").html("");
          }
        });
      }
    })
  }
}


function addRow(baris,tot_baris){
  var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
  // var row = tableRef.insertRow(eval(1));
  var row = table.insertRow(eval($("#baris_"+baris).val())+1);
  var data = baris.split('_');
  
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);

  cell1.style.textAlign="center";
  cell2.style.textAlign="center";
  cell3.style.textAlign="center";
  cell4.style.textAlign="center";
  cell5.style.textAlign="center";
  
  cell1.innerHTML = "";

  for (var i = tot_baris; i >= 0; i--) {
    if(baris <= i){
      console.log(i);
      $("#baris_"+i).val(eval($("#baris_"+i).val())+1);
    }
  }

  // if(pkj == 'pkj_1'){
  //   $("#row_pkj_1").val(eval($("#row_pkj_1").val())+1);
  //   $("#row_pkj_2").val(eval($("#row_pkj_2").val())+1);
  //   $("#row_pkj_3").val(eval($("#row_pkj_3").val())+1);
  //   $("#row_pkj_4").val(eval($("#row_pkj_4").val())+1);
  //   $("#row_pkj_5").val(eval($("#row_pkj_5").val())+1);

  //   $("#row_subpkj_1").val(eval($("#row_subpkj_1").val())+1);
  // }
  // else if(pkj == 'pkj_2'){
  //   $("#row_pkj_2").val(eval($("#row_pkj_2").val())+1);
  //   $("#row_pkj_3").val(eval($("#row_pkj_3").val())+1);
  //   $("#row_pkj_4").val(eval($("#row_pkj_4").val())+1);
  //   $("#row_pkj_5").val(eval($("#row_pkj_5").val())+1);

  //   $("#row_subpkj_2").val(eval($("#row_subpkj_2").val())+1);
  // }
  // else if(pkj == 'pkj_3'){
  //   $("#row_pkj_3").val(eval($("#row_pkj_3").val())+1);
  //   $("#row_pkj_4").val(eval($("#row_pkj_4").val())+1);
  //   $("#row_pkj_5").val(eval($("#row_pkj_5").val())+1);

  //   $("#row_subpkj_3").val(eval($("#row_subpkj_3").val())+1);
  // }
  // else if(pkj == 'pkj_4'){
  //   $("#row_pkj_4").val(eval($("#row_pkj_4").val())+1);
  //   $("#row_pkj_5").val(eval($("#row_pkj_5").val())+1);

  //   $("#row_subpkj_4").val(eval($("#row_subpkj_4").val())+1);
  // }
  // else if(pkj == 'pkj_5'){
  //   $("#row_pkj_5").val(eval($("#row_pkj_5").val())+1);

  //   $("#row_subpkj_5").val(eval($("#row_subpkj_5").val())+1);
  // }
}

function rowClick(noso){
  var data = "noso="+noso;

  $("#frmbody").slideUp('slow',function(){
    $("#frmloading").slideDown('slow',function(){
      $.ajax({
        url: "frmview_1.php",
        type: "POST",
        data: data,
        cache: false,
        success: function (html) {
                $("#frmcontent").html(html);
                $("#frmbody").slideDown('slow',function(){
                $("#frmloading").slideUp('slow');
          });
          }
      });
    });
  });
}

function searchclick(){
  if ($("#areasearch").is(":hidden")) {
    $("#areasearch").slideDown("slow");
  }
  else {
    $("#areasearch").slideUp("slow");
  }
};

// ******************************* START JS MULTISEARCH ***************************************
  var xrow = 1;

function addSearch(){
  var table = document.getElementById("tblSearch");

  // Create an empty <tr> element and add it to the 1st position of the table:
  var row = table.insertRow(xrow);

  // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
        
  //  cell2.className = 'txtmultisearch';

  // Add some text to the new cells:
  cell1.innerHTML = "Field : \n\
          <select class='txtfield'>\n\
          <option value=''>-</option>\n\
          <option value='a.slseason'>Season</option>\n\
          <option value='a.slnopo'>No. PO</option>\n\
          <option value='a.slnoso'>No. SO</option>\n\
          <option value='a.slkdcust'>Customer</option>\n\
          </select>";
  cell2.innerHTML = "<select class='txtparameter'>\n\
              <option value='equal'>equal</option>\n\
              <option value='notequal'>not equal</option>\n\
              <option value='less'>less</option>\n\
              <option value='lessorequal'>less or equal</option>\n\
              <option value='greater'>greater</option>\n\
              <option value='greaterorequal'>greater or equal</option>\n\
              <option value='isnull'>is null</option>\n\
              <option value='isnotnull'>is not null</option>\n\
              <option value='isnotnull'>is not null</option>\n\
              <option value='isin'>is in</option>\n\
              <option value='isnotin'>is not in</option>\n\
              <option value='like'>like</option>\n\
          </select>";
  cell3.innerHTML = "Data : <input type='text' class='txtdata' onkeydown='enterfind(event)'>";
  cell4.innerHTML = "<input type='button' value='[+]' onclick='addSearch()'>";
  cell5.innerHTML = "<input type='button' value='remove' onclick=\"deleteRow(this)\" style='cursor:pointer;'>";

  xrow++;
}

function deleteRow(btn) {
  if (btn == "rmv1") {
    $("#txtfield0").val("");
    $("#txtparameter0").val("equal");

    var data_select =
    "Data : <input type='text' class='txtdata' onkeydown='enterfind(event)'>";

    $("#filter_data0").html(data_select);
    $("#txtdata0").val("");
  } 
  else {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    xrow--;
  }
}

// ******************************* END JS MULTISEARCH ***************************************

function showpage(page){
  $("#txtpage").val(page);
  findclick();
}

function prevpage(){
  var n = eval($("#txtpage").val())-1 ;
  if (n >= 1) {
    $("#txtpage").val(n);
    findclick();
  }
}

function nextpage(){
  var n = eval($("#txtpage").val())+1 ;
  if (eval(n)<=eval($("#jumpage").val())){
    $("#txtpage").val(n);
    findclick();
  }
}

$(function() {
	$( "#tglmasuk" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
  $( "#tglkontrak" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
  $( "#intxttglmasuk" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
  $( "#intxttglkontrak" ).datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth : true,
    changeYear  : true
  });
});


function MyValidDate(dateString){
  var validformat=/^\d{1,2}\/\d{1,2}\/\d{4}$/ //Basic check for format validity
  if (!validformat.test(dateString)){
      return ''
  }
  else{ //Detailed check for valid date ranges
    var dayfield=dateString.substring(0,2);
    var monthfield=dateString.substring(3,5);
    var yearfield=dateString.substring(6,10);
    var MyNewDate = monthfield + "/" + dayfield + "/" + yearfield;
    
    if (checkValidDate(MyNewDate)==true){
      var SQLNewDate = yearfield + "/" + monthfield + "/" + dayfield;
      return SQLNewDate;
    }
    else{
      return '';
    }
  }
}

function checkValidDate(dateStr) {
    // dateStr must be of format month day year with either slashes
    // or dashes separating the parts. Some minor changes would have
    // to be made to use day month year or another format.
    // This function returns True if the date is valid.
    var slash1 = dateStr.indexOf("/");
    if (slash1 == -1) { slash1 = dateStr.indexOf("-"); }
    // if no slashes or dashes, invalid date
    if (slash1 == -1) { return false; }
    var dateMonth = dateStr.substring(0, slash1)
    var dateMonthAndYear = dateStr.substring(slash1+1, dateStr.length);
    var slash2 = dateMonthAndYear.indexOf("/");
    if (slash2 == -1) { slash2 = dateMonthAndYear.indexOf("-"); }
    // if not a second slash or dash, invalid date
    if (slash2 == -1) { return false; }
    var dateDay = dateMonthAndYear.substring(0, slash2);
    var dateYear = dateMonthAndYear.substring(slash2+1, dateMonthAndYear.length);
    if ( (dateMonth == "") || (dateDay == "") || (dateYear == "") ) { return false; }
    // if any non-digits in the month, invalid date
    for (var x=0; x < dateMonth.length; x++) {
        var digit = dateMonth.substring(x, x+1);
        if ((digit < "0") || (digit > "9")) { return false; }
    }
    // convert the text month to a number
    var numMonth = 0;
    for (var x=0; x < dateMonth.length; x++) {
        digit = dateMonth.substring(x, x+1);
        numMonth *= 10;
        numMonth += parseInt(digit);
    }
    if ((numMonth <= 0) || (numMonth > 12)) { return false; }
    // if any non-digits in the day, invalid date
    for (var x=0; x < dateDay.length; x++) {
        digit = dateDay.substring(x, x+1);
        if ((digit < "0") || (digit > "9")) { return false; }
    }
    // convert the text day to a number
    var numDay = 0;
    for (var x=0; x < dateDay.length; x++) {
        digit = dateDay.substring(x, x+1);
        numDay *= 10;
        numDay += parseInt(digit);
    }
    if ((numDay <= 0) || (numDay > 31)) { return false; }
    // February can't be greater than 29 (leap year calculation comes later)
    if ((numMonth == 2) && (numDay > 29)) { return false; }
    // check for months with only 30 days
    if ((numMonth == 4) || (numMonth == 6) || (numMonth == 9) || (numMonth == 11)) {
        if (numDay > 30) { return false; }
    }
    // if any non-digits in the year, invalid date
    for (var x=0; x < dateYear.length; x++) {
        digit = dateYear.substring(x, x+1);
        if ((digit < "0") || (digit > "9")) { return false; }
    }
    // convert the text year to a number
    var numYear = 0;
    for (var x=0; x < dateYear.length; x++) {
        digit = dateYear.substring(x, x+1);
        numYear *= 10;
        numYear += parseInt(digit);
    }
    // Year must be a 2-digit year or a 4-digit year
    if ( (dateYear.length != 2) && (dateYear.length != 4) ) { return false; }
    // if 2-digit year, use 50 as a pivot date
    if ( (numYear < 50) && (dateYear.length == 2) ) { numYear += 2000; }
    if ( (numYear < 100) && (dateYear.length == 2) ) { numYear += 1900; }
    if ((numYear <= 0) || (numYear > 9999)) { return false; }
    // check for leap year if the month and day is Feb 29
    if ((numMonth == 2) && (numDay == 29)) {
        var div4 = numYear % 4;
        var div100 = numYear % 100;
        var div400 = numYear % 400;
        // if not divisible by 4, then not a leap year so Feb 29 is invalid
        if (div4 != 0) { return false; }
        // at this point, year is divisible by 4. So if year is divisible by
        // 100 and not 400, then it's not a leap year so Feb 29 is invalid
        if ((div100 == 0) && (div400 != 0)) { return false; }
    }
    // date is valid
    return true;
}
