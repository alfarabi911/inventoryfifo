<?php
include("../conn.php");
$idnya = $_GET['id'];
$query = $conn->query("SELECT * FROM tbl_user WHERE id='$idnya'");
$f = $query->fetch_assoc();
?>


<h3><i class="fa fa-angle-right"></i>Edit Setting</h3>
<div id="tes"></div>
<!-- BASIC FORM ELELEMNTS -->
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <form class="form-horizontal" id="edit_setting">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $f['id']; ?>">
                        <input type="text" class="form-control" name="namkar" id="namkar" value="<?php echo $f['name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="user" id="user" value="<?php echo $f['username']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Last Password</label>
                    <div class="col-sm-10">
                        <div id="result_lastpass"></div>
                        <input type="password" class="form-control" name="lpass" id="lpass" placeholder="<?php echo $f['password']; ?>" value="******" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="Password" class="form-control" name="nupass" id="nupass" placeholder="Input New Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">

                        <button type="button" class="btn btn-primary" onclick="save_data()">Update</button>
                        <button type="button" class="btn btn-default" onclick="back()">Back</button>
                    </div>
                </div>


            </form>
        </div>
    </div><!-- col-lg-12-->
</div><!-- /row -->

<script>
    function save_data() {

        if ($('#id').val() == '' || $('#namkar').val() == '' || $('#user').val() == '' || $('#lpass').val() == '' || $('#nupass').val() == '') {
            notif_oops('isi dulu semuanya');
        } else {
            var formData = new FormData($('#edit_setting')[0]);
            var url = "server_side/proses_edit_set.php";
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
                        notif_success('berhasil mengubah pengaturan user');
                        $("#kontenku").load("page/setting.php");
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
</script>