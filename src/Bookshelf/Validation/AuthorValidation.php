<?php

namespace Bookshelf\Validation;

use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

class AuthorValidation extends Validation
{
    public function __construct()
    {
        parent::__construct([
            'name' => v::length(1, 100, true)
        ]);
    }
}
