<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the post.
     *
     * @return View | JsonResource
     */
    public function index(Request $request)
    {
        $query = Post::published()->with('user');

        $user       = auth()->user();
        $mutedUsers = [];
        $mutedIds   = [];

        if ($user !== null) {
            $mutedUsers = $user->muteUsers;
            $mutedIds   = $mutedUsers->pluck('id')->toArray();
        }

        $query = $query->whereNotIn('user_id', $mutedIds)->limit(50);

        if ($request->sort !== null && ($request->sort === 'asc' || $request->sort === 'desc')) {
            $query = $query->orderBy('created_at', $request->sort);
        }

        $cacheKey = 'posts-'.($request->sort ?? '').(implode('_',$mutedIds));
        $posts = cache()->remember(
            $cacheKey,
            config('app.cache_time'),
            function () use ($query) {
                return $query->get();
            }
        );

        return $request->is('api/*')
            ? PostResource::collection($posts)
            : view('home', compact('posts', 'mutedUsers', 'mutedIds', 'user'));
    }
}
