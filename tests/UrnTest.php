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
            array("urn:foo:%ff"),
            array("urn:x-:foo"),        // valid, but should it be?
            array("urn:foo:bar:"),      // valid, but should it be?
            array("urn:foo:bar::::::"), // valid, but should it be?

            // from https://en.wikipedia.org/wiki/Uniform_resource_name#Examples
            array("urn:isbn:0451450523"),
            array("urn:isan:0000-0000-9E59-0000-O-0000-0000-2"),
            array("urn:issn:0167-6423"),
            array("urn:ietf:rfc:2648"),
            array("urn:mpeg:mpeg7:schema:2001"),
            array("urn:oid:2.16.840"),
            array("urn:uuid:6e8bc430-9c3a-11d9-9669-0800200c9a66"),
            array("urn:nbn:de:bvb:19-146642"),
            array("urn:lex:eu:council:directive:2010-03-09;2010-19-UE"),

            // from the RFC
            array("URN:foo:a123,456"),
            array("urn:foo:a123,456"),
            array("urn:FOO:a123,456"),
            array("urn:foo:A123,456"),
            array("urn:foo:a123%2C456"),
            array("URN:FOO:a123%2c456"),
        );
    }

    public function invalidUrnProvider()
    {
        return array(
            array("urn:nl.surfconext.licenseInfo"),
            array("foo:bar:baz"),
            array("urn:f:bar"),
            array("urn:foo:%00"),       // cannot contain %00
            array("urn:x:foo"),         // NID should be at least length 2
            array("urn:x-oauth:%gg"),   // encoding should be HEX
            array("urn:%aa:xyz"),       // NID cannot contain encoded chars
        );
    }

}
