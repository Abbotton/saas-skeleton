<?php

namespace App\Central\Controllers;

use App\Central\Repositories\Tenant;
use App\Models\Domain;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class TenantController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Tenant('domains'), function (Grid $grid) {
            $grid->model()->orderByDesc('created_at');

            $grid->column('id')->copyable();
            $grid->column('name');
            $grid->column('domains', '域名')->display(function ($domains) {
                if (count($domains) == 0) {
                    return '-';
                }
                $domainString = '';
                foreach ($domains as &$domain) {
                    $domainString .= $domain->domain.'<br/>';
                }
                return $domainString;
            });
            $grid->column('expired_at');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name');
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param  mixed  $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Tenant('domains'), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('expired_at');
            $show->field('created_at');
            $show->field('updated_at');

            $show->relation('domains', '域名', function ($model) {
                $grid = new Grid(new Domain());

                $grid->model()->where('tenant_id', $model->id);

                $grid->setResource('/domain');

                $grid->id();
                $grid->domain('域名');
                $grid->created_at();
                $grid->updated_at();

                $grid->disableRowSelector();
                $grid->disableCreateButton();

                return $grid;
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Tenant('domains'), function (Form $form) {
            $form->display('id');
            $form->text('name')
                ->rules(
                    'required|unique:tenants,name,'.$form->getKey(),
                    [
                        'required' => '请填写租户名称',
                        'unique' => '租户名称已经存在'
                    ]
                )
                ->required();
            $form->hasMany('domains', function (Form\NestedForm $form) {
                $form->text('domain', '域名');
            })->useTable();

            $form->datetime('expired_at')->rules(
                'required|date_format:Y-m-d H:i:s',
                [
                    'required' => '请选择过期时间',
                    'datetime' => '时间日期格式不正确'
                ])
                ->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
