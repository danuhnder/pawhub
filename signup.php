<?php
  include_once 'header.php'
  ?>
  <section class="signup-form">
      <h1>Sign up</h1>
      <div class="signup-form-form">
        <form action="includes/signup.inc.php" method="post">
          <input type="text" name="name" placeholder="What do the people who bring you food call you?">
          <input type="text" name="email" placeholder="Email address for the people who bring you food">
          <input type="text" name="username" placeholder="Like a superhero name. Only you can have it!">
          <input type="password" name="pwd" placeholder="A secret word only you know. Don't tell the cat!">
          <input type="password" name="pwdConfirm" placeholder="Give us that secret word again just in case.">
          <button type="submit" name="submit">Sign Up</button>
        </form>
      </div>

  <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyInput") {
        echo "<p>Fill in all fields PLEASE</p>";
      }
      else if ($_GET["error"] == "invalidUid") {
        echo "<p>Your username can be little letters, big letters and numbers only please. no hacker characters</p>";
      }
      else if ($_GET["error"] == "invalidEmail") {
        echo "<p>Something is rotten in the state of [YOUR_EMAIL_ADDRESS]</p>";
      }
      else if ($_GET["error"] == "pwdsNoMatch") {
        echo "<p>your passwords don't match! TRY AGAIN PLS</p>";
      }
      else if ($_GET["error"] == "emailTaken") {
        echo "<p>hey, that email address is already in use? maybe you want to try logging in instead? it's ok. I've definitely registered for a service before while blackout drunk and been very confused when i tried to signup again. We've all been there.</p>";
      }
      else if ($_GET["error"] == "uidTaken") {
        echo "<p>That's such a cool username! UNFORTUNATELY it's already gone. stick some numbers at the end of it or come up with something EVEN COOLER!</p>";
      }
      else if ($_GET["error"] == "stmtFailed") {
        echo "<p>Uh-oh. This bad is OUR bad. You did everything right. Give me a minute while i go see if the hamsters are still ok.</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>YOU DID IT</p>";
      }
    }
    ?>
</section>

<?php
  include_once 'footer.php'
  ?>