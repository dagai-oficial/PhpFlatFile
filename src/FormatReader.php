<?php

namespace Dagai\PhpFlatFile;

use \DateTime;

class FormatReader {
    public const INVALID_DATE = "-0001-11-30";
    
    public static function read( $field , $value ){
        switch( $field->type ){
            case "DECIMAL": return FormatReader::read_decimal( $field , $value );
            case "DATE"   : return FormatReader::read_date   ( $field , $value );
            default       : return trim( $value );
        }
    }
    
    public static function read_decimal( $field , $value ){
        if( $field->padding == Field::PADDING_ZERO_RIGHT ){
            $arr = str_split( $value );

            for( $i = strlen( $value ) - 1 ; $i >= 0 ; $i-- ){
                if( $arr[ $i ] == '0' ) $arr[ $i ] = '';
                else break;
            }

            $value = join( $arr );
        }

        if( strlen( $field->format ) > 0 ){
            $pos   = strlen( $value ) - strlen( $field->format );
            $value = substr( $value , 0, $pos) . "." . substr( $value , $pos );
        }

        return floatval( $value );
    }

    public static function read_date( $field , $value ){
        $format = $field->format;

        $format = str_replace( "YYYY" , "Y" , $format );
        $format = str_replace( "YY"   , "y" , $format );
        $format = str_replace( "MM"   , "m" , $format );
        $format = str_replace( "DD"   , "d" , $format );

        $datenew = DateTime::createFromFormat( $format , $value );
        if( $datenew === false ) return null;

        $result = $datenew->format( "Y-m-d" );

        if( $result == FormatReader::INVALID_DATE ) return null;
        else return $result;
    }

}