<fieldset class="info_fieldset"><legend>Form Input</legend>
    <div style="width: 50%">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <label>Kode Kulit</label><INPUT id="inkdjenis" class="textbox" type="text" name="intype" value="" maxlength="2" onkeyup="checkKdjenis()" style="width: 25px">
                    <span id="availability-status"></span>
                    <img align="top" src="img/loading1.gif" id="loader" style="display:none" />
                    <br />
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <label>Nama Kulit</label><INPUT id="innmjenis" class="textbox" type="text" name="intype" value="" maxlength="30" style="width: 200px">
                    <br />
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div align="center">
                        <INPUT id="cmdsave" class="buttonadd" type="button" name="nmcmdsave" value="Save" onclick="saveclick()">
                        <INPUT id="cmdcancel" class="buttondelete" type="button" name="nmcmdcancel" value="Cancel" onclick="cancelclick()">
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>
</fieldset>

<script type="text/javascript">
    $("input[name=intype],input[name=injnssupp],textarea").bind("keydown", function(event) {
        if (event.which === 13) {
            event.stopPropagation();
            event.preventDefault();
           $(':input:eq(' + ($(':input').index(this) + 1) +')').focus();
        }
    });
</script>