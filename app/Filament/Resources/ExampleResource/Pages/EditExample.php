<?php

namespace App\Filament\Resources\ExampleResource\Pages;

use App\Filament\Resources\ExampleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditExample extends EditRecord
{
    protected static string $resource = ExampleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('update-comments')
                ->label('Update Comments')
                ->action(function () {
                    Log::info("Updating comments for {$this->record->id}...");

                    $now = \Carbon\Carbon::now();

                    $newComments = [];
                    for ($i = 0; $i < 5; $i++) {
                        $newComments[] = [
                            "Comment #{$i} updated at {$now}",
                        ];
                    }

                    $this->record->comments = $newComments;
                    $this->record->save();

                    $this->refreshFormData([
                        'comments',
                    ]);
                }),

        ];
    }
}
