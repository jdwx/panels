<?php


declare( strict_types = 1 );


use JDWX\Panels\SimpleElementPanel;
use JDWX\Stream\StreamHelper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( SimpleElementPanel::class )]
final class SimpleElementPanelTest extends TestCase {


    public function testAddBody() : void {
        $panel = new SimpleElementPanel( 'foo', 'bar' );
        $panel->addBody( 'baz' );
        $panel->addBody( 'qux' );
        self::assertSame(
            [ '<foo>', 'bar', 'baz', 'qux', '</foo>' ],
            StreamHelper::asList( $panel->body() )
        );
    }


    public function testConstruct() : void {
        $panel = new SimpleElementPanel( 'foo', 'bar' );
        self::assertSame( [ '<foo>', 'bar', '</foo>' ], StreamHelper::asList( $panel->body() ) );
    }


}
