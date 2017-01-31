<?php

namespace Lch\MediaBundle\Validator\Constraints;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ImageExtensionValidator extends ConstraintValidator
{

    private $logger;
    private $rootDir;

    public function __construct(Logger $logger, $rootDir)
    {
        $this->logger = $logger;
        $this->rootDir = $rootDir;
    }

    /**
     * @param mixed $value
     * @param Constraint|ImageExtension $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (null !== $value) {
            $allowed = false;
            $file = new File($this->rootDir.'/../web'.$value->getFile());

            $this->logger->addDebug('CustomImageValidator: '.$file->guessExtension());

            if (in_array(strtolower($file->guessExtension()), $constraint->extensions)) {
                $allowed = true;
            }

            if ($allowed === false) {
                $this->context->buildViolation($constraint->message . implode(', ', $constraint->extensions))
                    ->addViolation();
            }
        }
    }
}