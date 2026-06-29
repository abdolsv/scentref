<?php

use Illuminate\Support\Facades\Schedule;

// Runs daily at 3 AM — recalculate all price averages
Schedule::command("prices:recalculate")->dailyAt("03:00");

// Runs hourly — check price alerts
Schedule::command("alerts:send")->hourly();

// Runs daily at 2 AM — regenerate sitemap
Schedule::command("sitemap:generate")->dailyAt("02:00");

// Runs weekly Sunday 4 AM — full Meilisearch re-index
Schedule::command("scout:import", ["App\\Models\\Perfume"])->weeklyOn(0, "04:00");

// Enable cron on server:
// * * * * * cd /var/www/scentref && php artisan schedule:run >> /dev/null 2>&1

