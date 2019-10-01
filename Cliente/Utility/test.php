
<?php
$xmlstring='<data>
            <status>TRUE</status>
            <status_icon>success.png</status_icon>
            <message>Bienvenido  PEREZ OGARRIO, ZEUS</message>
            <locked_account></locked_account>
            <ID_USUARIOS>3</ID_USUARIOS>
            <ID_SESSION>TikMSAe0sdtmd0kgUj2wKVFSp</ID_SESSION>
            <user_name>ZEUS</user_name>
            <last_name>PEREZ OGARRIO</last_name>
            <root>TRUE</root>
            <image>user.png</image>
            <associateNumber></associateNumber>
            <gender>1</gender>
            <ID_PERFILES>1</ID_PERFILES>
            <ID_ESTADOS>26</ID_ESTADOS>
            <ID_DELEGACIONES>344</ID_DELEGACIONES>
            <profile>Desarrollador</profile>
            <state>Sonora</state>
            <delegation>Estatal</delegation>
            </data>';
$xml = simplexml_load_string($xmlstring);
//var_dump($xml);
$json = json_encode($xml);
echo $json;
$array = json_decode($json,TRUE);

?>
