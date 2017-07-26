<?php

//
//     $queryRoom = <<<SQL
//       SELECT r.r_nr AS Raum,
//         r.r_bezeichnung AS Raumbezeichnung,
//         r.r_notiz AS Raumnotiz,
//         ka.ka_komponentenart AS Komponentenart,
//         kat.kat_bezeichnung AS komponentenattribute
//       FROM raeume AS r
//       LEFT JOIN komponenten AS k
//         ON r.r_id = k.raeume_r_id
//       LEFT JOIN komponentenarten ka
//         ON k.komponentenarten_ka_id = ka.ka_id
//       LEFT JOIN komponente_hat_attribute AS kha
//         ON k.k_id = kha.komponenten_k_id
//       LEFT JOIN komponentenattribute AS kat
//         ON kha.komponentenattribute_kat_id = kat.kat_id;
//       /*WHERE r.r_nr = {$_GET['r_nr']};*/
// SQL;

//--------------Lieferanten----------------
  $querySupplier = <<<SQL
    SELECT l_id AS l_id, l_firmennname AS Firmenname, l_strasse AS Strasse, l_plz AS PLZ, l_ort AS Ort, l_tel AS Tel, l_mobil AS Mobil, l_fax AS Fax, l_email AS E-Mail FROM lieferant;
SQL;


//---------------Räume------------------------
  $queryRoom = <<<SQL
    SELECT r_nr AS Raumnummer, r_bezeichnung AS Bezeichnung FROM raeume;
SQL;

//--------------Benutzer-----------------------
  $queryUser = <<<SQL
    SELECT benutzer_id AS b_id, username AS Benutzername, passwort AS Passwort, rechte_id AS Rechte_id, benutzervorname AS Vorname, benutzernachname AS Nachname FROM benutzer;
SQL;

//--------------Komponenten--------------------
  $queryKomp = <<<SQL
    SELECT k.k_id AS ID,
      r.r_bezeichnung AS Raum,
      ka.ka_komponentenart AS Komponentenart,
      k.k_hersteller AS Hersteller,
      k.k_notiz AS Notiz,
      k.k_gewaehrleistungsdauer AS Gewährleistungsdauer,
      k.k_einkaufsdatum AS Einkaufsdatum,
      l.l_firmenname AS Lieferant,
    FROM komponenten AS k
    INNER JOIN raeume AS r
      ON k.raeume_r_id = r.r_id
    INNER JOIN lieferant AS l
      ON k.lieferant_l_id = l.l_id
    INNER JOIN komponentenarten AS ka
      ON k.komponentenarten_ka_id = ka.ka_id;
SQL;

//---------Komponentenarten----------------
  $queryKind = <<<SQL
    SELECT ka_id AS ka_id, ka_komponentenart AS Komponentenart FROM komponentenarten;
SQL;

//---------komponentenattribute----------------
  $queryKind = <<<SQL
    SELECT kat_bezeichnung AS Bezeichnung FROM komponentenattribute;
SQL;
?>
