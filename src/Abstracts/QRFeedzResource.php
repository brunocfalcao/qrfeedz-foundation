<?php

namespace QRFeedz\Foundation\Abstracts;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Admin\Fields\HumanDateTime;

abstract class QRFeedzResource extends Resource
{
    public static function softDeletes()
    {
        return false;
    }

    /**
     * The current logged user.
     *
     * @return Authenticable
     */
    public function user()
    {
        return Auth::user();
    }

    /**
     * To be used within a panel, to show the 3 timestamp fields, correctly
     * formatted and with view and authorization logic.
     *
     * @return array
     */
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
