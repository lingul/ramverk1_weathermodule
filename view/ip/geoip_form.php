<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<h1>GeoIP Checker</h1>
<p>Ange en IP adress för att hitta platsinformation.</p>
<form method="post">
    <label for="ip"IP Adress: <label>
    <input type="text" name="ip" placeholder="Ange ip" value="<?= htmlentities($ip) ?>">
    <input type="submit" name="check" value="Check">
</form>

<h4>Json</h4>
<p>Validera IP och visa information med JSON.</p>
<form action="./api_geoip" method="get">
    <label for="ip"IP Adress: <label>
    <input type="text" name="ip" placeholder="Ange ip" value="<?= htmlentities($ip) ?>">
    <input type="submit" value="Check">
</form>

<p>Formuläret skickar en GET-request till <code>./api_geoip</code> med din IP adress likt <code>api_geoip?ip=&lt;IP&gt;</code></p>
<p>Svaret visar relevant information i JSON format.</p>

<strong>Exempel routes</strong>
<p><a href="./api_geoip?ip=8.8.8.8">8.8.8.8</a> Googles IP</p>
<p><a href="./api_geoip?ip=8.8.8.8.8">8.8.8.8.8</a> Validerar ej</p>
