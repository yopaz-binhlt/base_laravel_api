<?php

namespace App\Enums;

enum User: int
{
    case INDIVIDUAL = 1;
    case CORPORATION = 2;


    public function getValue(): int
    {
        return $this->value;

    }//end getValue()


    public function getDescription(): string
    {
        return match ($this) {
            self::INDIVIDUAL => '個人',
            self::CORPORATION => '法人',
        };

    }//end getDescription()


    public static function getValues(): array
    {
        return [
            self::INDIVIDUAL,
            self::CORPORATION,
        ];

    }//end getValues()


    public static function getTitle($value): string
    {
        return match ((int) $value) {
            self::INDIVIDUAL->getValue() => self::INDIVIDUAL->getDescription(),
            self::CORPORATION->getValue() => self::CORPORATION->getDescription(),
            default => '',
        };

    }//end getTitle()


}//end enum
