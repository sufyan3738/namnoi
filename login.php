<?php
    require 'connect.php';

    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    //เข้ารหัส รหัสผ่าน
    $salt = 'ecom4cluster';
    $has_password = hash_hmac('sha256', $password, $salt);

    $sql = "SELECT * FROM identity WHERE username=? AND password=?";
    $statement = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($statement,"ss", $username,$has_password);
    mysqli_execute($statement);
    $result_user = mysqli_stmt_get_result($statement);

    
    if ($result_user->num_rows == 1) {
        session_start();
        $row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC);
        $_SESSION['iden_id'] = $row_user['iden_id'];
        $_SESSION["type"] = $row_user["type"];

      



        if($_SESSION["type"]=="C"){ //ถ้าเป็น admin ให้กระโดดไปหน้า index.php
          $sql_c = "SELECT * FROM customer WHERE c_id='" . $_SESSION['iden_id'] . "'";
          $query_c = mysqli_query($con,$sql_c);
          if(!$query_c)
          {
            echo $con->error;
            exit();
          }
          $Result_c = mysqli_fetch_array($query_c,MYSQLI_ASSOC);
          $_SESSION['c_id'] = $Result_c['c_id'];
            //header("Location: index.php");
            echo "<script>";
            echo "alert(\"เข้าสู่ระบบสำเร็จ\");";
            echo "window.history.back()"; //ไปหน้าเเรกของพนักงาน
            echo "</script>";

          } 
          elseif($_SESSION["type"]=="S"){ //ถ้าเป็น admin ให้กระโดดไปหน้า shop.php
            $sql_s = "SELECT * FROM shop WHERE username='$username'";
            $query_s = mysqli_query($con,$sql_s);
            if(!$query_s)
            {
              echo $con->error;
              exit();
            }
            $Result_s = mysqli_fetch_array($query_s,MYSQLI_ASSOC);
            $_SESSION['s_id'] = $Result_s['s_id'];
            header("Location: shop.php");
          }
          elseif($_SESSION["type"]=="A"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin.php
            $sql_a = "SELECT * FROM admin WHERE a_id='" . $_SESSION['iden_id'] . "'";
            $query_c = mysqli_query($con,$sql_c);
            if(!$query_c)
            {
              echo $con->error;
              exit();
            }
            $Result_c = mysqli_fetch_array($query_c,MYSQLI_ASSOC);
            $_SESSION['c_id'] = $Result_c['c_id'];
              //header("Location: index.php");
              echo "<script>";
              echo "alert(\"เข้าสู่ระบบสำเร็จ\");";
              echo "window.history.back()"; //ไปหน้าเเรกของพนักงาน
              echo "</script>";
          }
          elseif ($_SESSION["type"]=="F"){  //ถ้าเป็น member ให้กระโดดไปหน้า folk.php
            $sql_f = "SELECT * FROM folk WHERE username='$username'";
            $query_f = mysqli_query($con,$sql_f);
            if(!$query_f)
            {
              echo $con->error;
              exit();
            }
            $Result_f = mysqli_fetch_array($query_f,MYSQLI_ASSOC);
            $_SESSION['f_id'] = $Result_f['f_id'];
            header("Location: folk.php");
          }
 
    }   else {
            //echo "ผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            //echo "<meta http-equiv='refresh' content='2;URL=index.php' />";

            echo "<script type='text/javascript'>";
            echo "alert('ผู้ใช้หรือรหัสผ่านผิด โปรดกรอกใหม่อีกครั้ง');";
            echo "</script>";
            echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
            //header("Location: index.php");
    }

?>