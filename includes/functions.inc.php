<?php

function emptyInputSignup($name, $email, $uid, $pwd, $pwdConfirm) {
  $result;
  if (empty($name) || empty($email) || empty($uid) || empty($pwd) || empty($pwdConfirm)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidUid($uid) {
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email) {
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function pwdsMatch($pwd, $pwdConfirm) {
  $result;
  if ($pwd !== $pwdConfirm) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function uidExists($conn, $uid) {
  $sql = "SELECT * FROM users WHERE usersUid = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
  exit();
  } 

  mysqli_stmt_bind_param($stmt, "s", $uid);
  mysqli_stmt_execute($stmt);
  echo $stmt;
  $resultData = mysqli_stmt_get_result($stmt);
  echo $resultData;

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);

}