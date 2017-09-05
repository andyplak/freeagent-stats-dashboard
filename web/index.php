<?php 

require __DIR__ . '/../config/parameters.php';
require __DIR__ . '/../vendor/autoload.php';

use SixBySix\Freeagent\OAuth2\Api;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Entity\Invoice;
use Doctrine\Common\Annotations\AnnotationRegistry;


AnnotationRegistry::registerLoader('class_exists');

$api = new Api(
  $clientId = API_CLIENT_ID,
  $clientSecret = API_CLIENT_SECRET,
  $refreshToken = API_REFRESH_TOKEN,
  $sandbox = API_SANDBOX
);

/** @var EntityCollection $invoiceCollection */
$invoiceCollection = $api->invoice()->query([
  'view' => 'last_3_months',
]);

/** @var Invoice $invoice */
foreach ($invoiceCollection as $invoice) {
  echo "{$invoice->getReference()} - ";
  echo "{$invoice->getContact()->getOrganisationName()} - ";
  echo "{$invoice->getStatus()} - ";
  echo "&pound;{$invoice->getTotalValue()}<br />";
}