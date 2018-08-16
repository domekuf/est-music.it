<div class="row h-90 align-items-center" id="main">
    <div class="col-12 col-md-10 offset-md-1 text-justify h-75 long-content-wrapper jumbotron">
        <div class="row" style="min-height:100%">
            <?php foreach ([
                'bpFDhYEscvA',
                'sW5RD38L_VU',
                'qi18Gk75NQo'
            ] as $video_id) { ?>
            <div class="col-10 offset-1 col-md-6 offset-md-0 pb-4">
                <?= $this->fetch("/video-player-yt.php", ['video_id' => $video_id]) ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
