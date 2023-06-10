<?php 
require "../conn.php";
$id_keluar=$_GET['id_keluar'];
$query = $conn->query("SELECT kobar, SUM(qty) as jumlah,id_keluar,id_masuk FROM detail_barang_keluar WHERE id_keluar = '$id_keluar' GROUP BY kobar"); 
?>
<div class="row">
  <div class="col-sm-6">
    <h4 class="mb"><i class="fa fa-angle-right"></i> Data Barang yang akan keluar</h4>

  </div>
  <div class="col-sm-6">
    <?php if ($query->num_rows > 0) { ?>
      <button type="button" class="btn btn-success pull-right" onclick="jual_selesai()">Minta Barang</button>
   <?php }else{ ?>
      <button type="button" class="btn btn-success pull-right" disabled>Transaksi Selesai</button>
    <?php } ?>
  </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-advance table-hover">         
        <thead>
        <tr>
            <th><i class="fa fa-bullhorn"></i> No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Id Masuk</th>
            <th><i class="fa fa-bookmark"></i> Option</th>              
        </tr>
        </thead>
        <tbody>
        
          <?php
            $no=1;
            while ($row = $query->fetch_assoc()) {
              ?>
               
                          <tr>
                               <td><?=$no++; ?></td>
                               <td><?=$row['kobar']; ?></td>
                               <td><?php $sqlr=$conn->query("SELECT nama_barang FROM barang where kobar='".$row['kobar']."' ");
                    $row_r=$sqlr->fetch_assoc(); 
                    $rak=$row_r['nama_barang'];{ ?>
                    <?=$row_r['nama_barang'] ?>
                    <?php } ?> 
                    </td>
                               <td><?=$row['jumlah']; ?></td>
                               <td><span class="label label-warning"><?=$row['id_masuk']; ?></span></td>
                               <td>
                                  <a onclick="hapus_item_keluar('<?= $row['id_keluar'] ?>','<?=$row['kobar'] ?>')" class="btn btn-danger btn-xs" title="hapus"> <i class="fa fa-trash-o"></i></a>
                               </td>

                              
                          </tr>
                          

              <?php 

            }
            ?>
    
        </tbody>
</table>
</div>
<!-- end table -->
