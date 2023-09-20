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
}
