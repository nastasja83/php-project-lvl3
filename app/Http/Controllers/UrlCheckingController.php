<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use Illuminate\Http\Client\HttpClientException;
use GuzzleHttp\Exception\RequestException;

class UrlCheckingController extends Controller
{
    public function store(Request $request, int $id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);

        DB::table('url_checks')->insert([
            'url_id' => $id,
            'created_at' => Carbon::now()->toString(),
            'updated_at' => Carbon::now()->toString()
    ]);

    flash(__('messages.Page has been checked successfully'))->success();
    }
}
