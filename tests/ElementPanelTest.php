<?php


declare( strict_types = 1 );


use JDWX\Panels\ElementPanel;
use JDWX\Strict\Cast;
use JDWX\Strict\TypeIs;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( ElementPanel::class )]
final class ElementPanelTest extends TestCase {


    public function testBodyForIterable() : void {
        $el = $this->newElementPanel( [ 'foo', 'bar', 'baz' ] );
        self::assertSame(
            [ '<div>', 'foo', 'bar', 'baz', '</div>' ],
            Cast::listStringy( TypeIs::iterable( $el->body() ) )
        );
    }


    public function testBodyForString() : void {
        $el = $this->newElementPanel( 'bar' );
        self::assertSame( [ '<div>', 'bar', '</div>' ], Cast::listStringy( TypeIs::iterable( $el->body() ) ) );
    }


    public function testSetAttribute() : void {
        $el = $this->newElementPanel( 'baz' );
        $el->setAttribute( 'id', 'bar' );
        $el->setAttribute( 'contenteditable' );
        self::assertSame(
            [ '<div contenteditable id="bar">', 'baz', '</div>' ],
            Cast::listStringy( TypeIs::iterable( $el->body() ) )
        );
    }


    public function testSetElement() : void {
        $el = $this->newElementPanel( 'baz' );
        $el->setElement( 'span' );
        self::assertSame( [ '<span>', 'baz', '</span>' ], Cast::listStringy( TypeIs::iterable( $el->body() ) ) );
    }


    /** @param list<string>|string $stBody */
    private function newElementPanel( array|string $stBody ) : ElementPanel {
        return new class( $stBody ) extends ElementPanel {


            /** @var list<string>|string */
            private array|string $stBody;


            /** @param list<string>|string $i_stBody */
            public function __construct( array|string $i_stBody ) {
                parent::__construct();
                $this->stBody = $i_stBody;
            }


            /** @return list<string>|string */
            protected function innerBody() : array|string {
                return $this->stBody;
            }


        };
    }


}
