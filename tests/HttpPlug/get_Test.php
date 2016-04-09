<?php
/**
 * MindTouch HTTP
 * Copyright (C) 2006-2016 MindTouch, Inc.
 * www.mindtouch.com  oss@mindtouch.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace MindTouch\Http\tests\HttpPlug;

use MindTouch\Http\HttpPlug;
use MindTouch\Http\Mock\MockPlug;
use MindTouch\Http\Mock\MockRequest;
use MindTouch\Http\Mock\MockResponse;
use MindTouch\XArray\XArray;
use PHPUnit_Framework_TestCase;

class get_Test extends PHPUnit_Framework_TestCase  {

    public function setUp() {
        MockPlug::ignoreRequestHeader(HttpPlug::HEADER_CONTENT_LENGTH);
    }

    public function tearDown() {
        MockPlug::deregisterAll();
    }

    /**
     * @test
     */
    public function Can_invoke_get() {

        // arrange
        $uri = 'http://example.com/foo/bar?baz=qux';
        MockPlug::register(
            MockRequest::newMockRequest(HttpPlug::VERB_GET, $uri, []),
            MockResponse::newMockResponse(HttpPlug::HTTPSUCCESS, [], ['page'])
        );
        $Plug = HttpPlug::newPlug($uri);

        // act
        $Result = new XArray($Plug->get());

        // assert
        $this->assertEquals(200, $Result->getVal('status'));
        $this->assertEquals('page', $Result->getVal('body'));
    }
}