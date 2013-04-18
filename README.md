# Introduction
This project includes an URN validator according to RFC 2141.

# API
Use the static function to validate the URN:

    require_once '/PATH/TO/php-urn-validator/lib/Validator/Urn.php';

    if (FALSE === \Validator\Urn::validate("urn:foo:bar")) {
        // invalid URN
    } else {
        // valid URN
    }

# License
Licensed under the Apache License, Version 2.0;

   http://www.apache.org/licenses/LICENSE-2.0
