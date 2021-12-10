<?php

namespace App\Central\Controllers;

use App\Central\Repositories\Domain;
use App\Models\Tenant;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class DomainController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Domain('tenant'), function (Grid $grid) {
            $grid->model()->orderByDesc('id');

            $grid->column('id')->sortable();
            $grid->column('domain')->copyable();
            $grid->column('tenant.name', '关联租户');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->disableCreateButton();
            $grid->disableEditButton();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('domain');
                $filter->equal('tenant_id', '关联租户')->select(Tenant::pluck('name', 'id'));
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
        return Show::make($id, new Domain('tenant'), function (Show $show) {
            $show->field('id');
            $show->field('domain');
            $show->field('tenant.name', '关联租户');
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableEditButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // 保留这个方法,否则删除功能失效.
        return Form::make(new Domain(), function (Form $form) {

        });
    }
}
