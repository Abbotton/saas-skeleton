<?php

namespace App\Traits;

use Illuminate\Support\Facades\URL;

trait ObjectUrlTrait
{
    public function objectUrl($path)
    {
        if (URL::isValidUrl($path)) {
            return $path;
        }
        if (tenant()) {
            return tenant_asset($path);
        }

        return $this->getStorage()->url($path);
    }
}
