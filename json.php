<?php

/**
 * Bu Proje By&Ebubekir Bastama Tarafın'dan 
Türkiyedeki "İl","İlçe","Mahalle","Sokak" İsimlerini en güncel isimlerini çekebilmesi için kodlanmıştır.
Geliştirmek isteyenler geliştirebilir :) Ayrıca Twitter'dan bi teşekkür'ünüzü Alırım. :)
 * Description of json Class
 * www.ebubekirbastama.com
 * @author By &Ebubekir Bastama
 */
class json {

    function curlverii($siteadresi, $text, $text1) {
        $post = [
            't' => $text,
            'u' => $text1,
        ];
        $ch = curl_init($siteadresi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        return $data = iconv("ISO-8859-9", "UTF-8", $response);
    }

    function jsonveri($siteadresi, $text, $text1) {
        $post = [
            't' => $text,
            'u' => $text1,
        ];
        $ch = curl_init($siteadresi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        return $data = json_decode(iconv("ISO-8859-9", "UTF-8", $response));
    }

    function combobaxcreate($siteadresi, $postveri1, $postveri2, $ilcedgr) {
        if ($ilcedgr == "sokak") {
            return $jsoni = $this->curlverii($siteadresi, $postveri1, $postveri2);
        } else {
            $jsoni = $this->jsonveri($siteadresi, $postveri1, $postveri2);
            echo '<form method="post" action="">'
            . '<select id="' . $ilcedgr . '" name="' . $ilcedgr . '">';
            foreach ($jsoni->yt as $value) {
                echo '<option name="' . $ilcedgr . '" value="' . $value->value . '">' . $value->text . '</option>';
            }
            echo '</select>'
            . '<input type="submit" name="submit"/>'
            . '</form>';
        }
    }

}
