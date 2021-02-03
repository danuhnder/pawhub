<?php
  include_once 'header.php'
  ?>
  <section class="signup-form">
      <h1>Sign up</h1>
      <form action="signup.inc.php" method="post">
        <input type="text" name="name" placeholder="What do the people who bring you food call you?">
        <input type="text" name="email" placeholder="Email address for the people who bring you food">
        <input type="password" name="password" placeholder="A secret word only you know. Don't tell the cat!">
        <input type="password" name="confirmpassword" placeholder="Give us that secret word again just in case.">

      </form>
  </section>

<?php
  include_once 'footer.php'
  ?>