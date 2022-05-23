<?php
require APPROOT . '/views/includes/head.php';
?>

<?php
require APPROOT . '/views/includes/navigation.php';
?>


<div class="container">



    <h2>Login</h2>

    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $feedback) : ?>
            <span>
                <?php echo $feedback . "\n"; ?>
            </span>
        <?php endforeach ?>
    <?php endif ?>

    <form action="<?php echo URLROOT; ?>/users/login" method="POST">
        <input type="hidden" name="type" value="sign_in">
        <label for="">student identifier</label>
        <input type="text" name="login_code" required>
        <label for="">password</label>
        <input type="password" name="pass" required>
        <input type="submit" value="login" name="login" required>
        <h3><a href="<?php echo URLROOT; ?>/users/register">Register a new account</a></h3>

    </form>

</div>