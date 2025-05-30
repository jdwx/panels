<?php


declare( strict_types = 1 );


use JDWX\Panels\AbstractPanel;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( AbstractPanel::class )]
final class AbstractPanelTest extends TestCase {


    /**
     * The class we are testing has almost no functionality.
     */
    public function testSimple() : void {
        $panel = $this->newPanel();
        $panel->first();
        self::assertSame( [], $panel->headerList() );
        self::assertSame( [], $panel->cssList() );
        self::assertSame( '', $panel->head() );
        self::assertSame( '', $panel->bodyEarly() );
        self::assertSame( 'BODY', $panel->body() );
        self::assertSame( '', $panel->bodyLate() );
        self::assertSame( [], $panel->scriptList() );
        $panel->last();
    }


    private function newPanel() : AbstractPanel {
        return new class( 'BODY' ) extends AbstractPanel {


            public function __construct( private readonly string $stBody ) {}


            public function body() : string {
                return $this->stBody;
            }


        };
    }


}