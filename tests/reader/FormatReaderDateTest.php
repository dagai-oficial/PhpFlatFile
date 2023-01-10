<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FormatReader;

class FormatReaderDateTest extends TestCase {

    public function testReturnDate00000000(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";

        $this->assertEquals( "2020-01-01" , FormatReader::read( $field , "01012020" ) );
    }

    public function testReturnDate000000(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYY";

        $this->assertEquals( "2020-01-01" , FormatReader::read( $field , "010120" ) );
    }

    public function testReturnInvalidDate000000(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";

        $this->assertEquals( null , FormatReader::read( $field , "00000000" ) );
    }

    public function testReturnInvalidDateEmpty(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";

        $this->assertEquals( null , FormatReader::read( $field , "" ) );
    }

    public function testReturnInvalidDateLessLetters(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";

        $this->assertEquals( null , FormatReader::read( $field , "0011" ) );
    }

}