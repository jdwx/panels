<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


interface CssListInterface {


    public function addCss( CssInterface $i_css ) : void;


    public function addCssInline( string $i_stCss ) : void;


    public function addCssUri( string $i_stCssUri ) : void;


    /** @return iterable<CssInterface> */
    public function cssList() : iterable;


}