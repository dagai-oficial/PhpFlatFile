<?php

namespace Dagai\PhpFlatFile;

class Record {
    public $name;
    public $description;
    public $fields = [];

    public function __construct( $obj = [] ){
        Util::set( "name"        , $this , $obj );
        Util::set( "description" , $this , $obj );
        Util::set( "fields"      , $this , $obj );
    }

    public function is( $line ){
        $name  = $this->fields[0]->name;
        $value = $this->fields[0]->value;

        // evitar erros
        if( is_object( $line ) && !property_exists( $name , $line ) ) $line->$name   = null;
        else if( is_array ( $line ) && !key_exists( $name , $line ) ) $line[ $name ] = null;

             if( is_string( $line ) ) return str_starts_with( $line , $value );
        else if( is_object( $line ) ) return get_class( $line ) == $this->name || $this->is( $line->$name );
        else if( is_array ( $line ) ) return $this->is( $line[ $name ] );
        else return $this->is( strval( $line ) );
    }

    public function read( $line ){
        $data = [];
        $pos = 0;
        
        foreach( $this->fields as $field ){
            $pos += $field->read( $pos , $line , $data );
        }

        return $data;
    }

    public function write( $data ){
        $line = "";

        if( is_object( $data ) ) $data = (array) $data;

        foreach( $this->fields as $field ){
            $line .= $field->write( $data );
        }

        return $line;
    }

    public function getSize(){
        $size = 0;

        foreach( $this->fields as $field ){
            $size += $field->length;
        }

        return $size;
    }

}