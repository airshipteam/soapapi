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
$airshipContact   = new AirshipContact();
$airshipContact->authenticate($airship_server, $airship_username, $airship_password);
```

**Create or update a contact**

```
$airshipContact->contact['title']           = 'Mr';
$airshipContact->contact['gender']          = 'M';
$airshipContact->contact['firstname']       = 'Peter';
$airshipContact->contact['lastname']        = 'Tecks';
$airshipContact->contact['email']           = 'peter@tecks.com';
$airshipContact->contact['mobilenumber']    = '07706000000';
$airshipContact->contact['allowsms']        = 'Y';
$airshipContact->contact['allowemail']      = 'Y';

$airshipContact->groups[]                   = 1234;
$airshipContact->udfs[]                     = array("udfnameid"=>79, 
                                                    "data"=>"Test Co", 
                                                    "type"=>"Text");
$result = $airshipContact->createContact();
```

The above would return:

```
stdClass Object
(
    [status] => true
    [response] => 11136842
)
```

An error response returns:

```
stdClass Object
(
    [status] => false
    [error_number] => 1
    [error_message] => SOAP Fault
    [error_customer] => Email address is invalid
    [soap_fault] => Email address is invalid
)
```

`error_number => 1` signifies a fault returned by Airship's server and the `soap_fault` parameter details this fault; the `soap_fault` parameter is only returned with `error_number => 1`

the `error_customer` is a customer friendly error message. 

**Get Contact**

```
$result = $this->_airshipContact->getContact($contactid);
```

**Get Contact Email**

```
$result = $this->_airshipContact->getContactEmail($contactemail);
```

**Lookup Contact By Last Name**

```
$result = $this->_airshipContact->lookupContactByLastname($unitid, $lastname);
```

**Lookup Contact By UDF**

```
$result = $this->_airshipContact->lookupContactByUDF($udfid, $udfvalue);
```

**Unsubscribe Contact**

```
$result = $this->_airshipContact->unsubscribeContact($contacts);
```

**Unsubscribe Contact Group**

```
$result = $this->_airshipContact->unsubscribeContactGroup($contactid, $groupid);
```

**Get UDF Value**

```
$result = $this->_airshipContact->getUDFValue($contactid, $udfid);
```

**Set UDF Value**

```
$result = $this->_airshipContact->setUDFValue($contactid, $udfid, $udfvalue, $sourceid);
```

**Get Interactions In Monitored Group**

```
$result = $this->_airshipContact->getInteractionsInMonitoredGroup($groupid);
```


**Delete Interactions In Monitored Group**

```
$result = $this->_airshipContact->deleteInteractionsInMonitoredGroup($records);
```
