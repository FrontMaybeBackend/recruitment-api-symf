<?php

namespace App\Enum;

enum JobTypeEnum: string
{
    case REMOTE = 'remote';
    case HYBRID = 'hybrid';
    case ONSITE = 'onsite';

    public function getLabel(): string
    {
        return match($this) {
            self::REMOTE => 'Praca zdalna',
            self::ONSITE => 'Praca w biurze',
            self::HYBRID => 'Praca hybrydowa',
        };
    }
}
