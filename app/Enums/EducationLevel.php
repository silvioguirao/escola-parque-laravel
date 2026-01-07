<?php

namespace App\Enums;

enum EducationLevel: string
{
    case INFANTIL = 'infantil';
    case FUNDAMENTAL1 = 'fundamental1';
    case FUNDAMENTAL2 = 'fundamental2';
    case MEDIO = 'medio';

    /**
     * Get all available level values
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get a human-readable label for the level
     */
    public function label(): string
    {
        return match($this) {
            self::INFANTIL => 'Educação Infantil',
            self::FUNDAMENTAL1 => 'Fundamental I',
            self::FUNDAMENTAL2 => 'Fundamental II',
            self::MEDIO => 'Ensino Médio',
        };
    }

    /**
     * Get the age range for the education level
     */
    public function ageRange(): string
    {
        return match($this) {
            self::INFANTIL => '0-5 anos',
            self::FUNDAMENTAL1 => '6-10 anos',
            self::FUNDAMENTAL2 => '11-14 anos',
            self::MEDIO => '15-17 anos',
        };
    }
}
