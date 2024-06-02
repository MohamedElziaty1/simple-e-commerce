<?php
function Redirect_to($New_Location){
  header("Location:".$New_Location);
  exit;
}
function Login_Attempt($email,$Password){
  global $ConnectingDB;
  $sql = "SELECT * FROM admin WHERE email=:email AND password=:passWord LIMIT 1";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':email',$email);
  $stmt->bindValue(':passWord',$Password);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_Account=$stmt->fetch();
  }else {
    return null;
  }
}