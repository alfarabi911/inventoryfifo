<h3><i class="fa fa-angle-right"></i>Tambah User</h3>
<div id="tes"></div>
<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
  <div class="col-lg-12">
      <div class="form-panel">
          <form  class="form-horizontal" action="./server_side/proses_tambah_user.php"  id="tambah_user_form"> 
            <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                      <div id="result_user"></div>
                      <input type="text" class="form-control" name="user" id="user">
                  </div>
            </div>
          
             <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                     
                      <input type="Password" class="form-control" name="pass" id="pass" placeholder="Input Password" >
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email">
                  </div>
            </div>
             
             <div class="form-group">
                   
                  <label class="col-sm-2 col-sm-2 control-label">Level</label>
                  <div class="col-sm-10">
                 <input type="radio" name="level" id="level" value="admin"/>Admin
                 <input type="radio" name="level" id="level" value="karu"/>Karu
             
            </div>
            </div>
           
            <div class="form-group">
                    
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                      
                      <input class="btn btn-primary" type="submit" name="input" value="Simpan">
                      <button type="button" class="btn btn-default" onclick="back()">Back</button>
                    </div>
              </div>
             

          </form>
      </div>
  </div><!-- col-lg-12-->       
</div><!-- /row -->




<script>

function save_data(){
      
      if ($('#user').val()=='' || $('#pass').val()=='') {
        notif_oops('isi dulu username dan password');
      }else{
          var formData = new FormData($('#tambah_user_form')[0]);
          var url = "server_side/proses_tambah_user.php";
          $.ajax({
              url : url,
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              dataType: "JSON",
              success: function(data)
              {
                  if(data.status) //if success
                  {
                      notif_success('berhasil tambah user');
                      $("#kontenku").load("page/setting.php");
                  }

                 
                  
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('error');
                  
              }
              
          });
      }
      
}

function back() {
  $('#kontenku').load('page/setting.php');
}


$("#avatar-2").fileinput({
overwriteInitial: true,
maxFileSize: 1500,
showClose: false,
showCaption: false,
showBrowse: false,
browseOnZoneClick: true,
removeLabel: '',
removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
removeTitle: 'Cancel or reset changes',
elErrorContainer: '#kv-avatar-errors-2',
msgErrorClass: 'alert alert-block alert-danger',
defaultPreviewContent: '<img src="upload/default-avatar.jpg" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
allowedFileExtensions: ["jpg", "png", "gif"]
});

$('#user').on('keyup', function(){   

    $.get('server_side/check_user.php?user='+  $('#user').val(), function(data){
      $('#result_user').html(data);
    });
  });
</script>