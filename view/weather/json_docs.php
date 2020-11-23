<?php

namespace Anax\View;
?>
<p>
REST API to get weather using ip address or latitude, longitude.
<br>
<b>How to use</b>
<br>
<i>/htdocs/jsonweather/json?[type]&[ipMap]</i>
<ul>
    <li><strong>type</strong></li>
    There are two types
    <ul>
        <li>Kommande</li>
        <li>Historik</li>
    </ul>
    'Historik' shows weather for the past 30 days,
    'Kommande' shows upcoming weather
    <br><br>
    <li><strong>ipMap</strong></li>
    There are two ways to get weather
    <ul>
        <li>public Ipv4 or ipv6 address</li>
        <li>latitude,longitude</li>
        Using latitude,longitude will not provide with geological position.
    </ul>
</ul>
<br><b>Example call</b>
</p>
<pre>
    <code>

/htdocs/jsonweather/json?type=Kommande&ipMap=59.3791389465332,13.500800132751465

{
"check": null,
"hostname": null,
"type": null,
"lat": "59.3791389465332",
"long": "13.500800132751465",
"country": null,
"region": null,
"weather": [
    {
        "date": "2019-11-24",
        "summary": "Overcast throughout the day."
    },
    {
        "date": "2019-11-25",
        "summary": "Overcast throughout the day."
    },
    {
        "date": "2019-11-26",
        "summary": "Possible drizzle until morning, starting again in the evening."
    },
    {
        "date": "2019-11-27",
        "summary": "Light rain throughout the day."
    },
    {
        "date": "2019-11-28",
        "summary": "Light rain throughout the day."
    },
    {
        "date": "2019-11-29",
        "summary": "Possible flurries in the morning and afternoon."
    },
    {
        "date": "2019-11-30",
        "summary": "Partly cloudy throughout the day."
    },
    {
        "date": "2019-12-01",
        "summary": "Clear throughout the day."
    }
]
}
</code>
</pre>
