<?php


declare( strict_types = 1 );


use JDWX\Panels\AbstractScript;
use JDWX\Panels\ScriptBody;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( AbstractScript::class )]
#[CoversClass( ScriptBody::class )]
final class ScriptBodyTest extends TestCase {


    public function testBody() : void {
        $script = new ScriptBody( 'let foo = "bar"' );
        self::assertSame( '<script>let foo = "bar"</script>', strval( $script ) );
    }


}