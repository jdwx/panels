<?php


declare( strict_types = 1 );


use JDWX\Panels\AbstractScript;
use JDWX\Panels\ScriptUri;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( AbstractScript::class )]
#[UsesClass( ScriptUri::class )]
final class AbstractScriptTest extends TestCase {


    public function testAsync() : void {
        $script = new ScriptUri( 'URI' );
        $script->setAsync();
        /** @noinspection HtmlUnknownTarget */
        $st = '<script async src="URI"></script>';
        self::assertSame( $st, strval( $script ) );
    }


    public function testDefer() : void {
        $script = new ScriptUri( 'URI' );
        $script->setDefer();
        /** @noinspection HtmlUnknownTarget */
        $st = '<script defer src="URI"></script>';
        self::assertSame( $st, strval( $script ) );
    }


}