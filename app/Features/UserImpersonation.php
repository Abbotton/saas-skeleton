<?php

namespace App\Features;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Database\Models\ImpersonationToken;
use Stancl\Tenancy\Features\UserImpersonation as BaseUserImpersonation;

class UserImpersonation extends BaseUserImpersonation
{
    /**
     * Impersonate a user and get an HTTP redirect response.
     *
     * @param  string|ImpersonationToken  $token
     * @param  int  $ttl
     * @return RedirectResponse
     */
    public static function makeResponse($token, int $ttl = null): RedirectResponse
    {
        $token = $token instanceof ImpersonationToken ? $token : ImpersonationToken::findOrFail($token);

        if (((string)$token->tenant_id) !== ((string)tenant()->getTenantKey())) {
            abort(403);
        }

        $ttl = $ttl ?? static::$ttl;

        if ($token->created_at->diffInSeconds(Carbon::now()) > $ttl) {
            abort(403);
        }

        // 或许是dcat admin的问题, 这里修改为记住登录即可正常使用, 未来可能会删除本文件.
        Auth::guard($token->auth_guard)->loginUsingId($token->user_id, true);

        $token->delete();

        return redirect($token->redirect_url);
    }
}