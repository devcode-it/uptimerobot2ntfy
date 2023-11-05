<?php

require 'config.inc.php';

// Get uptime monitor details
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.uptimerobot.com/v2/getMonitors?api_key='.$api_key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
$result = curl_exec($ch);
curl_close($ch);

// Parse JSON
$data = json_decode($result);

// Loop throught the monitors and check if there isa monitor in a status different than 2 (=down)
foreach ($data->monitors as $monitor) {
    // If monitor status is not UP nor PAUSE, notify it
    if ($monitor->status != 2 && $monitor->status != 0) {
        echo '[🔴] '.$monitor->friendly_name." down\n";

        // Send notification through http request to ntfy.sh
        file_get_contents('https://ntfy.sh/'.$ntfy_topic, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: text/plain',
                'content' => '🔴 '.$monitor->friendly_name.' down!'
            ]
        ]));
    }
}
