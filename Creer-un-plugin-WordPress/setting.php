<?php
if(isset($_POST['submit'])){
  
    wp_tab();
    insert_data();
}



 

function wp_tab(){


  require_once(ABSPATH . 'wp-config.php');
  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
  mysqli_select_db($connection, DB_NAME);

    $sql = "CREATE TABLE FistPlugins(id int NOT NULL PRIMARY KEY AUTO_INCREMENT, username varchar(255) NOT NULL,fname varchar(255) NOT NULL,password varchar(255) NOT NULL, descriptions varchar(255) NOT NULL, Options varchar(255) NOT NULL)";
    $result = mysqli_query($connection, $sql);
    return $result;

}

function insert_data(){

  require_once(ABSPATH . 'wp-config.php');
  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
  mysqli_select_db($connection, DB_NAME);

  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $password = $_POST['password'];
  $descriptions = $_POST['descriptions'];
  $Options = $_POST['Options'];

    if(empty($_POST['username']) || empty($_POST['fname']) || empty($_POST['password']) || empty($_POST['descriptions']) || empty($_POST['Options']))
    {
     echo '<h1 style="color:red;">All fields are required</h1>';
     
    }
    else
    {
         $query="INSERT INTO FistPlugins (username,fname,password,descriptions,Options)" . "VALUES ('$username','$fname','$password', '$descriptions', '$Options')";
         $result=mysqli_query($connection,$query);
    }
}

?>

<div class="wrap">
 
  <h2>Plugin Settings</h2>
 
  <div class="metabox-holder">
    <div class="postbox">
      <h3><strong>Enter your information and press save</strong></h3>
      <form method="post" action="">
        <table class="form-table">
          <tr>
            <th scope="row"></th>
            <td><input type="text" name="username" value="" style="width:350px;" placeholder="First name " /></td>
          </tr>
          <tr>
            <th scope="row"></th>
            <td><input type="text" name="fname" value="" style="width:350px;" placeholder="Last name " /></td>
          </tr>
          <tr>
            <th scope="row"></th>
            <td><input type="password" name="password" value="" style="width:350px;" placeholder="Password" /></td>
          </tr>
          <tr>
            <th scope="row"></th>
            <td><textarea name="descriptions" value="" style="width:350px;" placeholder="Description"></textarea></td>
          </tr>

          <tr>
            <th scope="row"></th>
            <td><select name="Options" style="width:350px;">
                <option value="">--Select--</option>
                <option name="OptionA" value="OptionA">Admin</option>
                <option name="OptionB" value="OptionB">User</option>
            </td>
          </tr>

          <tr>
            <th scope="row">&nbsp;</th>
            <td style="padding-top:10px;padding-bottom:10px;">
              <input type="submit" name="submit" value="Save" class="button-primary" style="width:10%;" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>