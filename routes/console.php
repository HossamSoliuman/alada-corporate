<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sitemap:generate')->daily()->at('00:00');
Schedule::command('leads:cleanup')->monthly();
