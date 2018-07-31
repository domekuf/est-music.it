<?php echo $this->fetch("/head.php", []);?>
<div class="row h-100 align-items-center" id="main">
    <div class="col-12 text-center">
<?php
foreach ($news["data"] as $n) {
    if (isset($n["message"])) {
?>
    <h2>
    <?= $n["created_time"] ?> <br>
    </h2>
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
