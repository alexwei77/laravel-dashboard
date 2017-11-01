<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepository extends AbsRepository
{
    protected $target = Package::class;

    /**
     * @param int $package_id
     * @return null|Package
     */
    public function getById($package_id)
    {
        return $this->getModel()
            ->find($package_id);
    }


}
