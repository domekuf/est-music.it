<div class="row h-100 align-items-center" id="main">
    <div class="col-12 col-md-10 offset-md-1 text-justify h-75 long-content-wrapper jumbotron">
        <p>
            Gli EST creano atmosfere in bilico tra classica, jazz, elettronica, non senza qualche incursione nella musica pop e rock. Una follia sonora che vede protagonista l'inconsueto organico di un trio d'archi formato da violino, violoncello e contrabbasso. Tutto il lavoro del trio si sviluppa a partire da arrangiamenti originali.  L'invenzione, l'ironia e l'improvvisazione sono il punto di partenza dal quale prende forma lo spettacolo degli EST.
        </p>
        <div class="row text-center text-capitalize">
            <?php
            foreach (["double-bass", "cello", "violin"] as $instrument) {
            ?>
            <div class="col-12 col-sm-4">
                <a href="#" data-toggle="modal" data-target="#modal-<?=$instrument?>">
                <img src="<?=asset("img/est-$instrument.png")?>" style="width:175%">
                <h5><?=$instrument?></h5>
                </a>
            </div>
            <?= $this->fetch("/modal.php", ['id' => "modal-$instrument", 'title' => $instrument]); ?>
            <?php
            }
            ?>
        </div>
    </div>
</div>
