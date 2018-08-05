<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
        <meta name="HandheldFriendly" content="true" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?=TITLE?><?=$title?></title>
        <link rel="apple-touch-icon" sizes="57x57"         href="favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60"         href="favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72"         href="favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76"         href="favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114"       href="favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120"       href="favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144"       href="favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152"       href="favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180"       href="favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32"    href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96"    href="favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16"    href="favicon/favicon-16x16.png">
        <link rel="manifest"                               href="favicon/manifest.json">
        <meta name="msapplication-TileImage"            content="favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <meta name="msapplication-TileColor" content="#ffffff">
        <link rel="stylesheet" href="<?=BS?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=FA?>/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=RT?>/css/main.css">
        <link rel="stylesheet" href="<?=RT?>/css/first-letter.css">
    </head>
    <body>
    <main role="main" class="container-fluid">
    <header>
        <nav class="navbar navbar-light fixed-top d-none d-sm-inline text-uppercase text-center">
            <?php foreach ($nav as $k=>$n) {
                $link = $n["link"];
                $name = $n["name"];
                $first_letter = substr($name, 0, 1);
                $other_letters = substr($name, 1);
                $index = $k + 1;
            ?>
            <a href="<?=RT.$link?>"><span class="first-letter-<?=$index?>"><?=$first_letter?></span><span><?=$other_letters?></span></a>
            <?php } ?>
        </nav>
        <nav class="d-sm-none text-right">
            <a class="d-sm-none" href="#" data-toggle="modal" data-target="#menu-modal" role="button">
                <i class="fa fa-bars fa-2x"></i>
            </a>
        </nav>
    </header>
    <div class="modal fade" id="menu-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>EST</h5>
            <a role="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </a>
          </div>
          <div class="modal-body text-uppercase text-center">
            <?php foreach ($nav as $k=>$n) {
                $link = $n["link"];
                $name = $n["name"];
                $first_letter = substr($name, 0, 1);
                $other_letters = substr($name, 1);
                $index = $k + 1;
            ?>
            <a href="<?=RT.$link?>"><span class="first-letter-<?=$index?>"><?=$first_letter?></span><span><?=$other_letters?></span></a><br/>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div id="loader-wrapper">
    </div>
