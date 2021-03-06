<?php

// Configuration of automated emails
$config['Email']['replyTo'] = 'OPSL@rwth-physiker.de';
$config['Email']['from'] = 'The OPSL Team <OPSL@rwth-physiker.de>';

// Configuration of the Header Logo
$config['Header']['logo'] = 'logo7.png';

// Configuration for how many MONTHS the recent matches will be displayed
$config['User']['recent_matches'] = '6';


// Configuration of the caketourney folder
// Examples:
// if you reach your caketourney at http://flesh.sesu.org/caketourney/users, leave the folder blank ('')
// if you reach your caketourney at http://flesh.sesu.org/test/caketourney/users, set the folder to 'test/' (make sure to add the '/' at the end!)
// if you reach your caketourney at http://flesh.sesu.org/test/test2/caketourney/users, set the folder to 'test/test2' (make sure to add the '/' at the end!)
$config['Caketourney']['folder'] = '';

// Name of Organisation, etc
$config['Caketourney']['company_name'] = 'OPSL Team';
$config['Caketourney']['company_name_long'] = 'Open Physicist Starcraft II League';
$config['Caketourney']['company_name_short'] = 'OPSL';

// Configuration of division and unranked names
$config['Caketourney']['division_1'] = 'Code S';
$config['Caketourney']['division_2'] = 'Code A';
$config['Caketourney']['division_unranked'] = 'Unranked';

// Configuration of division and unranked names
// if you you have a stream this needs to be set to 'yes' otherwise to 'no'
$config['Stream']['stream'] = 'yes';
// your stream name
$config['Stream']['name'] = 'OPSL.tv';
// url where users can watch videos on demand
$config['Stream']['vod_url'] = 'http://www.own3d.tv/b4lrog';
// url to the livestream
$config['Stream']['livestream_url'] = 'http://www.own3d.tv/livestream/24608';


// Configuration of you Facebook website
// if your Facebook website looks like this "http://www.facebook.com/pages/Open-Physicist-Starcraft-II-League/210427322307946" the fanpage name is 'Open-Physicist-Starcraft-II-League'
$config['Facebook']['fanpage_name'] = 'Open-Physicist-Starcraft-II-League';


?>