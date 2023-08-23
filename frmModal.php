<?php
  include("../../connection.php");
  if (isset($_POST['dnoso'])) {
    $dnoso = $_POST['dnoso'];
  }
  if (isset($_POST['dkdbrg'])) {
    $dkdbrg = $_POST['dkdbrg'];
  }

  // unset($_POST['inid']);
?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#frmloadingmodal").hide();
    $("#txtdatamodal").val('<?=$txtdatamodal?>');
    findclick_modal();
    }
  );
  
  function enterfindmodal(event){
    if(event.keyCode==13){
      findclick_modal();
    }
    else{
      return ;
    }
  };

  function showpage_modal(page) {
    $("#txtpagemodal").val(page);
    findclick_modal();
  }

  function prevpage_modal() {
    var n = eval($("#txtpagemodal").val()) - 1;
    if (n >= 1) {
      $("#txtpagemodal").val(n);
      findclick_modal();
    }
  }

  function nextpage_modal() {
    var n = eval($("#txtpagemodal").val()) + 1;
    if (eval(n) <= eval($("#jumpagemodal").val())) {
      $("#txtpagemodal").val(n);
      findclick_modal();
    }
  }
  
  function findclick_modal(){
    var dnoso = '<?=$dnoso?>';
    var dkdbrg = '<?=$dkdbrg?>';
    var data = "txtpagemodal="+$("#txtpagemodal").val()+
               "&txtperpagemodal="+$("#txtperpagemodal").val()+
               "&txtdatamodal="+$("#txtdatamodal").val()+
               "&txtfield="+$("#txtfieldmodal").val()+
               "&dnoso="+dnoso+
               "&dkdbrg="+dkdbrg+
               "";
           
    $("#frmbodymodal").slideUp('slow',function(){
    $("#frmloadingmodal").slideDown('slow',function(){
    $.ajax({
      url: "frmviewModal.php",
      type: "POST",
      data: data,
      cache: false,
      success: function (html) {
        $("#frmcontentmodal").html(html);
                $("#frmbodymodal").slideDown('slow',function(){
                  $("#frmloadingmodal").slideUp('slow');
                });
                }
      });
    });
    });
  };
</script>

  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div id="frmloadingmodal" align="center">
          <img src="img/ajax-loader.gif" />
        </div>
        <div id="frmbodymodal">
          <div id="frmcontentmodal">
          </div>
        </div>
      </td>
    </tr>
  </table>