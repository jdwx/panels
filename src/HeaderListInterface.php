<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


use Stringable;


interface HeaderListInterface {


    public function addHeader( string|Stringable $i_stHeader, string|Stringable|null $i_nstValue = null ) : void;


    /** @return iterable<string|Stringable> */
    public function headerList() : iterable;


}