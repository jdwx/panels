<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


/**
 * Using this trait (from another trait) requires that any consumer
 * of that trait will have to provide CssListInterface.
 */
trait RequireCssList {


    abstract public function addCss( CssInterface $i_css ) : void;


    abstract public function addCssInline( string $i_stCss ) : void;


    abstract public function addCssUri( string $i_stCssUri ) : void;


    /** @return iterable<CssInterface> */
    abstract public function cssList() : iterable;


}