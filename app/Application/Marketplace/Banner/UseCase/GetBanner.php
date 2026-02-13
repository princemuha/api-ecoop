<?php

namespace App\Application\Marketplace\Banner\UseCase;

use App\Infrastructure\Marketplace\Banner\Contracts\BannerInterface;

class GetBanner
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private BannerInterface $banner,
    )
    {}

    public function execute()
    {
        return $this->banner->getAll();
    }
}
