<?php 

namespace App\Enums;

class DocumentStatus
{
    public const PHYSICAL_DOCUMENT = 1;
    public const RECEIVED_DOCUMENT = 2;

    public static function toArray(): array
    {
        return [
            self::PHYSICAL_DOCUMENT => 'Physical Document Sent To HQ',
            self::RECEIVED_DOCUMENT => 'Received Document From Clinic'
        ];
    }
    
    public static function getName($value): string
    {
        switch ($value) {
            case self::PHYSICAL_DOCUMENT:
                return 'Physical Document Sent To HQ';
            case self::RECEIVED_DOCUMENT:
                return 'Received Document From Clinic';
            default:
                return '';
        }
    }
}