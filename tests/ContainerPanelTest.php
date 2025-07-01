<?php


declare( strict_types = 1 );


use JDWX\Panels\ContainerPanel;
use JDWX\Panels\PanelPage;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Shims\MyBodyPanel;


#[CoversClass( ContainerPanel::class )]
final class ContainerPanelTest extends TestCase {


    public function testAppendPanelForDeeperLoop() : void {
        $cont1 = new ContainerPanel();
        $cont2 = new ContainerPanel();
        $cont1->appendPanel( $cont2 );
        $cont3 = new ContainerPanel();
        $cont2->appendPanel( $cont3 );
        self::expectException( InvalidArgumentException::class );
        self::expectExceptionMessage( 'cannot contain itself' );
        $cont3->appendPanel( $cont1 );
    }


    public function testAppendPanelForDontAppendYourself() : void {
        $cont1 = new ContainerPanel();
        self::expectException( InvalidArgumentException::class );
        self::expectExceptionMessage( 'already exists' );
        $cont1->appendPanel( $cont1 );
    }


    public function testAppendPanelForWeVeAlreadyGotOne() : void {
        $panel1 = new MyBodyPanel();
        $cont1 = new ContainerPanel( [ $panel1 ] );
        self::expectException( InvalidArgumentException::class );
        self::expectExceptionMessage( 'already exists' );
        $cont1->appendPanel( $panel1 );
    }


    public function testNested() : void {
        $panel1 = new MyBodyPanel();
        $panel1->stBody = 'Foo';
        $panel2 = new MyBodyPanel();
        $panel2->stBody = 'Bar';
        $cont1 = new ContainerPanel( [ $panel1, $panel2 ] );
        $panel3 = new MyBodyPanel();
        $panel3->stBody = 'Baz';
        $panel4 = new MyBodyPanel();
        $panel4->stBody = 'Qux';
        $cont2 = new ContainerPanel( [ $panel3, $panel4 ] );
        $page = new PanelPage( [ $cont1, $cont2 ] );
        $st = $page->render();
        self::assertStringContainsString( 'FooBarBazQux', $st );
    }


}
