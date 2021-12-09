<?php

namespace App\Admin\Actions;

use App\Admin\Forms\AdminSetting as AdminSettingForm;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Modal;

class AdminSetting extends Action
{
    /**
     * @return string
     */
    protected $title = '<i class="feather icon-settings" style="font-size: 1.5rem"></i> 系统设置';

    public function render()
    {
        $modal = Modal::make()
            ->id('admin-setting-config')
            ->title($this->title())
            ->body(AdminSettingForm::make())
            ->lg()
            ->button(
                <<<HTML
<ul class="nav navbar-nav">
     <li class="nav-item"> &nbsp;{$this->title()} &nbsp;</li>
</ul>
HTML
            );

        return $modal->render();
    }

    protected function authorize($user): bool
    {
        return (Admin::user())->isAdministrator();
    }
}
