<?php

//from: https://dev.to/joemoses33/create-a-composer-package-how-to-29kn
namespace Dagai\PhpFlatFile;

class FlatFile {
    public $layout;

    public function __construct( $layout = null ){
        $this->layout = is_string( $layout ) 
            ? LayoutReader::readFromFile( $layout ) 
            : $layout;
    }
    
    public function layout( $xml ){
        $this->layout = LayoutReader::readFromFile( $xml );
        return $this;
    }

    public function read( $file ){
        return $this->layout->readFromFile( $file );
    }

    public function getLines( $datas ){
        return $this->layout->write( $datas );
    }

    public function write( $datas ){
        return join( "\r\n" , $this->getLines( $datas ) );
    }
    
}
