<!DOCTYPE html>
<!--
Bu Proje By&Ebubekir Bastama Tarafın'dan 
Türkiyedeki "İl","İlçe","Mahalle","Sokak" İsimlerini en güncel isimlerini çekebilmesi için kodlanmıştır.
Geliştirmek isteyenler geliştirebilir :) Ayrıca Twitter'dan bi teşekkür'ünüzü Alırım. :)
-->
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <title>Siyah Muhafız (C.)</title>
    </head>
    <body>

        <?php
        header('Content-type: text/html; charset=UTF-8');
        include "json.php";
        $url = "https://adreskodu.dask.gov.tr/site-element/control/load.ashx";
        $json = new json();
        $jsoni = $json->jsonveri($url, 'il', '0');
        echo '<form  method="post" action="">'
        . '<select id="il" name="il">';
        foreach ($jsoni->yt as $value) {

            echo '<option name="ilname" value="' . $value->value . '">' . $value->text . '</option>';
        }
        echo '</select>'
        . '<input type="submit" name="submit"/>'
        . '</form>';
        if (isset($_POST["il"])) {
            echo '<br/>';
            $json->combobaxcreate($url, 'ce', $_POST["il"], "ilce");
        } elseif (isset($_POST["ilce"])) {
            echo '<br/>';
            $json->combobaxcreate($url, 'vl', $_POST["ilce"], "koy");
        } elseif (isset($_POST["koy"])) {
            echo '<br/>';
            $json->combobaxcreate($url, 'mh', $_POST["koy"], "mahalle");
        } elseif (isset($_POST["mahalle"])) {
            echo '<br/>';

            $jsoni = $json->combobaxcreate($url, 'sf', $_POST["mahalle"], "sokak");
            $dizi = explode("SEÇ", $jsoni);
            echo '<div class="container">'
            . '<ul class="list-group">';
            for ($index = 0; $index < count($dizi); $index++) {
                if ($index == 0) {
                    echo '<pre>';
                    $metin = str_replace("&nbsp;", "<br>", $dizi[$index]);
                    echo '<li class="list-group-item">' . $metin . '</li>';
                    echo '</pre>';
                } else {
                    echo '<pre>';
                    echo '<li class="list-group-item">' . $dizi[$index] . '</li>';
                    echo '</pre>';
                }
            }
            echo '</ul>'
            . '</div>';
        }
        ?>

    </body>
</html>
