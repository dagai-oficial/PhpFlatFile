<?php

namespace Dagai\PhpFlatFile;

use \DateTime;

class FormatWriter {

    public static function write( $field , $value ){
        switch( $field->type ){
            case "DECIMAL": return FormatWriter::write_decimal( $field , $value );
            case "DATE"   : return FormatWriter::write_date   ( $field , $value );
            default       : return FormatWriter::write_string ( $field , $value );
        }
    }

    public static function write_decimal( $field , $value ){
        if( !isset( $value ) || $value == null || $value == "" ) 
            return FormatWriter::size( $field , $field->value );
        
        return FormatWriter::size(
            $field,
            is_numeric( $value ) 
                ? number_format( $value , strlen( $field->format ) , "" , "" )
                : "",
            true
        );
    }

    public static function write_date( $field , $value ){
        if( !$value ) return FormatWriter::size( $field , $field->value );

        $format = $field->format;

        $format = str_replace( "YYYY" , "Y" , $format );
        $format = str_replace( "YY"   , "y" , $format );
        $format = str_replace( "MM"   , "m" , $format );
        $format = str_replace( "DD"   , "d" , $format );

        $datenew = DateTime::createFromFormat( "Y-m-d" , $value );
        if( $datenew === false ) return FormatWriter::size( $field , "" );

        return FormatWriter::size( $field , $datenew->format( $format ) );
    }

    public static function write_string( $field , $value ){
        if( $value ) return FormatWriter::size( $field , $value );
        else         return FormatWriter::size( $field , $field->value );
    }

    public static function size( $field , $value , $right = true ){
        if( $field->length <= 0 ){
            return $value = "";
        }

        $size = strlen( $value );

        if( $size == $field->length ){
            return $value;
        }
        else if( $size < $field->length ){
            return FormatWriter::padding( $field , $value );
        }

        return $right 
            ? substr( $value , 0 , $field->length )
            : substr( $value , $size - $field->length );
    }

    public static function padding( $field , &$value ){
        $left = str_contains( $field->padding , "LEFT" );
        $char = str_contains( $field->padding , "ZERO" ) ? "0" : " ";

        $padding = "";
        $total   = $field->length - strlen( $value );

        for( $i = 0 ; $i < $total ; $i++ ) $padding .= $char;

        return $value = $left 
            ? ($padding . $value)
            : ($value . $padding);
    }

}