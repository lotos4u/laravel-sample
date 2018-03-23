<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Traits\EntityController;

class ApiController extends Controller
{

    public function menu(Request $request)
    {
        $data = [
            'item1' => [
                'type' => 'link',
                'text' => 'text1',
                'title' => 'title1',
                'url' => '#1',
            ],
            'item2' => [
                'type' => 'link',
                'text' => 'text2',
                'title' => 'title2',
                'url' => '#2',
            ],
            'item3' => [
                'type' => 'link',
                'text' => 'text3',
                'title' => 'title3',
                'url' => '#3',
            ],
        ];
        return response()->json(['data' => $data]);
    }

}
