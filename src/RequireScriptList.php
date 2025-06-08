<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


/**
 * Using this trait (from another trait) requires that any consumer
 * of that trait will have to provide ScriptListInterface.
 *
 * @phpstan-ignore trait.unused
 */
trait RequireScriptList {


    abstract public function addScript( ScriptInterface $i_script ) : void;


    abstract public function addScriptBody( string $i_stBody ) : void;


    abstract public function addScriptUri( string $i_stScriptUri ) : void;


    /** @return iterable<ScriptInterface> */
    abstract public function scriptList() : iterable;


}