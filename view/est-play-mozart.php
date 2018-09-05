<div class="row h-90 align-items-center" id="main">
    <div class="col-12 text-justify h-75">
        <div class="row">
            <div class="col-10 offset-1 text-center">
                <p >
Cosa penserebbe Mozart del lavoro che gli EST gli hanno dedicato ? Non lo sapremo mai ! Dalle sue lettere e dalla sua personalità esuberante sappiamo però con certezza che Mozart era uno sperimentatore, sempre pronto a trovare nuove vie compositive e inedite idee musicali. Lo stupore e la meraviglia erano i sentimenti che Mozart sperava di suscitare nel suo pubblico. Ai giorni nostri la musica di ogni epoca e di qualsiasi genere è perfettamente accessibile e i confini tra i diversi ambienti musicali in tanti casi si fanno più indefiniti. Gli EST partono da questo quadro e attraverso arrangiamenti originali composti dagli stessi membri fanno rivivere le musiche del compositore viennese in una chiave inedita. Dal jazz alla bossanova, dal gipsy al valzer ogni esperienza musicale  trova spazio nella loro musica; che si avvale anche di effetti e loop station. Violino ( elettrico e acustico ), Violoncello ( elettrico e acustico ) e Contrabbasso danno voce a queste follie sonore. Nicola Nieddu, Antonio Cortesi e Luca di Chiara vengono da esperienze musicali diverse ma anche tanto lavoro insieme nella realtà della Corelli di Ravenna e una profonda amicizia che li lega da anni. Difficile definire in maniera univoca il loro Mozart ma sicuramente l'invenzione e l'ironia la fanno da padrona assieme all'improvvisazione e ogni effetto sonoro strumentale viene usato come spunto coloristico.
                </p>
                <div class="row">
                    <?php 
 	            $tracks = [485001885, 485001879, 485001939];
	            foreach ($tracks as $track) { ?>
		    <div class="col-12 col-md-4">
	                <?= $this->fetch("/audio-player-sc.php", ["audio_id" => $track]); ?>
	            </div>
	            <?php } ?>
                </div>
           </div>
       </div>
    </div>
</div>
