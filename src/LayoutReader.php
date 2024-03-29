<?php

//from: https://dev.to/joemoses33/create-a-composer-package-how-to-29kn
namespace Dagai\PhpFlatFile;

class LayoutReader {
    
    public static function readFromFile( $file ){
        return LayoutReader::read( file_get_contents( $file ) );
    }

    public static function read( $content ){
        $xml = simplexml_load_string( $content );
        $xml = json_encode( $xml );
        $xml = json_decode( $xml );
        
        $layout = new Layout();
        $layout->name        = trim( $xml->layout->name );
        $layout->version     = trim( $xml->layout->version );
        $layout->description = trim( $xml->layout->description );

        if( !is_array( $xml->Records->Record ) )
        {
            $xml->Records->Record = [
                $xml->Records->Record
            ];
        }

        foreach( $xml->Records->Record as $record ){
            $record = Util::toArray( $record );
            
            $obj = new Record();
            $obj->name        = trim( $record["@attributes"]["name"] );
            $obj->description = trim( $record["@attributes"]["description"] );
            
            $obj->fields[] = LayoutReader::readField( $record["Fields"]["IdType"] );

            foreach( $record["Fields"]["Field"] as $field ){
                $obj->fields[] = LayoutReader::readField( $field );
            }

            $layout->records[] = $obj;
        }

        return $layout;

    }

    private static function readField( $field ){
        $field = Util::toArray( $field )[ "@attributes" ];

        $obj = new Field();
        
        Util::set( "name"    , $obj , $field );
        Util::set( "length"  , $obj , $field );
        Util::set( "type"    , $obj , $field );
        Util::set( "format"  , $obj , $field );
        Util::set( "padding" , $obj , $field );
        Util::set( "value"   , $obj , $field );

        return $obj;
    }

}
