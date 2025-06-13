<?php


declare( strict_types = 1 );


use JDWX\Panels\CssInline;
use JDWX\Panels\CssLink;
use JDWX\Panels\CssListInterface;
use JDWX\Panels\CssListTrait;
use PHPUnit\Framework\TestCase;


final class CssListTest extends TestCase {


    public function testAddCss() : void {
        $obj = $this->newObject();
        $css = new CssLink( 'URI' );
        $obj->addCss( $css );
        self::assertSame( [ $css ], iterator_to_array( $obj->cssList() ) );
        $css2 = new CssInline( 'URI2' );
        $obj->addCss( $css2 );
        self::assertSame(
            [ $css, $css2 ],
            iterator_to_array( $obj->cssList() )
        );
    }


    /** @suppress PhanUndeclaredMethod */
    public function testAddCssInline() : void {
        $obj = $this->newObject();
        $obj->addCssInline( '.foo' );
        assert( method_exists( $obj, 'text' ) );
        $st = $obj->text();
        self::assertSame( '<style>.foo</style>', $st );
    }


    /** @suppress PhanUndeclaredMethod */
    public function testAddCssStylesheet() : void {
        $obj = $this->newObject();
        $obj->addCssUri( 'foo' );
        assert( method_exists( $obj, 'text' ) );
        $st = $obj->text();
        /** @noinspection HtmlUnknownTarget */
        self::assertSame( '<link href="foo" rel="stylesheet">', $st );
    }


    private function newObject() : CssListInterface {
        return new class() implements CssListInterface {


            use CssListTrait;


            public function text() : string {
                $st = '';
                /** @noinspection PhpLoopCanBeReplacedWithImplodeInspection */
                foreach ( $this->cssList() as $css ) {
                    $st .= $css;
                }
                return $st;
            }


        };
    }


}
