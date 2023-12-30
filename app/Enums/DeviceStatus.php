<?php
namespace App\Enums;

enum DeviceStatus: int
{
    case Stock      = 1;
    case Using      = 2;
    case Unreturned = 3;
    case Broken     = 4;
    case Fixing     = 5;
    case Dispose    = 6;
    case Disposed   = 7;
    case Unknown    = 8;
    case Lost       = 9;

    private static function string($val): string
    {
        return match($val){
            self::Stock, self::Stock->value             => '在庫',
            self::Using, self::Using->value             => '利用中',
            self::Unreturned, self::Unreturned->value   => '返却待ち',
            self::Broken, self::Broken->value           => '修理予定',
            self::Fixing, self::Fixing->value           => '修理中',
            self::Dispose, self::Dispose->value         => '廃棄予定',
            self::Disposed, self::Disposed->value       => '廃棄済み',
            self::Unknown, self::Unknown->value         => '不明',
            self::Lost, self::Lost->value               => '紛失',
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
