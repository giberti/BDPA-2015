<?php

/**
 * Returns the current filename
 */
function getFilename() {
    $path = explode('/', $_SERVER['PHP_SELF']);
    return array_pop($path);
}

/**
 * Returns a list of nearby states and their abbreviations
 * @return array
 */
function getStates() {
    return array(
        'CO' => 'Colorado',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'MN' => 'Minnesota',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'ND' => 'North Dakota',
        'SD' => 'South Dakota',
        'WI' => 'Wisconsin',
        'WY' => 'Wyoming',
    );
}

function getRouteTypes() {
    return array(
        'Road', 'Mountain Bike', 'Dirt Road', 'Paved Path', 'Beach', 'Mixed'
    );
}

function getRouteLevels() {
    return array(
        'Beginner', 'Intermediate', 'Advanced', 'Expert'
    );
}

function getTipTypes() {
    return array(
        'Safety', 'Health', 'Maintenance', 'Equipment'
    );
}