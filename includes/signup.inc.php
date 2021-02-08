<?php

ini_set('display_errors', 1);

if (isset($_POST["submit"])) {
  
  $name = $_POST["name"];
  $email = $_POST["email"];
  $uid = $_POST["username"];
  $pwd = $_POST["pwd"];
  $pwdConfirm = $_POST["pwdConfirm"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if(emptyInputSignup($name, $email, $uid, $pwd, $pwdConfirm) !== false) {
    header("location: ../signup.php?error=emptyInput");
    exit();
  }

  if (invalidUid($uid) !== false) {
    header("location: ../signup.php?error=invalidUid");
    exit();
  }

  if (invalidEmail($email) !== false) {
    header("location: ../signup.php?error=invalidEmail");
    exit();
  }

  if (pwdsMatch($pwd, $pwdConfirm) !== false) {
  header("location: ../signup.php?error=pwdsNoMatch");
  exit();
  }

 if (emailExists($conn, $email) !== false) {
  header("location: ../signup.php?error=emailTaken");
  exit();
  }

  if (uidExists($conn, $uid) !== false) {
  header("location: ../signup.php?error=uidTaken");
  exit();
  }

  createUser($conn, $name, $email, $pwd ,$uid);

} else {
    header("location: ../signup.php");
    exit();
}