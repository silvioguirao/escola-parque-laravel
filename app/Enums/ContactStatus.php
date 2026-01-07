<?php

namespace App\Enums;

enum ContactStatus: string
{
    case NEW = 'new';
    case READ = 'read';
    case REPLIED = 'replied';

    /**
     * Get all available status values
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get a human-readable label for the status
     */
    public function label(): string
    {
        return match($this) {
            self::NEW => 'Novo',
            self::READ => 'Lido',
            self::REPLIED => 'Respondido',
        };
    }

    /**
     * Get the badge color class for UI display
     */
    public function badgeClass(): string
    {
        return match($this) {
            self::NEW => 'bg-blue-100 text-blue-800',
            self::READ => 'bg-gray-100 text-gray-800',
            self::REPLIED => 'bg-green-100 text-green-800',
        };
    }
}
