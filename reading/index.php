<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', '/reading/');

// Debug: Check if images folder exists
if (!is_dir('images')) {
    die('Error: images folder not found in ' . __DIR__);
}

$page = isset($_GET['page']) ? $_GET['page'] : 'cover';
$allowed = [
    'cover',
    'outline',
    'activity1',
    'activity2',
    'activity3',
    'scoreboard'
];
$page = in_array($page, $allowed) ? $page : 'cover';

if (!file_exists('includes/header.php')) die('Error: includes/header.php not found');
if (!file_exists("pages/{$page}.php")) die("Error: pages/{$page}.php not found");
if (!file_exists('includes/footer.php')) die('Error: includes/footer.php not found');

include 'includes/header.php';
include "pages/{$page}.php";
include 'includes/footer.php';
