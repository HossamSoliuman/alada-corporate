<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SetSeoDefaults
{
    public function handle(Request $request, Closure $next): Response
    {
        View::share('defaultSeo', [
            'title'       => Setting::get('site_name', config('app.name')),
            'description' => Setting::get('meta_description', ''),
            'og_image'    => Setting::get('default_og_image', ''),
        ]);

        return $next($request);
    }
}
