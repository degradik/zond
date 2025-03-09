<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Umbrella;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Umbrella>
 */
class UmbrellaResource extends ModelResource
{
    protected string $model = Umbrella::class;

    protected string $title = 'Umbrellas';


    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                \MoonShine\Fields\Relationships\BelongsTo::make("Станция", "station", resource: new StationResource()),
                \MoonShine\Fields\Select::make('Cтатус', 'status')
                ->options([
                    'available' => 'Доступен',
                    'rented' => 'Арендован',
                    'lost' => 'Потерян'
                ]),
            ]),
        ];
    }

    /**
     * @param Umbrella $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
