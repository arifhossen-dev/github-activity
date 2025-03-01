#! /usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Arifhossen\ActiveCoder\GitHubActivity;

// Check if username is provided
if ($argc !== 2) {
    echo "\n‼️ Usage: github-activity <username>\n";
    exit(1);
}

$uaername = $argv[1];

$activity = new GitHubActivity($uaername);

$dataArray = $activity->fetchActivity();

$formatedData = $activity->formatActivity(activities: $dataArray);


echo "Recent activity for $username:\n\n";
foreach ($formatedData as $item) {
    echo "- $item\n";
}