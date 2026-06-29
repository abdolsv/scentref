<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    // Fixed: Must be non-static instance property
    protected int | string | array $columnSpan = '1';

    // Fixed: Must be non-static instance property
    protected string $view = 'filament.widgets.quick-actions-widget';
}
