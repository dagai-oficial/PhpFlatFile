<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FormatReader;

class FormatReaderDecimalTest extends TestCase {

    public function testRead1234(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        
        $this->assertEquals( 1234 , FormatReader::read( $field , "1234" ) );
    }

    public function testRead1ZeroLeft(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->padding = "ZERO_LEFT";
        
        $this->assertEquals( 1 , FormatReader::read( $field , "0001" ) );
    }

    public function testRead1ZeroRight(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->padding = "ZERO_RIGHT";
        
        $this->assertEquals( 1 , FormatReader::read( $field , "1000" ) );
    }

    public function testReturn1010(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";

        $this->assertEquals( 10.10 , FormatReader::read( $field , "1010" ) );
    }

    public function testReturn0999(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DDD";

        $this->assertEquals( 0.999 , FormatReader::read( $field , "0999" ) );
    }

    public function testReturnInvalidEmpty(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";

        $this->assertEquals( 0 , FormatReader::read( $field , "    " ) );
    }

    public function testReturnInvalidString(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";

        $this->assertEquals( 0 , FormatReader::read( $field , "asdasd" ) );
    }

    public function testReturnInvalidNull(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";

        $this->assertEquals( 0 , FormatReader::read( $field , null ) );
    }

}