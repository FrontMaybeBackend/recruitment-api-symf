<?php
namespace App\Enum;

enum PositionTypeEnum: string
{
    case JUNIOR = 'junior';
    case MID = 'mid';
    case SENIOR = 'senior';

    public function getLabel(): string
    {
        return match($this) {
            self::JUNIOR => 'Junior',
            self::MID => 'Mid',
            self::SENIOR => 'Senior',
        };
    }
}
