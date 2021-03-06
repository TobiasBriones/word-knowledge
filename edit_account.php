<!--
  -- Copyright (c) 2015 Tobias Briones
  -- All rights reserved.
  --
  -- This source code is licensed under the BSD 3-Clause license found in the
  -- LICENSE file in the root directory of this source tree.
  -->

<?php
require "backend/Src/Database/UsersDB.php";
require "backend/Src/Model/User.php";
require "backend/Src/UserManager.php";

$user = null;

try {
    $conn = UsersDB::newInstance();
    $user = UserManager::retrieveUser($conn);

    if ($user == null || !$user->userExists) {
        header("Location: login.php");
        exit();
    }
}
catch (PDOException $e) {
    echo "There were problems to connect<br>";
    exit();
}

?>

<!doctype html>
<html lang="en">

  <head>
    <title>Edit account</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
    <link rel="stylesheet"
          type="text/css"
          href="libs/materialize/css/materialize.min.css"
          media="screen, projection">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
  </head>

  <body>

    <div class="row container">
      <form id="form"
            class="col s12 m7 l6"
            enctype="multipart/form-data"
            action="backend/process/edit_user_account.php"
            method="post">

        <div class="row">
          <div class="input-field col s12">
            <input class="white-text" id="user" name="user" type="text" length="25">
            <label for="user">User</label>
          </div>
        </div>

        <div class="row">
          <div class="file-field input-field col s12">
            <input class="file-path white-text" id="avatar" type="text" />
            <label for="avatar">Avatar</label>
            <div class="btn blue-grey darken-3" id="avatar_btn">
              <span>SELECT</span>
              <input type="file" accept="image/*" name="avatar" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input class="white-text" type="password" id="password" name="password">
            <label for="password">Password</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input class="white-text" type="password" id="confirm_password" name="confirm_password">
            <label for="confirm_password">Confirm password</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
						<textarea id="information"
                      class="white-text materialize-textarea"
                      name="information"
                      length="300"
                      placeholder="Your occupations, english knowledge...">
            </textarea>
            <label for="information">
              Information about yourself (optional)
            </label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input class="btn cyan darken-4" type="submit" name="send" value="Register">
          </div>
        </div>

      </form>

      <div class="col s12 m7 l6" id="input_errors"></div>

    </div>

    <script src="libs/jquery-dist-3.5.0/jquery.min.js"></script>
    <script src="libs/materialize/js/materialize.min.js"></script>
    <script src="js/register.js"></script>

  </body>

</html>
