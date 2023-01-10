<?php

namespace Dagai\PhpFlatFile;

class Field {
    public const PADDING_ZERO_LEFT  = "ZERO_LEFT";
    public const PADDING_ZERO_RIGHT = "ZERO_RIGHT";
    public const IGNORE     = [ null , "" , "filler" , "empty" ];
    
    public $name;
    public $length;
    public $value;
    public $padding;
    public $type;       // BIGDECIMAL , DATE
    public $format;

    public function __construct( $name = null , $length = 0 , $type = null , $format = null , $padding = null , $value = null ){
        $this->name   = $name;
        $this->length = $length;
        $this->type   = $type;
        $this->format = $format;
        $this->padding = $padding;
        $this->value  = $value;
    }

    // ---------------- //
    // ---------------- // READ
    // ---------------- //
    
    public function read( &$pos , $line , &$data ){
        // finalizar se length não foi definido
        if( $this->length <= 0 ) return 0;

        // ignorar caso seja um campo "ignorável"
        if( in_array( strtolower( $this->name ) , Field::IGNORE ) ) return $this->length;

        // verificar se o tamanho do valor ainda cabe na string
        $valueStr = $pos + $this->length > strlen( $line )
            ? substr( $line , $pos )
            : substr( $line , $pos , $this->length );

        // criar o campo
        $data[ $this->name ] = FormatReader::read( $this , $valueStr );

        // retornar o tamanho lido
        return $this->length;
    }

    // ---------------- //
    // ---------------- // WRITE
    // ---------------- //

    public function write( $data ){
        // finalizar se length não foi definido
        if( $this->length <= 0 ) return "";
        
        return FormatWriter::write( 
            $this , 
            key_exists( $this->name , $data ) ? $data[ $this->name ] : $this->value
        );
    }

}