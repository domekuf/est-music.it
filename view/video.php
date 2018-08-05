<div class="row h-100 align-items-center" id="main">
    <div class="col-12 col-md-10 offset-md-1 text-justify h-75 long-content-wrapper jumbotron">
    <?php foreach ([
        'bpFDhYEscvA',
        'sW5RD38L_VU',
        'qi18Gk75NQo'
    ] as $video_id) { ?>
        <?= $this->fetch("/video-player-yt.php", ['video_id' => $video_id]) ?>
        <hr>
    <?php } ?>
    </div>
</div>
