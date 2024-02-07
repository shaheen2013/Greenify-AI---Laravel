<?php
use Illuminate\Support\Facades\File;
// app/Helpers/FormatHelper.php

if (!function_exists('getTimezone')) {
    function getTimezone()
    {
        $timezone = file_get_contents('https://gist.githubusercontent.com/EmadAdly/c32181b987937f15214615ad4c6a6024/raw/82e2ca0cb5892dca6d81362c991f6b8c62861720/timezone.json');
        if ($timezone === false) {
            echo "Failed to fetch data from the file.";
        } else {
            $timezoneData = json_decode($timezone, true);
            if ($timezoneData === null) echo "Failed to decode JSON data.";
            else return $timezoneData;
        }
    }
}

if (!function_exists('getDateTimeFormat')) {

    function getDateTimeFormat()
    {
        // Get the path to your JSON file within the public directory
        $filePath = public_path('assets/json/datetime.json');

        // Check if the file exists
        if (!File::exists($filePath)) {
            return "Failed to fetch data from the file. File not found.";
        }

        // Read the contents of the JSON file
        $dateTimeFormat = File::get($filePath);

        // Decode the JSON data
        $dateTimeFormatData = json_decode($dateTimeFormat, true);

        // Check if JSON decoding was successful
        if ($dateTimeFormatData === null) {
            return "Failed to decode JSON data.";
        }

        return $dateTimeFormatData;
    }
}
