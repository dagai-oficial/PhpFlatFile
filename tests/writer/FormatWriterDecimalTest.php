<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FormatWriter;

class FormatWriterDecimalTest extends TestCase {

    public function testRead1234(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        
        $this->assertEquals( 1234 , FormatWriter::write( $field , "1234" ) );
    }

    public function testRead1ZeroLeft(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->padding = "ZERO_LEFT";
        
        $this->assertEquals( "0001" , FormatWriter::write( $field , 1 ) );
    }

    public function testRead1ZeroRight(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->padding = "ZERO_RIGHT";
        
        $this->assertEquals( "1000" , FormatWriter::write( $field , 1 ) );
    }

    public function testReturn1010(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "1010" , FormatWriter::write( $field , 10.10 ) );
    }

    public function testReturn0999(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DDD";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "0999" , FormatWriter::write( $field , 0.999 ) );
    }

    public function testReturnInvalidEmpty(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "0000" , FormatWriter::write( $field , "    " ) );
    }

    public function testReturnInvalidString(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "0000" , FormatWriter::write( $field , "asdasd" ) );
    }

    public function testReturnInvalidNull(){
        $field = new Field();
        $field->name   = "teste";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";
        $field->padding = "ZERO_RIGHT";

        $this->assertEquals( "0000" , FormatWriter::write( $field , null ) );
    }

}