<?php
 namespace amqphp\protocol\v0_9_1\queue; class BindExchangeField extends \amqphp\protocol\v0_9_1\ExchangeNameDomain implements \amqphp\protocol\abstrakt\XmlSpecField { function getSpecFieldName() { return 'exchange'; } function getSpecFieldDomain() { return 'exchange-name'; } }