<?php echo $this->fetch("/head.php", []);?>
<div class="row h-100 align-items-center" style="background:url('<?=RT?>img/bg-01.jpg');background-size:cover">
<div class="col-12 col-md-6 offset-md-3 text-dark text-center bg-light" style="opacity:0.8">
    <h1>RavenEventi.it</h1>
    <img src="<?=RT?>img/logo-02.png" alt="Raven eventi servizi per lo spettacolo">
    <p><?=json_encode($test) ?> </p>
    <p>La passione diventa lavoro</p>
    <p><a href="mailto:info@raveneventi.it">info@raveneventi.it</a></p>
</div>
</div>
<div class="row h-100 align-items-center text-center">
<?php
$cols = [[
        "class"=>"col-12 col-sm-4 d-lg-none",
        "class-lg"=>"col-4 d-none d-lg-block",
        "src"=>RT."img/circle-01.jpg",
        "size"=>140,
        "text"=>"Concerti",
        "modal_id" =>"modal-concerti",
        "modal_content" =>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel feugiat augue, a luctus nibh. Curabitur fringilla tortor sit amet vulputate malesuada. Phasellus eu interdum libero, eu hendrerit tellus. In a rhoncus eros. In placerat, lectus id hendrerit blandit, neque lacus lacinia quam, non condimentum nulla orci ut ligula. Ut vitae est vulputate, sodales orci sit amet, pretium sem. Etiam dictum euismod rutrum. Cras id enim a purus tincidunt elementum vel et est."]];

$cols[] = $cols[0];
$cols[] = $cols[0];

$cols[1]["text"] = "Allestimenti";
$cols[2]["text"] = "Teatro";

$cols[1]["src"] = RT."img/circle-02.jpg";
$cols[2]["src"] = RT."img/circle-03.jpg";

$cols[1]["modal_id"] = "modal-allestimenti";
$cols[2]["modal_id"] = "modal-teatro";

foreach ($cols as $col) {
?>
    <div class="modal fade in" id="<?=$col["modal_id"]?>" tabindex="-1" role="dialog" aria-labelledby="<?=$col["text"]?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=$col["text"]?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?=$col["modal_content"]?>
                </div>
            </div>
        </div>
    </div>
    <div class="<?=$col["class"]?>">
        <a href="#" data-toggle="modal" data-target="#<?=$col["modal_id"]?>">
            <img class="rounded-circle"
                src="<?=$col["src"]?>"
                alt="<?=$col["text"]?>" width="<?=$col["size"]?>" height="<?=$col["size"]?>">
        </a>
        <h2><?=$col["text"]?></h2>
    </div>
    <div class="<?=$col["class-lg"]?>">
        <img class="rounded-circle"
            src="<?=$col["src"]?>"
            alt="<?=$col["text"]?>" width="<?=$col["size"]?>" height="<?=$col["size"]?>">
        <h2><?=$col["text"]?></h2>
        <p>
            <?=$col["modal_content"]?>
        </p>
    </div>

<?php
}
?>
</div>
<div class="row h-100 align-items-center" style="background:url('<?=RT?>img/bg-04.jpg');background-size:cover">
    <div class="col-12 col-md-6 text-dark text-justify bg-light" style="opacity:0.8">
        <h2>Raven</h2>
        <p>
            É una cooperativa di servizi per lo spettacolo che fornisce personale specializzato e qualifcato al passo con le nuove tecnologie.
        </p>
        <p class="d-none d-sm-block">
            Si pone come interlocutore unico per la gestione in autonomia di tutti gli aspetti organizzativi,
            logistici e tecnici di un evento o di una manifestazione, dalla pianifcazione fino all'attuazione.
        </p>
        <h2>Offre</h2>
        <p class="d-none d-sm-block">
            Squadra tecnica con figure di diverso livello e genere pronti a rendere i servizi di cui si ha bisogno,
            comprensivi anche di impianti, attrezzature e strutture tecniche.
        </p>
        <p>
            Personale in regola con le normative vigenti in materia di sicurezza sul lavoro, in modo particolare
            nel settore dello spettacolo.
        </p>
    </div>
</div>
<div class="row h-100 align-items-center">
<div class="col-md-12 text-center">
    <h2>La nostra squadra</h2>
    <br/>
<?php
$cols = [[
        "class"=>"col-6 col-md-4",
        "src"=>RT."img/circle-01.jpeg",
        "size"=>70]];

$cols[] = $cols[0];
$cols[] = $cols[0];
$cols[] = $cols[0];
$cols[] = $cols[0];
$cols[] = $cols[0];

$cols[0]["text"] = "Tecnici audio, video, luci e backliners";
$cols[1]["text"] = "Servizio di facchinaggio";
$cols[2]["text"] = "Lavoro in quota";
$cols[3]["text"] = "Macchinisti";
$cols[4]["text"] = "Segretari di produzione";
$cols[5]["text"] = "Addetti antincendio e primo soccorso";

foreach ($cols as $col) {
?>
    <p><?=$col["text"]?></p>
<?php
}
?>
    </div>
</div>

<div class="row h-100 align-items-center" style="background:url('<?=RT?>img/bg-05.jpg');background-size:cover">
    <div class="col-12 col-md-6 offset-md-6 text-dark text-justify bg-light" style="opacity:0.8">
        <h2>Mission</h2>
        <p>
            Raven vuole essere un punto di riferimento per chi fa cultura e spettacolo nel nostro territorio e oltre,
            offrendo ai propri soci supporto, protezione e sicurezza, garantendo servizi professionali ai propri committenti.
        </p>
        <h2>I nostri valori</h2>
        <p>
            Passione, trasparenza, sicurezza e valorizzazione delle competenze
        </p>
    </div>
</div>
<?php echo $this->fetch("/foot.php", []);?>
