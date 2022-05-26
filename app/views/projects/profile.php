<?php
require APPROOT . '/views/includes/head.php';
?>

<?php
require APPROOT . '/views/includes/navigation.php';
?>



<div class="container" style="background-color:rgb(70, 180, 172);">

    <?php if (!empty($data)) : ?>

        <h1>Projects by</h1>

        <h3><?php $data[0]['fname'] . " " . $data[0]['lname'] ?></h3>

        <?php foreach ($data as $row) : ?>

            <div class="project">
                <h3><?php echo $row['added_at']; ?></h3>
                <h1><?php echo $row['Title']; ?></h1>
                <p><?php echo $row['Description']; ?></p>

                <a href="<?php echo URLROOT . "/projects/download/" . $row['directory']; ?>" id="<?php echo $row['id'] ?>" onclick="count_up(this.id)">Download files : <?php echo $row['download_count'] ?></a>




                <script type="text/javascript">
                    function count_up(id) {
                        $.ajax({
                            method: "GET",
                            url: "../count_up",
                            data: {
                                pid: id,
                            },
                            success: function(data) {
                                $('#' + id).html('Downloads : ' + data);

                            }
                        });
                    }
                </script>


            </div>
        <?php endforeach ?>
    <?php endif ?>

</div>