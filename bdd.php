<?php
try {
    $bdh = new PDO('mysql:host=178.170.39.101;dbname=s1_IsayevDB', 'u1_B8cE4o9sqw', 'j7A9dPE.esjl=eTGpPg@oxnn');
    $bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
