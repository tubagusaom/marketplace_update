<?php

namespace GuzzleHttp\Tests\Message;

use GuzzleHttp\Message\AbstractMessage;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Stream\Stream;

/**
 * @covers \GuzzleHttp\Message\AbstractMessage
 */
class AbstractMessageTest extends \PHPUnit_Framework_TestCase
{
    public function testHasProtocolVersion()
    {
        $m = new Message();
        $this->assertEquals(1.1, $m->getProtocolVersion());
    }

    public function testHasHeaders()
    {
        $m = new Message();
        $this->assertFalse($m->hasHeader('foo'));
        $m->addHeader('foo', 'bar');
        $this->assertTrue($m->hasHeader('foo'));
    }

    public function testInitializesMessageWithProtocolVersionOption()
    {
        $m = new Request('GET', '/', [], null, [
            'protocol_version' => '10'
        ]);
        $this->assertEquals(10, $m->getProtocolVersion());
    }

    public function testHasBody()
    {
        $m = new Message();
        $this->assertNull($m->getBody());
        $s = Stream::factory('test');
        $m->setBody($s);
        $this->assertSame($s, $m->getBody());
        $this->assertFalse($m->hasHeader('Content-Length'));
    }

    public function testCanRemoveBodyBySettingToNullAndRemovesCommonBodyHeaders()
    {
        $m = new Message();
        $m->setBody(Stream::factory('foo'));
        $m->setHeader('Content-Length', 3)->setHeader('Transfer-Encoding', 'chunked');
        $m->setBody(null);
        $this->assertNull($m->getBody());
        $this->assertFalse($m->hasHeader('Content-Length'));
        $this->assertFalse($m->hasHeader('Transfer-Encoding'));
    }

    public function testCastsToString()
    {
        $m = new Message();
        $m->setHeader('foo', 'bar');
        $m->setBody(Stream::factory('baz'));
        $this->assertEquals("Foo!\r\nfoo: bar\r\n\r\nbaz", (string) $m);
    }

    public function parseParamsProvider()
    {
        $res1 = array(
            array(
                '<http:/.../front.jpeg>',
                'rel' => 'front',
                'type' => 'image/jpeg',
            ),
            array(
                '<http://.../back.jpeg>',
                'rel' => 'back',
                'type' => 'image/jpeg',
            ),
        );

        return array(
            array(
                '<http:/.../front.jpeg>; rel="front"; type="image/jpeg", <http://.../back.jpeg>; rel=back; type="image/jpeg"',
                $res1
            ),
            array(
                '<http:/.../front.jpeg>; rel="front"; type="image/jpeg",<http://.../back.jpeg>; rel=back; type="image/jpeg"',
                $res1
            ),
            array(
                'foo="baz"; bar=123, boo, test="123", foobar="foo;bar"',
                array(
                    array('foo' => 'baz', 'bar' => '123'),
                    array('boo'),
                    array('test' => '123'),
                    array('foobar' => 'foo;bar')
                )
            ),
            array(
                '<http://.../side.jpeg?test=1>; rel="side"; type="image/jpeg",<http://.../side.jpeg?test=2>; rel=side; type="image/jpeg"',
                array(
                    array('<http://.../side.jpeg?test=1>', 'rel' => 'side', 'type' => 'image/jpeg'),
                    array('<http://.../side.jpeg?test=2>', 'rel' => 'side', 'type' => 'image/jpeg')
                )
            ),
            array(
                '',
                array()
            )
        );
    }

    /**
     * @dataProvider parseParamsProvider
     */
    public function testParseParams($header, $result)
    {
        $request = new Request('GET', '/', ['foo' => $header]);
        $this->assertEquals($result, Message::parseHeader($request, 'foo'));
    }

    public function testAddsHeadersWhenNotPresent()
    {
        $h = new Message();
        $h->addHeader('foo', 'bar');
        $this->assertInternalType('string', $h->getHeader('foo'));
        $this->assertEquals('bar', $h->getHeader('foo'));
    }

    public function testAddsHeadersWhenPresentSameCase()
    {
        $h = new Message();
        $h->addHeader('foo', 'bar')->addHeader('foo', 'baz');
        $this->assertEquals('bar, baz', $h->getHeader('foo'));
        $this->assertEquals(['bar', 'baz'], $h->getHeader('foo', true));
    }

