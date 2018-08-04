<?php echo $this->fetch("/head.php", []);?>
<div class="row h-100 align-items-center" id="main">
    <div class="col-12 col-md-6 offset-md-3 text-justify h-75 long-content-wrapper jumbotron">
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
<?php
    }
}
?>
    </div>
</div>

<?php echo $this->fetch("/foot.php", []);?>
