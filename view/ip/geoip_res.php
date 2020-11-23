<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?>
<h1>IP Checker</h1>

<?php
if ($ip) {?>
    <p>IP: <?= htmlentities($ip) ?></p>
    <p>IP-typ: <?= htmlentities($ip_type) ?></p>
    <p>Land: <?= htmlentities($country_name) ?></p>
    <p>Stad: <?= htmlentities($city) ?></p>
    <p>Region: <?= htmlentities($region) ?></p>
    <?php
} else {
    ?>
    <p>Ingen hittad IP</p>
    <?php
}
?>
<a href="">Gå tillbaka?</a>
