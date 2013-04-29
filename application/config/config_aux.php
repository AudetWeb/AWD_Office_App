<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* This File is Autoloaded - check autoload.php */

/*
|--------------------------------------------------------------------------
| Roles - ID and Labels
|--------------------------------------------------------------------------
|
*/

$config['user_roles'] = array(
                             '0' => 'Nobody',
                             '1' => 'Chorus',
                             '2' => 'Admin'
                             );

/*
|--------------------------------------------------------------------------
| Yes or No - Options list
|--------------------------------------------------------------------------
|
*/

$config['yesnoList'] = array(
                             '-' => '---',
                             'Y' => 'Yes',
                             'N' => 'No'
                             );

/*
|--------------------------------------------------------------------------
| User Status - ID and Labels
|--------------------------------------------------------------------------
|
*/

$config['user_status'] = array(
                             '1' => 'Active',
                             '0' => 'Inactive'
                             );
                             
/*
|--------------------------------------------------------------------------
| Active/Inactive - ID and Labels
|--------------------------------------------------------------------------
|
*/

$config['activeInactiveList'] = array(
                             '1' => 'Active',
                             '0' => 'Inactive'
                             );
/*
|--------------------------------------------------------------------------
| Weekdays - Names of weekdays
|--------------------------------------------------------------------------
|
*/

$config['weekdaysList'] = array(
                             '-' => 'Select your rehearsal day',
                             'SUN' => 'Sunday',
                             'MON' => 'Monday',
                             'TUE' => 'Tuesday',
                             'WED' => 'Wednesday',
                             'THU' => 'Thursday',
                             'FRI' => 'Friday',
                             'SAT' => 'Saturday'
                             );

/*
|--------------------------------------------------------------------------
| State List - List of US States - abbreviation-name
| N.B. Leave first value empty so that we can test for non-blank value
| using jQuery validation or similar.
|--------------------------------------------------------------------------
|
*/

$config['stateList'] = array(
                             ''  => "Please select a state",
                            'AL' => "Alabama",
                            'AK' => "Alaska",
                            'AZ' => "Arizona",
                            'AR' => "Arkansas",
                            'CA' => "California",
                            'CO' => "Colorado",
                            'CT' => "Connecticut",
                            'DE' => "Delaware",
                            'DC' => "District Of Columbia",
                            'FL' => "Florida",
                            'GA' => "Georgia",
                            'HI' => "Hawaii",
                            'ID' => "Idaho",
                            'IL' => "Illinois",
                            'IN' => "Indiana",
                            'IA' => "Iowa",
                            'KS' => "Kansas",
                            'KY' => "Kentucky",
                            'LA' => "Louisiana",
                            'ME' => "Maine",
                            'MD' => "Maryland",
                            'MA' => "Massachusetts",
                            'MI' => "Michigan",
                            'MN' => "Minnesota",
                            'MS' => "Mississippi",
                            'MO' => "Missouri",
                            'MT' => "Montana",
                            'NE' => "Nebraska",
                            'NV' => "Nevada",
                            'NH' => "New Hampshire",
                            'NJ' => "New Jersey",
                            'NM' => "New Mexico",
                            'NY' => "New York",
                            'NC' => "North Carolina",
                            'ND' => "North Dakota",
                            'OH' => "Ohio",
                            'OK' => "Oklahoma",
                            'OR' => "Oregon",
                            'PA' => "Pennsylvania",
                            'RI' => "Rhode Island",
                            'SC' => "South Carolina",
                            'SD' => "South Dakota",
                            'TN' => "Tennessee",
                            'TX' => "Texas",
                            'UT' => "Utah",
                            'VT' => "Vermont",
                            'VA' => "Virginia",
                            'WA' => "Washington",
                            'WV' => "West Virginia",
                            'WI' => "Wisconsin",
                            'WY' => "Wyoming"
                            );

/*
|--------------------------------------------------------------------------
| Styling
|--------------------------------------------------------------------------
|
| Various tags for formatting code and text.
| Use double quotes for carriage-control characters.
|
*/

define('NL',"\n");
define('FORMAT_MYSQL_DATETIME','%Y-%m-%d %H:%i:%s');
define('FORMAT_MYSQL_DATE','%Y-%m-%d');

define('UPLOAD_PATH','uploads');
                       
/* End of file config_aux.php */
/* Location: ./application/config/config_aux.php */