<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaymentStripeTest extends WebTestCase
{

  public function testCheckoutRedirectionToStripe()
  {
    $client = static::createClient();

    $client->request('GET', '/checkout');

    // Vérifier que la réponse est une redirection vers Stripe
    $this->assertTrue(
      $client->getResponse()->isRedirect(),
      'La réponse n\'est pas une redirection.'
    );

    // Vérifier que l'URL de redirection est bien celle de Stripe
    $this->assertStringContainsString('https://checkout.stripe.com/', $client->getResponse()->headers->get('Location'));
  }
}
