<?php

/**
 * Copyright 2013 François Kooman <fkooman@tuxed.net>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "Validator" . DIRECTORY_SEPARATOR . "Urn.php";

use \Validator\Urn as Urn;

class UrnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validUrnProvider
     */
    public function testValidUrn($urn)
    {
        $this->assertEquals(TRUE, Urn::validate($urn));
    }

    /**
     * @dataProvider invalidUrnProvider
     */
    public function testInvalidUrn($urn)
    {
        $this->assertEquals(FALSE, Urn::validate($urn));
    }

    public function validUrnProvider()
    {
        return array(
            array("urn:mace:dir:attribute-def:uid"),
            array("urn:foo:bar"),
            array("urn:oid:0.9.2342.19200300.100.1.3"),
            array("urn:foo:%ff")
        );
    }

    public function invalidUrnProvider()
    {
        return array(
            array("urn:nl.surfconext.licenseInfo"),
            array("foo:bar:baz"),
            array("urn:f:bar"),
            array("urn:foo:%00"),   // cannot contain %00
        );
    }

}
