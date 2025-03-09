<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Address>
 */
class AddressResource extends ModelResource
{
    protected string $model = Address::class;

    protected string $title = 'Addresses';

    protected string $column = 'address';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                
                ID::make()->sortable(),
                \MoonShine\Fields\Text::make("Адрес", "address"),
                \MoonShine\Fields\Textarea::make("Описание", "description"),

                \MoonShine\Fields\Number::make('Широта', 'latitude')
                    ->step(0.000001) // Точность до 6 знаков
                    ->min(-90)->max(90),

                \MoonShine\Fields\Number::make('Долгота', 'longitude')
                    ->step(0.000001) // Точность до 6 знаков
                    ->min(-180)->max(180)
            ]),
        ];
    }

    /**
     * @param Address $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
