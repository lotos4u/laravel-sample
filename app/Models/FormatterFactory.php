<?php

namespace App\Models;


use App\Helpers\UserDataHelper;

class FormatterFactory
{

    public static function getFormattedText($cellText, $template)
    {
        $userData = UserDataHelper::getUserSharedData();
        $templateData = ['input' => $cellText];
        $userSettings = $userData['user_settings'];
        switch ($template) {
            case 'date':
                $formatDate = $userSettings['format_date']['value'];
                $templateData['format'] = $formatDate;//"Y-m-d";
                break;
            case 'time':
                $formatTime = $userSettings['format_time']['value'];
                $templateData['format'] = $formatTime;//"H:i:s";
                break;
            case 'datetime':
                $formatDate = $userSettings['format_date']['value'];
                $formatTime = $userSettings['format_time']['value'];
                $templateData['format'] = $formatDate . ", " . $formatTime;
                break;
            default:
                return $cellText;
        }
        return view('cells.' . $template, $templateData)->render();
    }
}