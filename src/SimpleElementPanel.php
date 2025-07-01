<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


use Stringable;


class SimpleElementPanel extends ElementPanel {


    /** @var list<string|Stringable> */
    private array $rBody;


    /** @param list<string|Stringable>|string|Stringable $i_body */
    public function __construct( string $stElement = 'div', array|string|Stringable $i_body = [] ) {
        parent::__construct( $stElement );
        if ( ! is_array( $i_body ) ) {
            $i_body = [ $i_body ];
        }
        $this->rBody = $i_body;
    }


    public function addBody( string|Stringable $stBody ) : void {
        $this->rBody[] = $stBody;
    }


    /** @return iterable<string|Stringable>|string|Stringable */
    protected function innerBody() : iterable|string|Stringable {
        return $this->rBody;
    }


}
