<?php 

// if(isset($_COOKIE['adminAuth'])){
//     setcookie('adminAuth', '', time() - (86400 * 30 * 12), "/");
//     echo "<script>
//                 window.location.href = '../../index.php?success=You are successfully Logout';
//             </script>";
// }else{
//     setcookie('userAuth','', time() - (86400 * 30 * 12), "/");
//     echo "<script>
//                 window.location.href = '../../index.php?success=You are successfully Logout';
//             </script>";
// }

setcookie('adminAuth', '', time() - (86400 * 30 * 12), "/");
setcookie('userAuth','', time() - (86400 * 30 * 12), "/");
echo "<script>
window.location.href = '../../index.php?success=You are successfully Logout';
</script>";