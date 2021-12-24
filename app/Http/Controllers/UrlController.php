<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function index()
    {
        $lastChecked = DB::table('url_checks')
            ->distinct('url_id')
            ->orderBy('url_id')
            ->latest()
            ->get()
            ->keyBy('url_id');
        $urls = DB::table('urls')->paginate();
        return view('url.index', compact($urls, $lastChecked));
    }

    public function store(Request $request)
    {
        $data = $request->input('url');
        $validated = Validator::make($data, [
            'name' => 'required|url|max:255'
        ]);

        if ($validated->fails()) {
            return redirect()->route('home')
                ->withErrors($validated)
                ->withInput();
        }

        $parsedUrl = parse_url($data['name']);
        $normalizedUrl = "{$parsedUrl['scheme']}://{$parsedUrl['host']}";

        $url = DB::table('urls')
            ->where('name', $normalizedUrl)
            ->first();

        if (is_null($url)) {
            $id = DB::table('urls')->insertGetId([
                    'name' => $normalizedUrl,
                    'created_at' => Carbon::now()->toString(),
                    'updated_at' => Carbon::now()->toString()
            ]);
            flash(__('messages.The page has been added successfully'))->success();
        } else {
            $id = $url->id;
            flash(__('messages.The page has already been added'))->success();
        }

        return redirect()->route('urls.show', ['url' => $id]);
    }

    public function show(Request $request, int $id)
    {
        $url = DB::table('urls')->find($id);

        abort_unless($url, 404);

        $urlChecks = DB::table('url_checks')
            ->where('url_id', $id)
            ->latest()
            ->paginate();

        return view('url.show', compact('url', 'urlChecks'));
    }
}
