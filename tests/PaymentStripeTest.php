<?php

namespace App\Tests;

use App\Service\StripeService;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaymentStripeTest extends WebTestCase
{
  public function testPaymentSuccess()
  {
    $client = static::createClient();

    $sessionMock = $this->getMockBuilder(Session::class)
      ->disableOriginalConstructor()
      ->onlyMethods(['__get'])
      ->getMock();
    $sessionMock->method('__get')
      ->willReturn('https://checkout.stripe.com/c/pay/cs_test_a14tXOxntHDtyJkrRYdnw3gIBJfpRM3ooR7N3ZDeGnVkH7DnYECBbQumY2');

    $stripeServiceMock = $this->createMock(StripeService::class);
    $stripeServiceMock->method('createCheckoutSession')
      ->willReturn($sessionMock);

    $client->getContainer()->set(StripeService::class, $stripeServiceMock);

    $client->request('GET', '/checkout');

    $this->assertResponseRedirects('https://checkout.stripe.com/c/pay/cs_test_a14tXOxntHDtyJkrRYdnw3gIBJfpRM3ooR7N3ZDeGnVkH7DnYECBbQumY2');
  }
  public function testCheckoutRedirectionToStripe()
  {
    $client = static::createClient();

    $client->request('GET', '/checkout');

    $this->assertTrue(
      $client->getResponse()->isRedirect(),
      'La réponse n\'est pas une redirection.'
    );

    $this->assertStringContainsString('https://checkout.stripe.com/', $client->getResponse()->headers->get('Location'));
  }
}
