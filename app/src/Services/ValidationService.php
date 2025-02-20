<?php

namespace App\Services;

use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ValidationService
{
    public function __construct(
        private ValidatorInterface $validator
    ) {}

    public function validateData(mixed $data): mixed
    {
        $errors = $this->validator->validate($data);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                error_log($error->getMessage());
                $errorMessages[] = $error->getMessage();
            }

            return $errorMessages;
        }
        return $data;
    }
}
