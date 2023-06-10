<?php
session_start();
include("../conn.php");
?>

<h3><i class="fa fa-angle-right"></i>&nbsp;Edit Setting</h3>
<div id="tes"></div>
<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel">
      <form class="form-horizontal" id="edit_setting">
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Nama Karyawan</label>
          <div class="col-sm-10">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
            <input type="text" class="form-control" name="namkar" id="namkar" value="<?php echo $_SESSION['namkar']; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="user" id="user" value="<?php echo $_SESSION['username']; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Last Password</label>
          <div class="col-sm-10">
            <div id="result_lastpass"></div>
            <input type="Password" class="form-control" name="lpass" id="lpass" placeholder="<?php echo $_SESSION['password']; ?>" value="********" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">New Password</label>
          <div class="col-sm-10">

            <input type="Password" class="form-control" name="nupass" id="nupass" placeholder="Input New Password">
          </div>
        </div>
        <div class="form-group">

          <label class="col-sm-2 col-sm-2 control-label">Re-Password</label>
          <div class="col-sm-10">
            <div id="result_repass"></div>
            <input type="Password" class="form-control" name="repass" id="repass" placeholder="Input Re-Password">
          </div>
        </div>

        <div class="form-group">

          <div class="col-sm-2"></div>
          <div class="col-sm-10">

            <button type="button" class="btn btn-primary" onclick="save_data()">Update</button>

          </div>
        </div>


      </form>
    </div>
  </div><!-- col-lg-12-->
</div><!-- /row -->




<script>
  function save_data() {

    if ($('#id').val() == '' || $('#namkar').val() == '' || $('#user').val() == '' || $('#lpass').val() == '' || $('#nupass').val() == '' || $('#repass').val() == '') {
      notif_oops('isi dulu semuanya');
    } else {
      var formData = new FormData($('#edit_setting')[0]);
      var url = "page/proses_edit_set.php";
      $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status) //if success
          {
            notif_success('berhasil mengubah pengaturan user, silahkan login ulang..');
            setTimeout(function() {
              window.location.href = "logout.php"; // Mengarahkan pengguna ke halaman logout setelah jeda beberapa detik
            }, 2000); // Mengatur jeda waktu dalam milidetik (misalnya 3000 untuk 3 detik)
            // $("#kontenku").load("proses_edit_set.php");
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('error');
        }
      });
    }

  }

  $('#repass').on('keyup', function() {
    var newpass = $('#nupass').val();
    var repass = $('#repass').val();
    if (newpass == repass) {
      $('#result_repass').html('');
    } else if (newpass != repass && repass != '') {
      $('#result_repass').html('<h5 style="color:red">password tidak sama</h5>');
    } else {
      $('#result_repass').html('<h5 style="color:red">password harus diisi</h5>');
    }

  });
</script>