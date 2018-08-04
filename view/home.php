<?php echo $this->fetch("/head.php", []);?>

<div class="row h-100 align-items-center text-center" id="home-main">
    <div class="offset-3 offset-sm-0 offset-md-3">
    </div>
    <?php
    foreach (str_split("est") as $letter) {
    ?>
    <div class="col-2 col-sm-4 col-md-2">
        <div class="letter">
            <img src="<?=RT?>img/est-<?=$letter?>-hover.png" class="hover">
            <img src="<?=RT?>img/est-<?=$letter?>.png" class="top">
        </div>
    </div>
    <?php
    }
    ?>
    <div class="offset-3 offset-sm-0 offset-md-3">
    </div>
</div>

<?php echo $this->fetch("/foot.php", []);?>
