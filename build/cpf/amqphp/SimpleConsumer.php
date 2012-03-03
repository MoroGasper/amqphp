<?php
 namespace amqphp; use amqphp\protocol; use amqphp\wire; class SimpleConsumer implements Consumer { protected $consumeParams; protected $consuming = false; function __construct (array $consumeParams) { $this->consumeParams = $consumeParams; } function handleCancelOk (wire\Method $meth, Channel $chan) { $this->consuming = false; } function handleCancel (wire\Method $meth, Channel $chan) { $this->consuming = false; } function handleConsumeOk (wire\Method $meth, Channel $chan) { $this->consuming = true; } function handleDelivery (wire\Method $meth, Channel $chan) {} function handleRecoveryOk (wire\Method $meth, Channel $chan) {} function getConsumeMethod (Channel $chan) { return $chan->basic('consume', $this->consumeParams); } }