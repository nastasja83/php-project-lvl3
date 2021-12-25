<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use Illuminate\Http\Client\HttpClientException;

class UrlCheckingController extends Controller
{
    public function store(int $id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);

        try {
            $response = Http::get($url->name);
            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $title = optional($document->first('title'))->text();
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');

            DB::table('url_checks')->insert([
                    'url_id' => $id,
                    'created_at' => Carbon::now()->toString(),
                    'status_code' => $response->status(),
                    'h1' => $h1,
                    'title' => $title,
                    'description' => $description,
                    'updated_at' => Carbon::now()->toString()
            ]);

            flash(__('messages.Page has been checked successfully'))->success();
        } catch (HttpClientException $exception) {
            flash($exception->getMessage())->error();
        }
        return redirect()->route('urls.show', ['url' => $id]);
    }
}
