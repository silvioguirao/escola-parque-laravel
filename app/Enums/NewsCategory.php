<?php

namespace App\Enums;

enum NewsCategory: string
{
    case ANNOUNCEMENT = 'announcement';
    case EVENT = 'event';
    case ACHIEVEMENT = 'achievement';
    case GENERAL = 'general';

    /**
     * Get all available category values
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get a human-readable label for the category
     */
    public function label(): string
    {
        return match($this) {
            self::ANNOUNCEMENT => 'Anúncio',
            self::EVENT => 'Evento',
            self::ACHIEVEMENT => 'Conquista',
            self::GENERAL => 'Geral',
        };
    }

    /**
     * Get the icon name for the category
     */
    public function icon(): string
    {
        return match($this) {
            self::ANNOUNCEMENT => 'megaphone',
            self::EVENT => 'calendar',
            self::ACHIEVEMENT => 'trophy',
            self::GENERAL => 'newspaper',
        };
    }
}
