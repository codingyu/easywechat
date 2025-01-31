<?php

declare(strict_types=1);

namespace EasyWeChat\Tests\Kernel;

use EasyWeChat\Kernel\Client;
use EasyWeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function test_full_uri_call()
    {
        $client = Client::mock();

        $options = [
            'headers' => [
                'accept' => 'application/json',
            ],
        ];

        $client->request('GET', 'https://api2.mch.weixin.qq.com/v3/certificates', $options);

        $this->assertSame('GET', $client->getRequestMethod());
        $this->assertSame('https://api2.mch.weixin.qq.com/v3/certificates', $client->getRequestUrl());
        $this->assertSame(['accept: application/json'], $client->getRequestOptions()['headers']);
    }

    public function test_shortcuts_call()
    {
        $client = Client::mock();

        $client->get('v3/certificates', [
            'headers' => [
                'accept' => 'application/json',
            ],
        ]);

        $this->assertSame('GET', $client->getRequestMethod());
        $this->assertSame('https://example.com/v3/certificates', $client->getRequestUrl());
        $this->assertSame(['accept: application/json'], $client->getRequestOptions()['headers']);
    }

    public function test_it_will_auto_wrap_body()
    {
        $client = Client::mock();

        $client->post('v3/certificates', [
            'body' => [
                'foo' => 'bar',
            ],
        ]);

        $this->assertSame('POST', $client->getRequestMethod());
        $this->assertSame('https://example.com/v3/certificates', $client->getRequestUrl());
        $this->assertSame('foo=bar', $client->getRequestOptions()['body']);

        // post without body key
        $client = Client::mock();
        $client->post('v3/certificates', [
            'foo' => 'bar',
        ]);

        $this->assertSame('POST', $client->getRequestMethod());
        $this->assertSame('https://example.com/v3/certificates', $client->getRequestUrl());
        $this->assertSame('foo=bar', $client->getRequestOptions()['body']);

        // patch without body key
        $client = Client::mock();
        $client->patch('v3/certificates', [
            'foo' => 'bar',
        ]);

        $this->assertSame('PATCH', $client->getRequestMethod());
        $this->assertSame('https://example.com/v3/certificates', $client->getRequestUrl());
        $this->assertSame('foo=bar', $client->getRequestOptions()['body']);

        // put without body key
        $client = Client::mock();
        $client->put('v3/certificates', [
            'foo' => 'bar',
        ]);

        $this->assertSame('PUT', $client->getRequestMethod());
        $this->assertSame('https://example.com/v3/certificates', $client->getRequestUrl());
        $this->assertSame('foo=bar', $client->getRequestOptions()['body']);
    }
}