    public function testAddsMultipleHeaders()
    {
        $h = new Message();
        $h->addHeaders([
            'foo' => ' bar',
            'baz' => [' bam ', 'boo']
        ]);
        $this->assertEquals([
            'foo' => ['bar'],
            'baz' => ['bam', 'boo']
        ], $h->getHeaders());
    }

    public function testAddsHeadersWhenPresentDifferentCase()
    {
        $h = new Message();
        $h->addHeader('Foo', 'bar')->addHeader('fOO', 'baz');
        $this->assertEquals('bar, baz', $h->getHeader('foo'));
    }

    public function testAddsHeadersWithArray()
    {
        $h = new Message();
        $h->addHeader('Foo', ['bar', 'baz']);
        $this->assertEquals('bar, baz', $h->getHeader('foo'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWhenInvalidValueProvidedToAddHeader()
    {
        (new Message())->addHeader('foo', false);
    }

    public function testGetHeadersReturnsAnArrayOfOverTheWireHeaderValues()
    {
        $h = new Message();
        $h->addHeader('foo', 'bar');
        $h->addHeader('Foo', 'baz');
        $h->addHeader('boO', 'test');
        $result = $h->getHeaders();
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('Foo', $result);
        $this->assertArrayNotHasKey('foo', $result);
        $this->assertArrayHasKey('boO', $result);
        $this->assertEquals(['bar', 'baz'], $result['Foo']);
        $this->assertEquals(['test'], $result['boO']);
    }

    public function testSetHeaderOverwritesExistingValues()
    {
        $h = new Message();
        $h->setHeader('foo', 'bar');
        $this->assertEquals('bar', $h->getHeader('foo'));
        $h->setHeader('Foo', 'baz');
        $this->assertEquals('baz', $h->getHeader('foo'));
        $this->assertArrayHasKey('Foo', $h->getHeaders());
    }

    public function testSetHeaderOverwritesExistingValuesUsingHeaderArray()
    {
        $h = new Message();
        $h->setHeader('foo', ['bar']);
        $this->assertEquals('bar', $h->getHeader('foo'));
    }

    public function testSetHeaderOverwritesExistingValuesUsingArray()
    {
        $h = new Message();
        $h->setHeader('foo', ['bar']);
        $this->assertEquals('bar', $h->getHeader('foo'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWhenInvalidValueProvidedToSetHeader()
    {
        (new Message())->setHeader('foo', false);
    }

    public function testSetHeadersOverwritesAllHeaders()
    {
        $h = new Message();
        $h->setHeader('foo', 'bar');
        $h->setHeaders(['foo' => 'a', 'boo' => 'b']);
        $this->assertEquals(['foo' => ['a'], 'boo' => ['b']], $h->getHeaders());
    }

    public function testChecksIfCaseInsensitiveHeaderIsPresent()
    {
        $h = new Message();
        $h->setHeader('foo', 'bar');
        $this->assertTrue($h->hasHeader('foo'));
        $this->assertTrue($h->hasHeader('Foo'));
        $h->setHeader('fOo', 'bar');
        $this->assertTrue($h->hasHeader('Foo'));
    }

    public function testRemovesHeaders()
    {
        $h = new Message();
        $h->setHeader('foo', 'bar');
        $h->removeHeader('foo');
        $this->assertFalse($h->hasHeader('foo'));
        $h->setHeader('Foo', 'bar');
        $h->removeHeader('FOO');
        $this->assertFalse($h->hasHeader('foo'));
    }

    public function testReturnsCorrectTypeWhenMissing()
    {
        $h = new Message();
        $this->assertInternalType('string', $h->getHeader('foo'));
        $this->assertInternalType('array', $h->getHeader('foo', true));
    }

    public function testSetsIntegersAndFloatsAsHeaders()
    {
        $h = new Message();
        $h->setHeader('foo', 10);
        $h->setHeader('bar', 10.5);
        $h->addHeader('foo', 10);
        $h->addHeader('bar', 10.5);
        $this->assertSame('10, 10', $h->getHeader('foo'));
        $this->assertSame('10.5, 10.5', $h->getHeader('bar'));
    }
}

class Message extends AbstractMessage
{
    protected function getStartLine()
    {
        return 'Foo!';
    }
}
