<?php


declare( strict_types = 1 );


use JDWX\Panels\ScriptUri;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( ScriptUri::class )]
final class ScriptUriTest extends TestCase {


    public function testSrc() : void {
        $script = new ScriptUri( 'URI' );
        /** @noinspection HtmlUnknownTarget */
        $st = '<script src="URI"></script>';
        self::assertSame( $st, strval( $script ) );
    }


}