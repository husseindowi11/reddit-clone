<?php

namespace App\Providers;

use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use App\Observers\PostVoteObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::composer('layouts.app', function ($view){
           $view->with('newestPosts', Post::latest()->take(5)->get());
            $view->with('newestCommunities', Community::withCount('posts')->latest()->take(5)->get());
        });
        PostVote::observe(PostVoteObserver::class);
        //or viewShare
    }
}
