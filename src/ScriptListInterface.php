<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


interface ScriptListInterface {


    public function addScript( ScriptInterface $i_script ) : void;


    public function addScriptBody( string $i_stBody ) : void;


    public function addScriptUri( string $i_stScriptUri ) : void;


    /** @return iterable<ScriptInterface> */
    public function scriptList() : iterable;


}

