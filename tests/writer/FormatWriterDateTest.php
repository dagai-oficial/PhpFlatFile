<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FormatWriter;

class FormatWriterDateTest extends TestCase {

    public function testReturnDate00000000(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 8;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "01012020" , FormatWriter::write( $field , "2020-01-01" ) );
    }

    public function testReturnDate0000(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "0101" , FormatWriter::write( $field , "2020-01-01" ) );
    }

    public function testReturnDate000000(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 6;
        $field->type   = "DATE";
        $field->format = "DDMMYY";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "010120" , FormatWriter::write( $field , "2020-01-01" ) );
    }

    public function testReturnInvalidDate000000(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "0000" , FormatWriter::write( $field , null ) );
    }

    public function testReturnInvalidDateEmpty(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";
        
        $this->assertEquals( "    " , FormatWriter::write( $field , "" ) );
    }

    public function testReturnInvalidDateLessLetters(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";
        
        $this->assertEquals( "    " , FormatWriter::write( $field , "0011" ) );
    }

}