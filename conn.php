<?php
 
    // Definisikan variabel koneksi database
 
    // localhost adalah nama host dari server
    define("HOST","localhost");
    // Root adalah nama user pada database
    define("USER","root");
    /* password pada XAMPP biasanya tidak di pakai maka dikosongkan,
       Tapi jika pada hosting, akan dipakai. maka harus di isi.
    */
    define("PASS","");
    // nama database harus sesuai dengan yang dibuat
    define("DBNAME","fifo");
 
    // Melakukan koneksi ke server
    $koneksi = @mysqli_connect(HOST,USER,PASS);
 
    // Cek Koneksi Ke Server Database
    if ($koneksi)
    {
        // Jika Sukses
        // echo "Koneksi Database Sukses";
    }
    else
    {
        // jika memiliki masalah, maka akan muncul pesan error
         echo "Koneksi Database Gagal".mysqli_error();
    }
 
    // Mengakses Database
    if (!@mysqli_select_db ($koneksi, DBNAME))
    {
         die ('<p>Gagal Akses Database Karena : '.mysqli_error().'</p>');
    }
    else
    {
        // echo "<p>Sukses Akses Database ".DBNAME."</p>";
    }
?>