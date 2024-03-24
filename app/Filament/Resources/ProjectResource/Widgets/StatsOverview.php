<?php

namespace App\Filament\Resources\ProjectResource\Widgets;

use App\Models\Client;
use App\Models\Objet;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '60s';

    protected function getCards(): array
    {
        $data = Cache::remember('informations', 60, function () {
            return ['projects' => Project::count(), 'clients' => Client::count(), 'objects' => Objet::count()];
        });
        Log::info('Informations : '.$data['projects'].' '.$data['clients'].' '.$data['objects']);
        return [
            Card::make('Nombres de clients', $data['clients']),
//                ->description('32k increase')
//                ->descriptionIcon('heroicon-s-trending-up'),
            Card::make('Nombres de projets', $data['projects']),
//                ->description('7% increase')
//                ->descriptionIcon('heroicon-s-trending-down'),
            Card::make("Nombres d'objets", $data['objects'])
//                ->description('3% increase')
//                ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
