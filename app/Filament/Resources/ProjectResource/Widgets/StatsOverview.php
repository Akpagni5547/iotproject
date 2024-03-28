<?php

namespace App\Filament\Resources\ProjectResource\Widgets;

use App\Models\Client;
use App\Models\Objet;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '60s';

    protected function getCards(): array
    {
        $projects = Project::count();
        $clients = Client::count();
        $objects = Objet::count();

        return [
            Card::make('Nombres de clients', $clients),
//                ->description('32k increase')
//                ->descriptionIcon('heroicon-s-trending-up'),
            Card::make('Nombres de projets', $projects),
//                ->description('7% increase')
//                ->descriptionIcon('heroicon-s-trending-down'),
            Card::make("Nombres d'objets", $objects)
//                ->description('3% increase')
//                ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
