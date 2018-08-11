<div class="row h-90 align-items-center text-center" id="home-main">
    <?php
    foreach (str_split("est") as $letter) {
    ?>
    <div class="col-12 col-sm-4">
        <div class="letter">
            <img src="<?=asset("img/est-$letter-hover.png")?>" class="hover">
            <img src="<?=asset("img/est-$letter.png")?>" class="top">
        </div>
    </div>
    <?php
    }
    ?>
</div>
