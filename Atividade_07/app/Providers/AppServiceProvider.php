<?php

namespace App\Providers;

use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Book::class, BookPolicy::class);
        Gate::policy(Publisher::class, PublisherPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Author::class, AuthorPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Paginator::useBootstrap();
    }
}
