<?php
namespace App\Providers;

use \Illuminate\Auth\EloquentUserProvider;

class AuthUserProvider extends EloquentUserProvider
{
    public function retrieveById($identifier)
    {
        $model = $this->createModel();

        return $this->newModelQuery($model)
            ->select('users.*', 'qa.qiita_user_id', 'qat.token')
            ->leftJoin('qiita_accounts as qa', 'users.id', '=', 'qa.user_id')
            ->leftJoin('qiita_api_tokens as qat', 'qa.id', '=', 'qat.qiita_account_id')
            ->where('users.' . $model->getAuthIdentifierName(), $identifier)
            ->first();
    }
}