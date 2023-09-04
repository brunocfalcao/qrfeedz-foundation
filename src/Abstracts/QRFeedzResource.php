<?php

namespace QRFeedz\Foundation\Abstracts;

use App\Nova\Resource;
use Illuminate\Http\Request;
use QRFeedz\Admin\Fields\HumanDateTime;

abstract class QRFeedzResource extends Resource
{
    protected function timestamps(Request $request)
    {
        return [

            HumanDateTime::make('Created At'),

            HumanDateTime::make('Updated At'),

            HumanDateTime::make('Deleted At')
                         ->canSee(fn () => ! $request->findModel()->deleted_at == null),

        ];
    }
}
