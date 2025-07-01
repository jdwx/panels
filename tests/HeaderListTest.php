<?php


declare( strict_types = 1 );


use JDWX\Panels\HeaderListTrait;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;


#[CoversTrait( HeaderListTrait::class )]
class HeaderListTest extends TestCase {


    public function testAddHeader() : void {
        $obj = $this->newObject();
        $obj->addHeader( 'foo' );
        self::assertSame( [ 'foo' ], iterator_to_array( $obj->headerList() ) );
        $obj->addHeader( 'bar', 'baz' );
        self::assertSame(
            [ 'foo', 'bar: baz' ],
            iterator_to_array( $obj->headerList() )
        );
    }


    private function newObject() : object {
        return new class() {


            use HeaderListTrait;


            public function text() : string {
                $st = '';
                /** @noinspection PhpLoopCanBeReplacedWithImplodeInspection */
                foreach ( $this->headerList() as $header ) {
                    $st .= $header;
                }
                return $st;
            }


        };
    }


}
