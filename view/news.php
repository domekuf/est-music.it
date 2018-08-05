<div class="row h-100 align-items-center" id="main">
    <div class="col-12 col-md-10 offset-md-1 text-justify h-75 long-content-wrapper jumbotron">
<?php
if (count($news["data"]) == 0) {
?>
    <p>
        Ancora nessuna notizia qui.
    </p>
<?php
}
?>
<?php
foreach ($news["data"] as $n) {
    if (isset($n["message"])) {
        $date = new DateTime($n["created_time"]);
?>
    <span class="text-muted text-monospace">
    <?= $date->format("d-m-Y") ?>
    </span>
    <p>
    <?= $n["message"] ?> <br>
    </p>
    <hr>
<?php
    }
}
?>
    </div>
</div>
