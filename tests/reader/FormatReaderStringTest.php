<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FormatReader;

class FormatReaderStringTest extends TestCase {

    public function testReturnValue(){
        $field = new Field();
        $field->name = "teste";
        $field->length = 2;

        $this->assertEquals( "OK" , FormatReader::read( $field , "OK" ) );
    }

    public function testReturnValueTrim(){
        $field = new Field();
        $field->name = "teste";
        $field->length = 2;

        $this->assertEquals( "OK" , FormatReader::read( $field , "    OK   " ) );
    }
    
}