<?php

namespace QRFeedz\Foundation\Abstracts;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Illuminate\Database\Eloquent\Model;

abstract class QRFeedzModel extends Model
{
    use HasCustomQueryBuilder;

    protected $guarded = [];

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function canBeDeleted()
    {
        return true;
    }
}
