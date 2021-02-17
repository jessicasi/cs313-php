<?php include '../common/header.php'?>

<h1 >Registration</h1>

<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>

<form method="post" action="/frankies/accounts/index.php" class="accountForms">
<div class="form-group  explain">
    
    <label for="people_fname">*First Name</label>
        <input type="text" class="form-control" name="people_fname" placeholder="First Name" id="people_fname" <?php if(isset($people_fname)){echo"value='$people_fname'";}  ?> required title="Required">
    </div>
    <div class="form-group  explain">
    <label for="people_lname">*Last Name</label>
        <input type="text" class="form-control" name="people_lname" placeholder="Last Name" id="people_lname" <?php if(isset($people_lname)){echo "value='$people_lname'";}  ?>required title="Required">
</div>
<div class="form-group  explain">

            <label for="people_email">*Email Address</label>
            <input type="email" class="form-control"name="people_email" id="people_email" 
            value='<?php if (isset($peopleEmail)) {echo $peopleEmail;
           } elseif (isset($_SESSION['peopleData']['people_email'])) {
           echo $_SESSION['peopleData']['people_email'];
            } ?>' placeholder="Email Address" required title="Required">
</div>

<div class="form-group  explain">
  
            <label for="people_password">*Password</label>
            <input type="password" class="form-control" name='people_password' placeholder="Password" required title="Required" id="people_password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            <small class="form-text text-muted explain">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</small>
        </div>

        <div class="form-group  explain">
       
            <input type="hidden" name="action" value="registerUser">
            <input type="submit" name="submit" value="Register">

    </div>
</form>
<?php
unset($_SESSION['message']);
?>
<?php include '../common/footer.php'?>