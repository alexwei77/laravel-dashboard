<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbsRepository
{
    protected $target;

    /**
     * @return Model
     */
    protected function getModel()
    {
        return App($this->target);
    }

    public function all()
    {
        return $this->getModel()->all();
    }
}