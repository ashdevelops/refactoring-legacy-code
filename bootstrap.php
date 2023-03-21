<?php

// Set Defaults
$today          = date('Y-m-d');

// Get a list of parameters passed into the URL
$eventuri       = $_SERVER['REQUEST_URI'];
$eventbreak     = explode('?', $eventuri);
$eventParams    = explode('&', $eventbreak[1] ?? '');

// clean the search inputs
$events_array = filter_var_array($_GET, FILTER_SANITIZE_STRING);
$eventsArray = is_array($events_array) ? array_filter($events_array) : [];

// Build up list of OPtions for various search form fields
// --------------------------------------------------------

// WHEN Drop Down Field
$when = array (
    'thisWeek' => 'This Week',
    'nextWeek' => 'Next Week',
    'thisMonth' => 'This Month',
    'nextMonth' => 'Next Month',
    'full' => 'Full',
);

// Now get all event Categories (except those sub categories above)
$taxonomies = [];

$selected_date = '';
$eventPeriodAfter = '';
$eventPeriodBefore = '';
$dateQuery = '';
$taxQuery = '';