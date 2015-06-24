# soapapi
A wrapper for Airship's SOAP API built for easy integration with Laravel 5
---

The package supports use with the [Laravel framework][2] (v5) 

----
###Setup:

In order to install add the following to your `composer.json` file within the `repositories` block:

```js
"repositories": [{
            "type": "vcs",
            "url": "https://github.com/airshipwebservices/soapapi"
        }
    ]

```

Add the following to your `composer.json` file within the `require` block:

```
"require": {
    "airshipwebservices/soapapi" : "dev-master"
	},
```

If using PSR-4, you need an additional line in you composer file. Add the following lines in composer.json, under the `autoload` parameter:

```
"autoload": {
		"psr-4": {
			"airshipwebservices\\soapapi\\" : "src"
		}
	},
```

Run the command `composer update`.

----

###Usage:

If you do not already have them, your Aiship API keys can be optained from contacting support@airship.co.uk.

At the top of your controller, include this plugin using the `use` keyword

```
<?php namespace App\Http\Controllers;
use airshipwebservices\soapapi\AirshipContact;
class MyController extends Controller {
```

Set your airship keys and server

```
$airship_server   = 'https://secure.powertext.co.uk/SOAP/V2/';
$airship_username = 'XXXXXXXXXX';
$airship_password = 'XXXXXXXXXX';
$airshipContact = new AirshipContact();
$airshipContact->authenticate($this->airship_server, $this->airship_username, $this->airship_password);
```

Create a new contact

```
  $airshipContact->contact['title'] = 'Mr';
	$airshipContact->contact['firstname']  = 'Peter';
	$airshipContact->contact['lastname']  = 'Tecks';
	$airshipContact->contact['email']     = 'peter@tecks.com';
	$airshipContact->groups[] = 1234;
	$airshipContact->udfs[] =  array("udfnameid"=>79, "data"=>"Test Co", "type"=>"Text");
	$airshipContact->create();
```
