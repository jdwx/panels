<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


class ScriptBody extends AbstractScript {


    public function __construct( private readonly string $stBody ) {}


    protected function inner() : string {
        return $this->stBody;
    }


}