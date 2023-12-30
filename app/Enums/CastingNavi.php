<?php
namespace App\Enums;

enum CastingNavi: int
{
    case None               = 1;
    case Installed          = 2;
    case Plan_to_install    = 3;
    case Plan_to_uninstall  = 4;

    private static function string($val): string
    {
        return match($val){
            self::None, self::None->value                           => 'なし',
            self::Installed, self::Installed->value                 => 'インストール済',
            self::Plan_to_install, self::Plan_to_install->value     => 'インストール予定',
            self::Plan_to_uninstall, self::Plan_to_uninstall->value => 'アンインストール予定',
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
