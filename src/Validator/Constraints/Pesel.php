<?php

declare(strict_types=1);

namespace PAJERdesign\PeselValidator\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Robert Pajer
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Pesel extends Constraint
{
    public const CHECKSUM_FAILED_ERROR = 'dc22c840-6332-11ed-81ce-0242ac120002';
    public const TOO_SHORT_ERROR = 'dc22ccbe-6332-11ed-81ce-0242ac120002';
    public const TOO_LONG_ERROR = 'dc22ce4e-6332-11ed-81ce-0242ac120002';
    public const INVALID_FORMAT_ERROR = 'dc22d236-6332-11ed-81ce-0242ac120002';

    protected const ERROR_NAMES = [
        self::CHECKSUM_FAILED_ERROR => 'CHECKSUM_FAILED_ERROR',
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_LONG_ERROR => 'TOO_LONG_ERROR',
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
    ];

    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = [
        self::CHECKSUM_FAILED_ERROR => 'CHECKSUM_FAILED_ERROR',
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_LONG_ERROR => 'TOO_LONG_ERROR',
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
    ];

    public $checkSumFailedMessage = 'The pesel number provided is incorrect';
    public $tooShortdMessage = 'The pesel number provided is too short';
    public $tooLongdMessage = 'The pesel number provided is too long';
    public $invalidFormatMessage = 'The pesel number provided contains not permitted characters';

    public function __construct(
        array $options = null,
        ?string $checkSumFailedMessage = null,
        ?string $tooShortdMessage = null,
        ?string $tooLongdMessage = null,
        ?string $invalidFormatMessage = null,
        array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct($options ?? [], $groups, $payload);

        $this->checkSumFailedMessage = $checkSumFailedMessage ?? $this->checkSumFailedMessage;
        $this->tooShortdMessage = $tooShortdMessage ?? $this->tooShortdMessage;
        $this->tooLongdMessage = $tooLongdMessage ?? $this->tooLongdMessage;
        $this->invalidFormatMessage = $invalidFormatMessage ?? $this->invalidFormatMessage;
    }
}