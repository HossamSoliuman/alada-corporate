<?php

namespace App\View\Composers;

use App\Models\Lead;
use App\Models\Service;
use App\Models\BlogCategory;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdminLayoutComposer
{
    public function compose(View $view): void
    {
        $unreadLeads = Cache::remember('admin_unread_leads', 300, function () {
            return Lead::unread()->count();
        });

        $view->with(compact('unreadLeads'));
    }
}
