<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


abstract class AbstractPanel implements PanelInterface {


    use BodyStubTrait;


    /** @return iterable<CssInterface> */
    public function cssList() : iterable {
        return [];
    }


    /** @return iterable<string|\Stringable> */
    public function headerList() : iterable {
        return [];
    }


    /** @return iterable<ScriptInterface> */
    public function scriptList() : iterable {
        return [];
    }


}