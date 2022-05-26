<?php
require APPROOT . '/views/includes/head.php';
?>

<?php
require APPROOT . '/views/includes/navigation.php';
?>

<div class="container" style="background-color:teal;">

    <?php if ($data != null) : ?>

        <h2><?php echo count($data) . " found" ?></h2>

    <?php endif; ?>

    <?php foreach ($data as $row) : ?>

        <div class="project">
            <h3><?php echo $row['added_at']; ?></h3>
            <a href="<?php echo URLROOT . "/projects/profile/" . trim($row["publisher_id"]) ?>"><?php echo $row['fname'] . "  " . $row['lname']; ?></a>
            <h1><?php echo $row['Title']; ?></h1>
            <p><?php echo $row['Description']; ?></p>
            <a href="<?php echo URLROOT . "/projects/download/" . $row['directory']; ?>">Download files : <?php echo $row['download_count'] ?></a>
        </div>

    <?php endforeach; ?>


</div>