<?php

require_once ( "Observer.php" );

Observer::EventCreate ( "settings",  Observer::LogRead ( "settings" ), 60000 );