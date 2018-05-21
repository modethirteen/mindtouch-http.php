<?php
/**
 * MindTouch HTTP
 * Copyright (C) 2006-2018 MindTouch, Inc.
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
namespace MindTouch\Http\tests\XUri;

use MindTouch\Http\tests\MindTouchHttpUnitTestCase;
use MindTouch\Http\XUri;

class getQueryParams_Test extends MindTouchHttpUnitTestCase {

    /**
     * @test
     */
    public function Can_get_params() {

        // arrange
        $uriStr = 'http://user:password@test.mindtouch.dev/foo/bar?a=b&c=d#fragment';

        // act
        $result = XUri::tryParse($uriStr)->getQueryParams();

        // assert
        $this->assertEquals(['a' => 'b', 'c' => 'd'], $result);
    }

    /**
     * @test
     */
    public function Can_get_empty_params() {

        // arrange
        $uriStr = 'http://user:password@test.mindtouch.dev/foo/bar#fragment';

        // act
        $result = XUri::tryParse($uriStr)->getQueryParams();

        // assert
        $this->assertEquals([], $result);
    }
}