[![Build Status](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/badges/build.png?b=master)](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/build-status/master)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/?branch=master)

[![Code Coverage](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/?branch=master)

[![Build Status](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/badges/build.png?b=master)](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/build-status/master)

[![Code Intelligence Status](https://scrutinizer-ci.com/g/lingul/ramverk1_weathermodule/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

[![CircleCI](https://circleci.com/gh/lingul/ramverk1_weathermodule.svg?style=svg)](https://circleci.com/gh/lingul/ramverk1_weathermodule)

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
* Enter the api key in config/api.php
```
<?php

    return ["enter apikey", "enter apikey"];
```
