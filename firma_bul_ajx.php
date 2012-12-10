<?php require_once('../../ayar/ayar.php');
header('Content-Type: text/html; charset=UTF-8'); 
try{
$dbh = new PDO('mysql:host='.$thost.';dbname='.$tdb.';charset=utf8', $tuser, $tpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) { echo "veri tabani baglanti problemi"; }


if(isset($_GET['term'])) {
$p_term = explode(' ',trim($_GET['term']));

$t = array();  $j = 0;
foreach($p_term as $term){
$j++;
$t[':term'.$j] = "%".$term."%";
}

try {
$f_tbl = $dbh->prepare("SELECT ac_firma.firma_id, ac_firma.firma_ismi, ac_firma.firma_tam_isim, ac_firma.vergi_no, ac_firma.f_kod, ac_adres.adres, ac_adres.sehir, ac_adres.ilce, ac_kisi.isim, ac_kisi.soyisim, ac_email.email, ac_tel.tel_no
FROM ac_firma 
LEFT JOIN ac_adres
ON ac_firma.firma_id=ac_adres.firma_id
LEFT JOIN ac_kisi
ON ac_kisi.firma_id=ac_adres.firma_id
LEFT JOIN ac_email
ON ac_email.firma_id=ac_adres.firma_id
LEFT JOIN ac_tel
ON ac_tel.firma_id=ac_adres.firma_id 
WHERE lower(ac_firma.firma_ismi) like lower( :term1 ) OR lower(ac_adres.adres) like lower( :term1 ) OR lower(ac_adres.sehir) like lower( :term1 )
OR lower(ac_adres.sehir) like lower( :term1 ) OR lower(ac_firma.vergi_no) like lower( :term1 ) OR lower(ac_adres.ilce) like lower( :term1 )
OR lower(concat(ac_firma.firma_ismi, ' ',ac_adres.sehir)) like lower( :term1 )
GROUP BY ac_firma.firma_ismi ");
$f_tbl->execute($t);
}catch (PDOException $e) { echo "Firma Bul Baglanti Problemi"; }
$fler = array();
$rows = $f_tbl->fetchAll(PDO::FETCH_ASSOC);
       foreach ($rows as $fir)
    {   	$fler[] = array('f_isim'=>$fir['firma_ismi'], 'label'=> $fir['firma_ismi'].' , '.$fir['sehir']);
 }

print json_encode($fler);



}
?>