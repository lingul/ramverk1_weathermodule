# ramverk1-weathermodule
Weather module for redovisa webpage within the course ramverk1.

## Installation
* Install the module by adding the name to your composer or going to your anax installation folder and write(Latest version may change):
```
composer require lingul/ramverk1-weathermodule ^v1.2.1
```


* Install using scaffold postprocessing script file
```
bash vendor/lingul/ramverk1-weathermodule/.anax/scaffold/postprocess.d/700_weather.bash
```
* Enter the api keys
```
<?php
return [
    "ipstack" => 'Enter Ipstack key here',
];
```
