<?php
namespace App\Enums;

enum Branch: int
{
    case Osaka              = 1;
    case Namba              = 2;
    case Shinjuku           = 3;
    case Sapporo            = 4;
    case Nagoya             = 5;
    case Matsuyama          = 6;
    case Hombu              = 7;
    case Fukuoka            = 8;
    case Shokai_Shinjuku    = 9;
    case Yokohama           = 10;
    case Kumamoto           = 11;
    case AG_Shinjuku        = 12;


    private static function string($val): array
    {
        return match($val){
            self::Osaka, self::Osaka->value                     => ['大阪','CCOS',true],
            self::Namba, self::Namba->value                     => ['なんば','CCBA',false],
            self::Shinjuku, self::Shinjuku->value               => ['新宿','CCSH',true],
            self::Sapporo, self::Sapporo->value                 => ['札幌','CCSA',true],
            self::Nagoya, self::Nagoya->value                   => ['名古屋','CCNA',false],
            self::Matsuyama, self::Matsuyama->value             => ['松山','CCMA',true],
            self::Hombu, self::Hombu->value                     => ['本部','CCOT',true],
            self::Fukuoka, self::Fukuoka->value                 => ['福岡','CCFU',true],
            self::Shokai_Shinjuku, self::Shokai_Shinjuku->value => ['紹介新宿','SSSH',false],
            self::Yokohama, self::Yokohama->value               => ['横浜','CCYO',false],
            self::Kumamoto, self::Kumamoto->value               => ['熊本','CCKU',false],
            self::AG_Shinjuku, self::AG_Shinjuku->value         => ['AG（新宿）','AGSH',false],
        };
    }

    public function label(): string
    {
        return self::string($this)[0];
    }

    public function label_code(): string
    {
        return self::string($this)[1];
    }

    public static function search($int): string
    {
        return self::string($int)[0];
    }

    public static function search_code($int): string
    {
        return self::string($int)[1];
    }

    public function is_use(): bool
    {
        return self::string($this)[2];
    }
}
