<?php

namespace App\Repositories;

use App\Models\StripePackage;

class StripePackageRepository extends AbsRepository
{
    protected $target = StripePackage::class;

    public function getByIdAndPeriod($package_id, $month_year)
    {
        return $this->getModel()
            ->where('package_id_local', $package_id)
            ->where('package_period', $month_year)
            ->first();
    }
}
