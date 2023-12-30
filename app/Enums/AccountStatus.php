<?php
namespace App\Enums;

enum AccountStatus: int
{
    case Reserve    = 1;
    case Join       = 2;
    case Suspend    = 3;
    case Leave      = 4;
    case Cancel     = 5;

    private static function string($val): string
    {
        return match($val){
            self::Reserve, self::Reserve->value => '入社前',
            self::Join, self::Join->value       => '在籍中',
            self::Suspend, self::Suspend->value => '休職中',
            self::Leave, self::Leave->value     => '退職済',
            self::Cancel, self::Cancel->value   => '辞退',
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
