<?php

namespace Dagai\PhpFlatFile;

class Layout {
    public $name;
    public $version;
    public $description;
    public $records = [];
    
    public function __construct( $arr = [] ){
        Util::set( "name"        , $this , $arr );
        Util::set( "version"     , $this , $arr );
        Util::set( "description" , $this , $arr );
        Util::set( "records"     , $this , $arr );
    }

    public function readFromFile( $file ){
        return $this->read( file_get_contents( $file ) );
    }

    public function read( $content ){
        return $this->readLines(
            Util::splitByNewLine( $content )
        );
    }

    public function readLines( $lines ){
        $data = [];

        foreach( $lines as $line ){
            foreach( $this->records as $record ){
                if( $record->is( $line ) ){
                    $data[] = $record->read( $line );
                    continue;
                }
            }
        }
        
        return $data;
    }

    // -------- //
    // -------- // WRITE
    // -------- //

    public function write( $datas ){
        $lines = [];
        
        foreach( $datas as $data ){
            foreach( $this->records as $record ){
                if( $record->is( $data ) ){
                    $lines[] = $record->write( $data );
                    continue;
                }
            }
        }

        return $lines;
    }

}
