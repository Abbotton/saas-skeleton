<?php

namespace App\Admin\Extensions\Form;

use App\Traits\ObjectUrlTrait;

class MultipleFile extends \Dcat\Admin\Form\Field\MultipleImage
{
    use ObjectUrlTrait;
}
