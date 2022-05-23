<div class="elements">
    <a class="home" href="<?php echo URLROOT; ?>/projects/create"><img src="<?php echo URLROOT ?>/public/img/icon.png" style="height:50px;" alt=""></a>

    <?php if (isset($_SESSION['session_id'])) : ?>

        <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>

        <form method="GET" action="<?php echo URLROOT; ?>/projects/search" autocomplete="off">
            <input type="text" name="project_title" onkeyup="search(this.value)" placeholder="search / type space to list all projects" required>
            <select id="major" name="Major" default="" required>
                <option value="GIIA">GIIA</option>
                <option value="GIND">GIND</option>
                <option value="GPMA">GPMA</option>
                <option value="GTR">GTR</option>
                <option value="GIIA">GATE</option>
            </select>
            <input type="submit" name="submit" value="search">
            <div id="results"></div>
        </form>
        <a class="profile" href=<?php echo URLROOT . "/projects/profile/" . $_SESSION["session_id"]  ?>>Profile </a>
    <?php else : ?>
        <a href="<?php echo URLROOT; ?>/users/login">Login</a>
        <a href="<?php echo URLROOT; ?>/users/register">Register</a>
    <?php endif; ?>
</div>




<script type="text/javascript">
    function search(str) {
        $.ajax({
            method: "GET",
            url: "quick_search",
            data: {
                q: str,
                major: $("#major").val(),
            },
            success: function(data) {
                $("#results").html("");
                if (data) {
                    const arraydata = JSON.parse(data);
                    for (var i = 0; i < arraydata.length; i++) {
                        var link = "<a href='#'>" + arraydata[i]["Title"].substring(0, 10) + " | By :" + arraydata[i]["fname"] + "  " + arraydata[i]["lname"] + " | " + arraydata[i]["added_at"] + "</a>";                     
                        $("#results").append(link);
                    }
                    $("#results").css("display,block");
                }
            }
        });
    }
</script>