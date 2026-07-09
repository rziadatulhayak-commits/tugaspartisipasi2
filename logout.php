<?php 
//set session
session_start();
session_destroy();

echo "<script>
        alert('Anda berhasil LOGOUT!!!');
        document.location.href = 'index.php';
     </script>";

?>