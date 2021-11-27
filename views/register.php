<?php

include_once "../config/core.php";

$page_title = "Register";

include_once "../login_checker.php";

include_once '../config/database.php';
include_once '../models/user.php';
include_once "../resource/libs/utils.php";

include_once "layout/layout_head.php";

echo "<div class='col-md-12'>";

// if form was posted
if($_POST){

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // initialize objects
    $user = new User($db);
    $utils = new Utils();

    // set user email to detect if it already exists
    $user->email=$_POST['email'];

    // check if email already exists
    if($user->emailExists()){
        echo "<div class='alert alert-danger'>";
        echo "The email you specified is already registered. Please try again or <a href='{$home_url}/views/login'>login.</a>";
        echo "</div>";
    }

    else{
        // set values to object properties
        $user->name=$_POST['name'];
        $user->contact_number=$_POST['contact_number'];
        $user->address=$_POST['address'];
        $user->password=$_POST['password'];
        $user->user_type=$_POST['user_type'];

        // create the user
        if($user->create()){

            echo "<div class='alert alert-info'>";
            echo "Successfully registered. <a href='{$home_url}views/login.php'>Please login</a>.";
            echo "</div>";

            // empty posted values
            $_POST=array();

        }else{
            echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
        }
    }
}

?>
    <form action='register.php' method='post' id='register'>

        <table class='table table-responsive'>

            <tr>
                <td class='width-30-percent'>Name*</td>
                <td><input type='text' maxlength="200" name='name' class='form-control' required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : "";  ?>" /></td>
            </tr>

            <tr>
                <td>Contact Number*</td>
                <td><input type='text' maxlength="15" name='contact_number' class='form-control' required value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number'], ENT_QUOTES) : "";  ?>" /></td>
            </tr>

            <tr>
                <td>Address</td>
                <td><textarea name='address' class='form-control'><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : "";  ?></textarea></td>
            </tr>

            <tr>
                <td>Email*</td>
                <td><input type='email' maxlength="200" name='email' class='form-control' required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>" /></td>
            </tr>

            <tr>
                <td>User Type*</td>
                <td>
                    <select name="user_type" required class="form-control">
                        <option value="" selected>Open this select menu</option>
                        <option <?php echo (isset($_POST['user_type']) && $_POST['user_type'] == "Customer") ? "selected" : ''?> value="Customer">Customer</option>
                        <option <?php echo (isset($_POST['user_type']) && $_POST['user_type'] == "Seller") ? "selected" : ''?> value="Seller">Seller</option>
                    </select>
                </tr>

            <tr>
                <td>Password*</td>
                <td><input type='password' minlength="6" maxlength="28" name='password' class='form-control' required id='passwordInput'></td>
            </tr>

            <tr>
                <td>Confirm Password*</td>
                <td>
                    <input type='password' minlength="6" maxlength="28" name='password_confirm' class='form-control' required id='passwordConfirmInput'>
                    <span id="message"></span>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary" id="register_button">
                        <span class="glyphicon glyphicon-plus"></span> Register
                    </button>
                </td>
            </tr>

        </table>
    </form>
<?php

echo "</div>";

// include page footer HTML
include_once "layout/layout_foot.php";
?>

<script>
    $( document ).ready(function() {
        $('#register_button').on('click', function (event){
            if ($('#passwordInput').val() !== $('#passwordConfirmInput').val()) {
                $('#message').html('Password & Confirm Password Mismatch').css('color', 'red');
                $('#message').show();
                event.preventDefault();
            }
            else {
                $('#message').hide();
            }

        });
    });

</script>
