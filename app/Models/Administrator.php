<?php

namespace App\Models;

use Dcat\Admin\Models\Administrator as BaseAdministratorModel;

class Administrator extends BaseAdministratorModel
{
    public function getAvatar()
    {
        $avatar = $this->avatar;

        if ($avatar) {
            return tenant_asset($avatar);
        }

        return admin_asset(config('admin.default_avatar') ?: '@admin/images/default-avatar.jpg');
    }
}
