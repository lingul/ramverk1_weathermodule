<?php

namespace Anax\View;

?>
<!-- <script src="../view/ip/OpenLayers.js"></script> -->
<form>
    <fieldset>
    <legend>Try ip adress</legend>
    <p>
        <input type="radio" name="type" value="Historik">Historik, 30 dagar<br>
        <input type="radio" name="type" value="Kommande" checked="checked">Kommande väder<br /><br />
        <label>IP Adress alternativt latitude, longitude:<br>
        <input type="text" name="ipMap" value="<?=$localIP?>"/ required>
        </label>
    </p>

    <p>
        <input type="submit">
    </p>
    </fieldset>
</form>

<?php if (is_string($hist)) : ?>
    <?=$hist?>
<?php endif; ?>
<p><?=$check?></p>
<?php if (isset($type)) : ?>
    <p>Ipv<?=$type?></p>
    <p>longitude=<?=$long?> | latitude=<?=$lat?></p>
    <p>Land=<?=$country?> | region=<?=$region?></p>
    <p>Domain: <?=$hostname?></p>
<?php endif;?>
<?php if (sizeof($tja) != 0) : ?>
<table style="width:100%">
    <tr>
        <th>Date</th>
        <th>Description</th>
    </tr>
    <?php
    $i = 0;
    foreach ($tja as $day) : ?>
    <tr>
        <td align="center"><?=$dates[$i]?></td>
        <td align="center"><?=$day?></td>
    </tr>
        <?php
        $i += 1;
    endforeach; ?>
</table>
<?php endif; ?>
<?php if (!is_string($hist)) : ?>
<div id="map" style="width: 100%; height: 450px;"></div>

<link rel="stylesheet" href="<?=url("css/leaflet.css")?>"/>
<script src="<?=url("js/leaflet.js")?>"></script>
<script type="text/javascript">
    var map = new L.Map('map');
    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = 'Map data &copy; 2018 OpenStreetMap contributors',
    osm = new L.TileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });
    map.setView(new L.LatLng(<?=$lat?>, <?=$long?>), 13).addLayer(osm);
    var marker = L.marker([<?=$lat?>, <?=$long?>]).addTo(map);
</script>
<?php endif?>
