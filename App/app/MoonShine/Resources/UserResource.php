<?php

namespace App\MoonShine\Resources;

use App\Models\User;
use Faker\Provider\Text;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;
use Leeto\MoonShine\Decorations\Block;
use Leeto\MoonShine\Actions\FiltersAction;
use Leeto\MoonShine\Traits\Fields\FormElement;
use Leeto\MoonShine\Fields;

class UserResource extends Resource
{
	public static string $model = User::class;

	public static string $title = 'Users';

	public function fields(): array
	{
		return [
		    Block::make('form-container', [
		        ID::make()->sortable(),
//                Fields\Textarea::make("Name",'fullname')->required(),
                Text::make("Name",'fullname')->required(),
                Text::make('phone','phone')->required(),
                Text::make('phone_verified','phone_verified')->required(),
                Text::make('phone_verified_at','phone_verified_at')->required(),
                Text::make('password','password')->required(),
                Text::make('role','role')->required(),
                Fields\Password::make('passwrd','password')
		    ])
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'name'=>['required'],
            'phone'=>['required'],
            'password'=>['sometimes','nullable','min:6',]
        ];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
