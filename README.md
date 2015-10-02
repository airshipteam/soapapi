# soapapi
A wrapper for Airship's SOAP API built for easy integration with Laravel 5
---

The package supports use with the [Laravel framework][2] (v5) 

----
###Setup:

In order to install add the following to your `composer.json` file within the `repositories` block:

```
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
$result = $airshipContact->getContact($contactid);
```

**Get Contact Email**

```
$result = $airshipContact->getContactEmail($contactemail);
```

**Lookup Contact By Last Name**

```
$result = $airshipContact->lookupContactByLastname($unitid, $lastname);
```

**Lookup Contact By UDF**

```
$result = $airshipContact->lookupContactByUDF($udfid, $udfvalue);
```

**Unsubscribe Contact**

```
$result = $airshipContact->unsubscribeContact($contacts);
```

**Unsubscribe Contact Group**

```
$result = $airshipContact->unsubscribeContactGroup($contactid, $groupid);
```

**Get UDF Value**

```
$result = $airshipContact->getUDFValue($contactid, $udfid);
```

**Set UDF Value**

```
$result = $airshipContact->setUDFValue($contactid, $udfid, $udfvalue, $sourceid);
```

**Get Interactions In Monitored Group**

```
$result = $airshipContact->getInteractionsInMonitoredGroup($groupid);
```


**Delete Interactions In Monitored Group**

```
$result = $airshipContact->deleteInteractionsInMonitoredGroup($records);
```

###Broadcast API:

Set your airship keys and server

```
$airshipBroadcast = new AirshipBroadcast();
$airshipBroadcast->authenticate($airship_server, $airship_username, $airship_password);
```

**Send New Eflyer**

```
$airshipBroadcast->unitID = 1234;
$airshipBroadcast->fromAddress = 'peter@tecks.com';
$airshipBroadcast->recipients = 'phileas_fogg@airship.co.uk';
$airshipBroadcast->subject = 'pie in the sky';
$airshipBroadcast->htmlContent '<html><body></body></html>';
$airshipBroadcast->textContent 'text';
$result = $airshipBroadcast->sendNewEflyer();
```

###Statistics API:

Set your airship keys and server

```
$airshipStatistics = new AirshipStatistics();
$airshipStatistics->authenticate($airship_server, $airship_username, $airship_password);
```

**Unit List**

```
$result = $airshipStatistics->unitList();
```

###WIFI Interaction API:

Set your airship keys and server

```
$airshipWifi = new AirshipWifiInteraction();
$airshipWifi->authenticate($airship_server, $airship_username, $airship_password);
```

**Create WIFI Interaction**

```
$airshipWifi->wifiinteraction_hotspot_name     = 'Airship Basket';
$airshipWifi->wifiinteraction_mac_name         = '00:A0:C9:14:C8:29';
$airshipWifi->wifiinteraction_device_mime_type = 'airshipapp';
$airshipWifi->wifiinteraction_interaction_type = 'detected';
$airshipWifi->wifiinteraction_contact_id       = 1234;
$result = $airshipWifi->createWifiInteraction();
```

**Create WIFI Interaction History**

```
$airshipWifi->wifiinteraction_hotspot_name     = 'Airship Basket';
$airshipWifi->wifiinteraction_mac_name         = '00:A0:C9:14:C8:29';
$airshipWifi->wifiinteraction_device_mime_type = 'airshipapp';
$airshipWifi->wifiinteraction_interaction_type = 'detected';
$airshipWifi->wifiinteraction_contact_id       = 1234;
$airshipWifi->wifiinteraction_created_datetime = '2015-04-01 19:40:41';
$result = $airshipWifi->createWifiInteractionHistory();
```

###Bookings API:

```
Set your airship keys and server

$airshipBooking = new AirshipBooking();
$airshipBooking->authenticate($airship_server, $airship_username, $airship_password);
```

**Get Bookings**

```
$params = array();
$params['EqualsArgs']['booking_contact_id'] = $contact_id; // exact match args

$params['InSQLArgs'] = array();
$params['InSQLArgs']['booking_unit_id'] = '121';

$params['GreaterThanArgs'] = array();
$params['LessThanArgs'] = array();
$params['myResultOptions'] = array(
	'result_limit' => '2',
	'result_offset' => '0'
);
$result = $airshipBooking->getBookings( $params );
```

**Get Booking Notes**

```
$booking_id = 614708;
$booking_notes = $_airship_booking->getBookingNotes( $booking_id );
```

**Get Booking Types**

```
$booking_types = $_airship_booking->getBookingTypes();
```

###Feedback API:

```
Set your airship keys and server

$airshipFeedback = new AirshipFeedback();
$airshipFeedback->authenticate($airship_server, $airship_username, $airship_password);
```

**Get Feedback**

```
$params = array();
$params['EqualsArgs'] = array();
$params['EqualsArgs']['feedback_contact_id'] = $contact_id; // exact match args

$params['InSQLArgs'] = array();
$params['InSQLArgs']['feedback_unit_id'] = '121';

$params['GreaterThanArgs'] = array();
$params['LessThanArgs'] = array();
$params['myResultOptions'] = array(
	'result_limit' => '10',
	'result_offset' => '0'
);
$result = $airshipBooking->getBookings( $params );
```

