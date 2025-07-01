<?php


declare( strict_types = 1 );


use JDWX\Panels\CssInline;
use JDWX\Panels\CssLink;
use JDWX\Panels\CssListTrait;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;


#[CoversTrait( CssListTrait::class )]
#[UsesClass( CssInline::class )]
#[UsesClass( CssLink::class )]
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


    public function testAddCssInline() : void {
        $obj = $this->newObject();
        $obj->addCssInline( '.foo' );
        $st = $obj->text();
        self::assertSame( '<style>.foo</style>', $st );
    }


    public function testAddCssStylesheet() : void {
        $obj = $this->newObject();
        $obj->addCssUri( 'foo' );
        $st = $obj->text();
        /** @noinspection HtmlUnknownTarget */
        self::assertSame( '<link href="foo" rel="stylesheet">', $st );
    }


    private function newObject() : object {
        return new class() {


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
