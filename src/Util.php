<?php

namespace Dagai\PhpFlatFile;

class Util {

    public static function toArray( $obj ){
        $obj = (array) $obj;

        foreach( $obj as $key => $value ){
            $obj[ $key ] = is_object( $value )
                ? Util::toArray( $value )
                : $value;
        }

        return $obj;
    }

    public static function set( $key , $obj , &$field ){
        if( array_key_exists( $key , $field ) ){
            $obj->$key = is_string( $field[ $key ] ) 
                ? trim( $field[ $key ] ) 
                : $field[ $key ];
        }
    }

    //from: https://stackoverflow.com/questions/1483497/split-string-by-new-line-characters
    public static function splitByNewLine( $string ){
        return preg_split("/\r\n|\n|\r/", $string);
    }

}