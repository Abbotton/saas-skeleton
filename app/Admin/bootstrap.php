<?php

use App\Admin\Extensions\Form\Image;
use App\Admin\Extensions\Form\MultipleFile;
use App\Admin\Extensions\Form\MultipleImage;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Navbar;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
Admin::navbar(function (Navbar $navbar) {
    if (!Dcat\Admin\Support\Helper::isAjaxRequest()) {
        $navbar->right(App\Admin\Actions\AdminSetting::make()->render());
    }
});
Form::extend('file', App\Admin\Extensions\Form\File::class);
Form::extend('image', Image::class);
Form::extend('multipleFile', MultipleFile::class);
Form::extend('multipleImage', MultipleImage::class);