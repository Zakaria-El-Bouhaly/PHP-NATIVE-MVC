<?php
require APPROOT . '/views/includes/head.php';
?>

<?php
require APPROOT . '/views/includes/navigation.php';
?>


<div class="container">
    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $feedback) : ?>
            <span>
                <?php echo $feedback . "\n"; ?>
            </span>
        <?php endforeach ?>
    <?php endif ?>

    <h1>
        Upload new project
    </h1>

    <form action="<?php echo URLROOT; ?>/projects/create" enctype="multipart/form-data" method="POST">
        <label for="">Title</label>
        <textarea name="title" required></textarea>

        <label for="">Description</label>
        <textarea class="description" name="description" required></textarea>

        <label for="">Attachements</label>
        <input type="file" name="file[]" multiple required>

        <input type="submit" value="Upload" name="submit">
    </form>
</div>