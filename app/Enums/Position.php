<?php
namespace App\Enums;

enum Position: int
{
    case Crew   = 1;
    case Member = 2;
    case CF     = 3;
    case SV     = 4;
    case SMGR   = 5;
    case MGR    = 6;
    case DC     = 7;
    case MD     = 8;
    case SMD    = 9;
    case CEO    = 10;


    private static function string($val): array
    {
        return match($val){
            self::Crew, self::Crew->value       => ['クルー','クルー'],
            self::Member, self::Member->value   => ['一般','一般'],
            self::CF, self::CF->value           => ['CF','チーフ'],
            self::SV, self::SV->value           => ['SV','スーパーバイザー'],
            self::SMGR, self::SMGR->value       => ['SMGR','サブマネージャー'],
            self::MGR, self::MGR->value         => ['MGR','マネージャー'],
            self::DC, self::DC->value           => ['DC','ディレクター'],
            self::MD, self::MD->value           => ['MD','マネージングディレクター'],
            self::SMD, self::SMD->value         => ['SMD','シニアマネージングディレクター'],
            self::CEO, self::CEO->value         => ['社長','代表取締役社長'],
        };
    }

    public function label(): string
    {
        return self::string($this)[0];
    }

    public function label_official(): string
    {
        return self::string($this)[1];
    }

    public static function search($int): string
    {
        return self::string($int)[0];
    }

    public static function search_official($int): string
    {
        return self::string($int)[1];
    }
}
