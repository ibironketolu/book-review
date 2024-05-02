<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use getID3;

class AudioController extends Controller
{
    public function getDuration(Request $request)
        {
            $audioFilePath = public_path('Wizkid_mood.mp3');

            // Initialize getID3
            $getID3 = new getID3();
    
            // Analyze the file and extract metadata
            $audioFileInfo = $getID3->analyze($audioFilePath);
    
            // Dump all metadata
            // dd($audioFileInfo);
            // exit();
            if (isset($audioFileInfo['playtime_string'])) {
                $duration = $audioFileInfo['playtime_string'];
                return view('audio-duration', compact('duration'));
            } else {
                return "Failed to get audio duration.";
            }
        }

}
