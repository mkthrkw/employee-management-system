<?php
namespace App\Enums;

enum Role: int
{
    case Default      = 1;
    case Common_user  = 2;
    // 3は未設定。必要に応じて追加
    case Custom_user  = 4;
    // 5は未設定。必要に応じて追加
    case Supervisor   = 6;
    // 7は未設定。必要に応じて追加
    case Admin        = 8;
    // 9、10なども必要に応じて追加

    private static function string($val): string
    {
        return match($val){
            self::Default, self::Default->value         => 'デフォルト',
            self::Common_user, self::Common_user->value => 'ユーザー',
            self::Custom_user, self::Custom_user->value => 'カスタムユーザー',
            self::Supervisor, self::Supervisor->value   => 'アカウント管理者',
            self::Admin, self::Admin->value             => '全管理者',
        };
    }

    public function label(): string
    {
        return self::string($this);
    }

    public static function search($int): string
    {
        return self::string($int);
    }
}
