<?php

namespace App\Central\Actions\Grid;

use App\Models\Tenant;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;

class SwitchToTenantDashboard extends RowAction
{
    /**
     * @return string
     */
    protected $title = '登录后台';

    /**
     * Handle the action request.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $domain = Domain::where('tenant_id', $this->getKey())->value('domain');
        $token = tenancy()->impersonate(Tenant::find($this->getKey()), 1, '/admin', 'admin');
        $url = (config('admin.https') ? 'https' : 'http').'://'.$domain.'/admin/god/'.$token->token;

        // 为了从新窗口打开,以及适配iframe-tab扩展, 这里使用js进行处理, 而不是直接跳转.
        return $this->response()->html($url)->success('正在跳转，请稍后');
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['温馨提示', '确认登录到租户后台吗?'];
    }

    protected function handleHtmlResponse()
    {
        return <<<'JS'
function (target, html, data) {
    window.parent.open(html);
}
JS;
    }

    /**
     * @param  Model|Authenticatable|HasPermissions|null  $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return $user->isAdministrator();
    }
}
