<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FormatWriter;

class FormatWriterStringTest extends TestCase {

    public function testReturnValue(){
        $field = new Field();
        $field->name = "teste";
        $field->length = 2;

        $this->assertEquals( "OK" , FormatWriter::write( $field , "OK" ) );
    }

    public function testReturnValueTrim(){
        $field = new Field();
        $field->name = "teste";
        $field->length = 5;

        $this->assertEquals( "OK   " , FormatWriter::write( $field , "OK" ) );
    }
    
}