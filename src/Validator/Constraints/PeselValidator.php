<?php

declare(strict_types=1);

namespace PAJERdesign\PeselValidator\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author Robert Pajer
 */
class PeselValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Pesel) {
            throw new UnexpectedTypeException($constraint, Pesel::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!ctype_digit($value)) {
            $this->context->buildViolation($constraint->invalidFormatMessage)
                ->setCode(Pesel::INVALID_FORMAT_ERROR)
                ->addViolation();

            return;
        }

        if (strlen($value) < 11) {
            $this->context->buildViolation($constraint->tooShortdMessage)
                ->setCode(Pesel::TOO_SHORT_ERROR)
                ->addViolation();

            return;
        }

        if (strlen($value) > 11) {
            $this->context->buildViolation($constraint->tooLongdMessage)
                ->setCode(Pesel::TOO_LONG_ERROR)
                ->addViolation();

            return;
        }

        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $checkSum = 0;
        $chars = str_split($value);

        $sum = array_sum(
            array_map(
                function($weight, $digit) {
                    $stepValue = $weight * $digit;

                    if ($stepValue >= 10) {
                        return $stepValue % 10;
                    }

                    return $stepValue;
                },
                $weights,
                array_slice($chars, 0, 10)
            )
        );

        if ((10 - ($sum % 10)) % 10 != $chars[11]) {
            $this->context->buildViolation($constraint->checkSumFailedMessage)
                ->setCode(Pesel::CHECKSUM_FAILED_ERROR)
                ->addViolation();
        }
    }
}
