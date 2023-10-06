<?php

namespace QRFeedz\Foundation\Abstracts;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Admin\Fields\QRDateTime;
use Titasgailius\SearchRelations\SearchesRelations;

abstract class QRFeedzResource extends Resource
{
    use SearchesRelations;

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
            QRDateTime::make('Created At'),

            QRDateTime::make('Updated At'),

            QRDateTime::make('Deleted At')
                         ->canSee(fn () => ! $request->findModel()->deleted_at == null),
        ];
    }
}
