<?php
 namespace amqphp\protocol\abstrakt; abstract class XmlSpecMethod { protected $class; protected $name; protected $index; protected $synchronous; protected $responseMethods; protected $fields; protected $methFact; protected $fieldFact; protected $classFact; protected $content; final function getSpecClass () { return $this->class; } final function getSpecName () { return $this->name; } final function getSpecIndex () { return $this->index; } final function getSpecIsSynchronous () { return $this->synchronous; } final function getSpecResponseMethods () { return $this->responseMethods; } final function getSpecFields () { return $this->fields; } final function getSpecHasContent () { return $this->content; } final function getFields () { return call_user_func(array($this->fieldFact, 'GetFieldsForMethod'), $this->name); } final function getField ($fName) { if (in_array($fName, $this->fields)) { return call_user_func(array($this->fieldFact, 'GetField'), $fName, $this->name); } } final function getResponses () { return call_user_func(array($this->methFact, 'GetMethodsByName'), $this->responseMethods); } final function getClass () { return call_user_func(array($this->classFact, 'GetClassByName'), $this->class); } final function hasNoWaitField () { return $this->hasNoWait; } } 