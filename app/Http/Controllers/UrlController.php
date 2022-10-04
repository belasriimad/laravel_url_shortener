<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUrlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlRequest $request)
    {
        //
        $url = Url::create([
            'full_url' => $request->full_url,
            'url_desc' => $request->url_desc,
            'user_id' => $request->user_id,
            'shorten_url' => Str::random(),
            'visits' => 0,
        ]);
        return response()->json($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        //
        $url->increment('visits');
        return redirect($url->full_url);
    }

    /**
     * Show the form for- editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUrlRequest  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
        $url->update([
            'full_url' => $request->full_url,
            'url_desc' => $request->url_desc,
            'user_id' => $request->user_id,
        ]);
        return response()->json('updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
        $url->delete();
        return response()->json('deleted');
    }

    public function getUserLinks($user_id){
        return response()->json(Url::where('user_id', $user_id)->latest()->paginate(4));
    }
}
