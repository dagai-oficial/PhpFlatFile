<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FieldFormat;

class FileReaderTest extends TestCase {
    public const LINE = "02012020OK  0102";

    public function testReturnDataPosition0(){
        $field = new Field();
        $field->name   = "data";
        $field->length = 8;
        $field->type   = "DATE";
        $field->format = "DDMMYYYY";

        $data = [];
        $pos  = 0;

        $pos += $field->read( $pos , FileReaderTest::LINE , $data );

        $this->assertEquals( "2020-01-02" , $data["data"] );
        $this->assertEquals( 8            , $pos          );
    }

    public function testReturnTextPosition8(){
        $field = new Field();
        $field->name   = "texto";
        $field->length = 4;
        
        $data = [];
        $pos  = 8;

        $pos += $field->read( $pos , FileReaderTest::LINE , $data );

        $this->assertEquals( "OK" , $data["texto"] );
        $this->assertEquals( 12   , $pos           );
    }

    public function testReturnDecimalPosition10(){
        $field = new Field();
        $field->name   = "decimal";
        $field->length = 4;
        $field->type   = "DECIMAL";
        $field->format = "DD";
        
        $data = [];
        $pos  = 12;

        $pos += $field->read( $pos , FileReaderTest::LINE , $data );

        $this->assertEquals( 1.02 , $data["decimal"] );
        $this->assertEquals( 16   , $pos             );
    }
    
}