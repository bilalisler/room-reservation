<?php
namespace App\Tests\Form;

use App\Entity\Payment;
use App\Form\PaymentType;
use Symfony\Component\Form\Test\TypeTestCase;

class PaymentTypeTest extends TypeTestCase
{
    public function testValidCondition(): void
    {
        $data = json_decode('{"cardNumber":"4716841611983226","cardOwner":"test test","cardCvc":621,"cardExpiry":"07/28"}',true);

        $model = new Payment();
        $form = $this->factory->create(PaymentType::class, $model);
        $form->submit($data);

        $this->assertTrue($form->isValid());
        $this->assertTrue($form->isSynchronized());

        $expected = new Payment();
        $expected->setCardOwner('test test');
        $expected->setCardNumber('4716841611983226');
        $expected->setCardExpiry('07/28');
        $expected->setCardCvc(621);

        $this->assertEquals($model,$expected);
    }
}
