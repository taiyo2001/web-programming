<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $tweets = Tweet::orderBy('created_at', 'DESC')->get();
        return view('tweet.index')->with('tweets', $tweets);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:140',
        ]);

        $tweet = new Tweet();
        $tweet->content = $validatedData['content'];
        $tweet->user_id = $this->user()->id;
        $tweet->save();
        return redirect()->route('tweet.show');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateIndex(Request $request)
    {
        $tweetId = (int) $request->route('tweetId');
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        return view('tweet.update')->with('tweet', $tweet);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePut(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:140',
        ]);

        $tweet = Tweet::where('id', $request->tweetId)->firstOrFail();
        $tweet->content = $validatedData['content'];
        $tweet->save();
        return redirect()->route('tweet.update.index', ['tweetId' => $tweet->id])->with('feedback.success', "つぶやきを編集しました");
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $tweetId = (int) $request->route('tweetId');
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        $tweet->delete();
        return redirect()->route('tweet.show')->with('feedback.success', "つぶやきを削除しました");
    }
}
