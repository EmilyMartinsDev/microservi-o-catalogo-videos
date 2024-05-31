<?php
namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {   
       try {
        $value = '';
        DomainValidation::notNull($value);
        $this->assertTrue(false);
       } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
       }
    }
    public function testNotNullMessageCustom()
    {   
       try {
        $value = '';
        DomainValidation::notNull($value, "custom message");
        $this->assertTrue(false);
       } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,"custom message");
       }
    }

    
    public function testStrMaxLength()
    {   
       try {
        $value = 'testando';
        DomainValidation::strMaxLength($value, 5);
        $this->assertTrue(false);
       } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,'the value most not be greater than 5 characters');
       }
    }
    public function testStrMinLength()
    {   
       try {
        $value = 'testando';
        DomainValidation::strMinLength($value, 15);
        $this->assertTrue(false);
       } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,'the value most not be less than 15 characters');
       }
    }

    public function testCanNullAndMaxLength()
    {   
       try {
        $value = 'testando pode ser nulo, mas se tiver valor tem um maximo';
        DomainValidation::strCanNullAndMaxLength($value, 10);
        $this->assertTrue(false);
       } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,"The value must not be greater than 10 characters");
       }
    }
}

?>