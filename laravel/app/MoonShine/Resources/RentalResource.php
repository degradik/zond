<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rental;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

use MoonShine\Fields\Number;

/**
 * @extends ModelResource<Rental>
 */
class RentalResource extends ModelResource
{
    protected string $model = Rental::class;

    protected string $title = 'Rentals';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                \MoonShine\Fields\Relationships\BelongsTo::make("Пользователь", "user", resource: new userResource()),
                \MoonShine\Fields\Relationships\BelongsTo::make("Зонт", "umbrella", resource: new UmbrellaResource()),

                \MoonShine\Fields\Date::make("Время начала", "date_start")->withTime(),
                \MoonShine\Fields\Date::make("Время конца", "date_end")->withTime(),


                Number::make('Общая стоимость', 'total_cost')->readonly(),

                \MoonShine\Fields\Select::make('Cтатус', 'status')
                ->options([ 
                    'active' => 'Активна',
                    'completed' => 'Закончена',
                ]),
            ]),
        ];
    }

    /**
     * @param Rental $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
