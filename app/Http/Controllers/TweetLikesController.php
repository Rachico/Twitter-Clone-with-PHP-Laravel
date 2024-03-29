<?php

namespace App\Http\Controllers;

use App\Like;
use App\Tweet;
use Illuminate\Http\Request;

class TweetLikesController extends Controller
{
    public function store (Tweet $tweet)
    {
        $tweet->like(current_user());
        return back();

    }

    public function destroy (Tweet $tweet)
    {
        $tweet->dislike(current_user());
        return back();
    }
}
