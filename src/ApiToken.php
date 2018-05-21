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
namespace MindTouch\Http;

/**
 * Class ApiToken - MindTouch API server token
 *
 * @link https://success.mindtouch.com/Support/Extend/API_Documentation/API_Tokens
 * @package MindTouch\Http
 */
class ApiToken implements IApiToken {

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var int|string
     */
    private $user = 2;

    /**
     * Returns an instance with the anonymous user context
     *
     * @param string $key
     * @param string $secret
     */
    public function __construct($key, $secret) {
        $this->key = $key;
        $this->secret = $secret;
    }

    public function withUsername($username) {
        $token = clone $this;
        $token->user = '=' . $username;
        return $token;
    }

    public function withUserId($userId) {
        $token = clone $this;
        $token->user = $userId;
        return $token;
    }

    public function toHash($timestamp = null) {
        if($timestamp === null) {
            $timestamp = time();
        }
        $hash = hash_hmac('sha256', ($this->key . $timestamp . $this->user), $this->secret, false);
        return "{$this->key}_{$timestamp}_{$this->user}_{$hash}";
    }
}