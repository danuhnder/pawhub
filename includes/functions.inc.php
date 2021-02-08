<?php

ini_set('display_errors', 1);

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
  
  $resultData = mysqli_stmt_get_result($stmt);
  

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);

}

function emailExists($conn, $email) {
  $sql = "SELECT * FROM users WHERE usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
  exit();
  } 

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  
  $resultData = mysqli_stmt_get_result($stmt);
  

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);

}

function createUser($conn, $name, $email, $pwd, $uid) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersPwd, usersUid) VALUES (?, ?, ?, ?);";
  echo $sql;
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
  exit();
  } 

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  echo $hashedPwd;
  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashedPwd, $uid);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  exit();

}

function emptyInputLogin($username, $pwd) {
  $result;
  if (empty($username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username);
  $emailExists = emailExists($conn, $username);
  if ($uidExists) {
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if (!$checkPwd) {
      header("location: ../login.php?error=wronglogin");
      exit();
    }
    else {
      session_start();
      $_SESSION["userID"] = $uidExists["usersId"];
      $_SESSION["userUid"] = $uidExists["usersUid"];
      header("location: ../index.php");
      exit();
    }
  }
  else if ($emailExists) {
    $pwdHashed = $emailExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if (!$checkPwd) {
      header("location: ../login.php?error=wronglogin");
      exit();
    }
    else {
      session_start();
      $_SESSION["userID"] = $emailExists["usersId"];
      $_SESSION["userUid"] = $emailExists["usersUid"];
      header("location: ../index.php");
      exit();
    }
  }
  else {
    header("location: ../login.php?error=wrongLogin");
    exit();
  }
}