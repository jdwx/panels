<?php


declare( strict_types = 1 );


use JDWX\Panels\AbstractBodyPanel;
use JDWX\Panels\CssLink;
use JDWX\Panels\ScriptUri;
use JDWX\Panels\SimplePanel;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( AbstractBodyPanel::class )]
#[UsesClass( SimplePanel::class )]
#[UsesClass( CssLink::class )]
#[UsesClass( ScriptUri::class )]
final class AbstractBodyPanelTest extends TestCase {


    public function testAddCss() : void {
        $panel = new SimplePanel( 'foo' );
        $css = new CssLink( 'URI' );
        $panel->addCss( $css );
        self::assertSame( [ $css ], iterator_to_array( $panel->cssList() ) );
        $css2 = new CssLink( 'URI2' );
        $panel->addCss( $css2 );
        self::assertSame(
            [ $css, $css2 ],
            iterator_to_array( $panel->cssList() )
        );
    }


    public function testAddHeader() : void {
        $panel = new SimplePanel( 'foo' );
        $panel->addHeader( 'HEADER' );
        self::assertSame( [ 'HEADER' ], iterator_to_array( $panel->headerList() ) );
        $panel->addHeader( 'HEADER2', 'VALUE' );
        self::assertSame(
            [ 'HEADER', 'HEADER2: VALUE' ],
            iterator_to_array( $panel->headerList() )
        );
    }


    public function testAddScript() : void {
        $panel = new SimplePanel( 'foo' );
        $script = new ScriptUri( 'URI' );
        $panel->addScript( $script );
        self::assertSame( [ $script ], iterator_to_array( $panel->scriptList() ) );
        $script2 = new ScriptUri( 'URI2' );
        $panel->addScript( $script2 );
        self::assertSame(
            [ $script, $script2 ],
            iterator_to_array( $panel->scriptList() )
        );
    }


    /** @noinspection HtmlUnknownTarget */
    public function testAddScriptUri() : void {
        $panel = new SimplePanel( 'foo' );
        $panel->addScriptUri( 'URI' );
        $out = array_map( function ( $x ) {
            return strval( $x );
        }, iterator_to_array( $panel->scriptList() ) );
        self::assertSame( [ '<script src="URI"></script>' ], $out );
        $panel->addScriptUri( 'URI2' );
        $out = array_map( function ( $x ) {
            return strval( $x );
        }, iterator_to_array( $panel->scriptList() ) );
        self::assertSame(
            [ '<script src="URI"></script>', '<script src="URI2"></script>' ],
            $out );
    }


}