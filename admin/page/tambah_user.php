<h3><i class="fa fa-angle-right"></i>Tambah User</h3>
<div id="tes"></div>
<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel">
      <form class="form-horizontal" id="tambah_user_form">
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Input Nama">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Username</label>
          <div class="col-sm-10">
            <div id="result_user"></div>
            <input type="text" class="form-control" name="user" id="user" placeholder="Input Username" onkeyup="checkUsernameAvailability()">
          </div>
        </div>

        <div class=" form-group">
          <label class="col-sm-2 col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="Password" class="form-control" name="pass" id="pass" placeholder="Input Password">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Level</label>
          <div class="col-sm-10">
            <input type="radio" name="level" id="level-admin" value="admin" /> &nbsp;Admin&nbsp;
            <input type="radio" name="level" id="level-karyawan" value="karyawan" /> &nbsp;Karyawan&nbsp;
            <input type="radio" name="level" id="level-karu" value="karu" /> &nbsp;Karu
          </div>
        </div>

        <div class="form-group">

          <div class="col-sm-2"></div>
          <div class="col-sm-10">

            <button type="button" id="tombol_simpan" class="btn btn-primary" onclick="save_data()">Simpan</button>
            <button type="button" class="btn btn-default" onclick="back()">Back</button>
          </div>
        </div>


      </form>
    </div>
  </div><!-- col-lg-12-->
</div><!-- /row -->




<script>
  function save_data() {

    if ($('#nama').val() == '' || $('#user').val() == '' || $('#pass').val() == '') {
      notif_oops('isi dulu username dan password');
    } else if ($('#result_user').text() != '') {
      notif_oops('Username telah digunakan!');
    } else {
      var formData = new FormData($('#tambah_user_form')[0]);
      var url = "server_side/proses_tambah_user.php";
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
            notif_success('berhasil tambah user');
            {
              $("#kontenku").load("page/setting.php");
            }
          }

        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('error');

        }

      });
    }

  }

  function back() {
    $('#kontenku').load('page/setting.php');
  }

  function checkUsernameAvailability() {
    $('#user').on('keyup', function() {
      var username = $(this).val();
      $.ajax({
        type: 'POST',
        url: './server_side/new_check_user.php',
        data: {
          username: username
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === 'error') {
            // Menampilkan pesan error
            $('#result_user').html('<p class="text-danger">' + response.message + '</p>');
          } else {
            // Menghapus pesan error jika ada
            $('#result_user').html('');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error: ' + error);
        }
      });
    });
  }


  // fungsi javascript biasa
  // function checkUsernameAvailability() {
  //   // Mengubah fungsi checkUsernameAvailability() agar dipanggil saat keyup
  //   document.getElementById('user').onkeyup = function() {
  //     var username = this.value;

  //     // Membuat objek XMLHTTPRequest
  //     var xhr = new XMLHttpRequest();

  //     // Mengatur callback saat permintaan AJAX selesai
  //     xhr.onreadystatechange = function() {
  //       if (xhr.readyState === XMLHttpRequest.DONE) {
  //         if (xhr.status === 200) {
  //           // Tanggapan sukses dari server
  //           var response = JSON.parse(xhr.responseText);
  //           if (response.status === 'error') {
  //             // Menampilkan pesan error
  //             document.getElementById('result_user').innerHTML = '<p class="text-danger">' + response.message + '</p>';
  //           } else {
  //             // Menghapus pesan error jika ada
  //             document.getElementById('result_user').innerHTML = '';
  //           }
  //         } else {
  //           // Error saat melakukan permintaan AJAX
  //           console.error('Error: ' + xhr.status);
  //         }
  //       }
  //     };

  //     // Mengirim permintaan POST ke check_user.php
  //     xhr.open('POST', './server_side/new_check_user.php', true);
  //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  //     xhr.send('username=' + encodeURIComponent(username));
  //   };

  // }

  // $('#user').on('keyup', function() {

  //   $.get('server_side/check_user.php?user=' + $('#user').val(), function(data) {
  //     $('#result_user').html(data);
  //   });
  // });
</script>