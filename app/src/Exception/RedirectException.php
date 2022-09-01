<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectException extends \Exception
{
    private RedirectResponse $redirectResponse;

    public function __construct(
        string     $url = '',
        string     $message = "",
        int        $code = 0,
        \Exception $previousException = null
    )
    {
        $this->redirectResponse = new RedirectResponse($url);
        parent::__construct($message, $code, $previousException);
    }

    public function getRedirectResponse(): RedirectResponse
    {
        return $this->redirectResponse;
    }
}
