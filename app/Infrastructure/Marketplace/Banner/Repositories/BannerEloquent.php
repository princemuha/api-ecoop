<?php

namespace App\Infrastructure\Marketplace\Banner\Repositories;

use App\Infrastructure\Marketplace\Banner\Contracts\BannerInterface;
use App\Infrastructure\Marketplace\Banner\Models\BannerModel;

class BannerEloquent implements BannerInterface
{
    public function __construct()
    {
    }

    public function getAll()
    {
        return BannerModel::where('banner_status', 'active')->get()->toArray();
    }
}
