<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


use InvalidArgumentException;
use JDWX\Stream\StreamHelper;
use Stringable;


trait PanelContainerTrait {


    /** @var list<PanelInterface> */
    private array $rPanels = [];


    /**
     * @suppress PhanPossiblyUndeclaredPropertyOfClass Phan gets confused by testing
     * $this instanceof PanelInterface because PanelInterface doesn't have $rPanels
     * defined.
     */
    public function appendPanel( PanelInterface $i_panel ) : void {
        if ( $this->containsPanel( $i_panel ) ) {
            throw new InvalidArgumentException( 'Panel already exists in this container.' );
        }
        if ( $i_panel instanceof PanelContainerInterface && $this instanceof PanelInterface &&
            $i_panel->containsPanel( $this ) ) {
            throw new InvalidArgumentException( 'Panel cannot contain itself.' );
        }
        $this->rPanels[] = $i_panel;
    }


    public function containsPanel( PanelInterface $i_panel ) : bool {
        if ( $i_panel === $this ) {
            return true;
        }
        foreach ( $this->rPanels as $panel ) {
            if ( $panel === $i_panel ) {
                return true;
            }
            if ( $panel instanceof PanelContainerInterface && $panel->containsPanel( $i_panel ) ) {
                return true;
            }
        }
        return false;
    }


    public function prependPanel( PanelInterface $i_panel ) : void {
        array_unshift( $this->rPanels, $i_panel );
    }


    /** @param iterable<PanelInterface> $i_rPanels */
    public function setPanels( iterable $i_rPanels ) : void {
        $this->rPanels = iterator_to_array( $i_rPanels, false );
    }


    /** @return iterable<iterable<string|Stringable>|string|Stringable> */
    protected function _body() : iterable {
        foreach ( $this->rPanels as $panel ) {
            yield from StreamHelper::yield( $panel->body() );
        }
    }


    /** @return iterable<iterable<string|Stringable>|string|Stringable> */
    protected function _bodyEarly() : iterable {
        foreach ( $this->rPanels as $panel ) {
            yield from StreamHelper::yield( $panel->bodyEarly() );
        }
    }


    /** @return iterable<iterable<string|Stringable>|string|Stringable> */
    protected function _bodyLate() : iterable {
        foreach ( $this->rPanels as $panel ) {
            yield from StreamHelper::yield( $panel->bodyLate() );
        }
    }


    /** @return iterable<CssInterface> */
    protected function _cssList() : iterable {
        foreach ( $this->rPanels as $panel ) {
            yield from $panel->cssList();
        }
    }


    protected function _first() : void {
        foreach ( $this->rPanels as $panel ) {
            $panel->first();
        }
    }


    /** @return iterable<string|Stringable> */
    protected function _head() : iterable {
        foreach ( $this->rPanels as $panel ) {
            yield from StreamHelper::yield( $panel->head() );
        }
    }


    /** @return iterable<string|Stringable> */
    protected function _headerList() : iterable {
        foreach ( $this->rPanels as $panel ) {
            foreach ( $panel->headerList() as $header ) {
                yield $header;
            }
        }
    }


    protected function _last() : void {
        foreach ( $this->rPanels as $panel ) {
            $panel->last();
        }
    }


    /** @return iterable<ScriptInterface> */
    protected function _scriptList() : iterable {
        foreach ( $this->rPanels as $panel ) {
            yield from $panel->scriptList();
        }
    }


}