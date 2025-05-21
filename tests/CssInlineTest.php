<?php


declare( strict_types = 1 );


use JDWX\Panels\CssInline;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass(CssInline::class)]
final class CssInlineTest extends TestCase {


    public function testBasic() : void {
        $css = new CssInline( '.foo' );
        self::assertEquals( '<style>.foo</style>', strval( $css ) );
    }


}
