<?php
require APPROOT . '/views/includes/head.php';
?>


<?php
require APPROOT . '/views/includes/navigation.php';
?>



<div class="container">

    <h2>Register</h2>

    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $feedback) : ?>
            <span>
                <?php echo $feedback . "\n"; ?>
            </span>
        <?php endforeach ?>
    <?php endif ?>

    <form action="<?php echo URLROOT; ?>/users/register" method="POST">
        <input type="hidden" name="type" value="register">
        <label for="">First Name</label>
        <input type="text" name="fname" placeholder="First Name" required>

        <label for="">Last Name</label>
        <input type="text" name="lname" placeholder="Last Name" required>

        <label for="">Student Code</label>
        <input type="text" name="s_code" placeholder="Student Code" required>


        <label for="">Major</label>
        <select name="Major" default="" required>
            <option value="GIIA">GIIA</option>
            <option value="GTR">GTR</option>
            <option value="GIND">GIND</option>
            <option value="GPMA">GPMA</option>
            <option value="GIIA">GATE</option>
        </select>

        <label for="">Email</label>
        <input type="email" name="email" placeholder="Email" required>

        <label for="">password</label>
        <input type="password" name="pass" placeholder="Password" required>

        <label for="">Confirm password</label>
        <input type="password" name="pass2" placeholder="Confirm Password" required>

        <input type="submit" value="Register" name="Register">
    </form>
    <h3><a href="<?php echo URLROOT; ?>/users/login">Already have an account ?</a></h3>

</div>