<?php

namespace App\Exception;

class ForbiddenException extends \Exception{
    public const ACCESS_DENIED_EXCEPTION_MESSAGE = "Vous n'êtes pas autorisé à accéder à cette page";
}
