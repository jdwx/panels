<?php


declare( strict_types = 1 );


namespace JDWX\Panels;


interface PanelContainerInterface {


    public function containsPanel( PanelInterface $i_panel ) : bool;


}