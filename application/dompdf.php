<?php

    require_once "./../vendor/autoload.php";

    $html = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
        <h1>This is a Document now</h1>
        <h6>cool.</h6>
    </body>
    </html>";

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $dompdf->stream();

?>
