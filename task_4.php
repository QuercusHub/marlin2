<?php
// В этом задании пришлось на секунду подсмотреть в ответе массив,
// мой изначальный вариант  $array2
// с двойным проходом foreach, ну ничего не выходило, после пришлось подсмотреть
//    $array2 = ["My Tasks" => ["style" => "bg-fusion-400",
//                             "name" => "130 / 500",
//                             "progress" => 65],
//              "Transfered" => ["style" => "bg-success-500",
//                               "name" => "440 TB",
//                               "progress" => 34],
//              "Bugs Squashed" => ["style" => "bg-info-400",
//                                  "name" => "77%",
//                                  "progress" => 77],
//              "User Testing" => ["style" => "bg-primary-300",
//                                 "name" => "7 days",
//                                 "progress" => 84]
//        ];
    $array = [
            [
                "name" => "My Tasks",
                "title" => "130 / 500",
                "style" => "bg-fusion-400",
                "width" => 65,
                "aria-valuenow" => 65,
                "aria-valuemin" => 0,
                "aria-valuemax" => 100,
            ],
            [
                "name" => "Transfered",
                "title" => "440 TB",
                "style" => "bg-success-500",
                "width" => 34,
                "aria-valuenow" => 34,
                "aria-valuemin" => 0,
                "aria-valuemax" => 100,
            ],
            [
                "name" => "Bugs Squashed",
                "title" => "77%",
                "style" => "bg-info-400",
                "width" => 77,
                "aria-valuenow" => 77,
                "aria-valuemin" => 0,
                "aria-valuemax" => 100,
            ],
            [
                "name" => "User Testing",
                "title" => "7 days",
                "style" => "bg-primary-300",
                "width" => 84,
                "aria-valuenow" => 74,
                "aria-valuemin" => 0,
                "aria-valuemax" => 100,
            ],
    ];

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
        <main id="js-page-content" role="main" class="page-content">
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <?php foreach ($array as $value): ?>
                                <div class="d-flex mt-2">
                                    <?= $value["name"] ?>
                                    <span class="d-inline-block ml-auto"><?= $value["title"] ?></span>
                                </div>
                                <div class="progress progress-sm mb-3">
                                    <div class="progress-bar <?= $value["style"] ?>" role="progressbar" style="width: <?= $value["width"] ?>%;" aria-valuenow="<?= $value["aria-valuenow"] ?>" aria-valuemin="<?= $value["aria-valuemin"] ?>" aria-valuemax="<?= $value["aria-valuemax"] ?>"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            // default list filter
            initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
            // custom response message
            initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
        </script>
    </body>
</html>
