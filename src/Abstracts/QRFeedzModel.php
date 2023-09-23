<?php

namespace QRFeedz\Foundation\Abstracts;

use Illuminate\Database\Eloquent\Model;
use QRFeedz\Foundation\Classes\CustomEloquentQueryBuilder;

abstract class QRFeedzModel extends Model
{
    protected $guarded = [];

    public function newEloquentBuilder($query)
    {
        return new CustomEloquentQueryBuilder($query);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */

    /**
     * Decides if an eloquent model can be deleted, so all the conditions need
     * to meet before the instance is deleted. Can be used for force delete too.
     */
    public function canBeDeleted()
    {
        return true;
    }
}
