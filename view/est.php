<div class="row h-100 align-items-center text-center" id="est-main">
    <div class="col-10 offset-1 mt-5">
        <p>
            Gli EST creano atmosfere in bilico tra classica, jazz, elettronica, non senza qualche incursione nella musica pop e rock. Una follia sonora che vede protagonista l'inconsueto organico di un trio d'archi formato da violino, violoncello e contrabbasso. Tutto il lavoro del trio si sviluppa a partire da arrangiamenti originali.  L'invenzione, l'ironia e l'improvvisazione sono il punto di partenza dal quale prende forma lo spettacolo degli EST.
        </p>
    </div>

    <?php
    foreach ($est as $instrument=>$bio) {
    ?>
    <div class="col-12 col-sm-4">
        <a href="#" data-toggle="modal" data-target="#modal-<?=$instrument?>">
            <h5 class="text-capitalize"><?=$instrument?></h5>
            <div class="letter">
                <img src="<?=asset("img/est-$instrument-hover.png")?>" class="hover">
                <img src="<?=asset("img/est-$instrument.png")?>" class="top">
            </div>
        </a>
    </div>
    <?php
        $modals .= $this->fetch("/modal.php", ['id' => "modal-$instrument", 'title' => $instrument, 'content' => $bio]);
    }
    ?>
</div>
<?= $modals ?>
