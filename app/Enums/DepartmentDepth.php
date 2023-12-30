<?php
namespace App\Enums;

enum DepartmentDepth: int
{
    case Department = 1;
    case Division   = 2;
    case Groupe     = 3;
    case Section    = 4;


    private static function string($val): array
    {
        return match($val){
            self::Department, self::Department->value   => ['事業部','Depth1 事業部'],
            self::Division, self::Division->value       => ['部・支店','Depth2 部・支店'],
            self::Groupe, self::Groupe->value           => ['グループ','Depth3 グループ'],
            self::Section, self::Section->value         => ['課・セクション','Depth4 課・セクション'],
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
