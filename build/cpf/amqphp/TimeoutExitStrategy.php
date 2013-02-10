<?php
 namespace amqphp; use amqphp\protocol; use amqphp\wire; class TimeoutExitStrategy implements ExitStrategy { private $toStyle; private $secs; private $usecs; private $epoch; function configure ($sMode, $secs=null, $usecs=null) { $this->toStyle = $sMode; $this->secs = (string) $secs; $this->usecs = (string) $usecs; return true; } function init (Connection $conn) { if ($this->toStyle == Connection::STRAT_TIMEOUT_REL) { list($uSecs, $epoch) = explode(' ', microtime()); $uSecs = bcmul($uSecs, '1000000'); $this->usecs = bcadd($this->usecs, $uSecs); $this->epoch = bcadd($this->secs, $epoch); if (! (bccomp($this->usecs, '1000000') < 0)) { $this->epoch = bcadd('1', $this->epoch); $this->usecs = bcsub($this->usecs, '1000000'); } } else { $this->epoch = $this->secs; } } function preSelect ($prev=null) { if ($prev === false) { return false; } list($uSecs, $epoch) = explode(' ', microtime()); $epDiff = bccomp($epoch, $this->epoch); if ($epDiff == 1) { return false; } $uSecs = bcmul($uSecs, '1000000'); if ($epDiff == 0 && bccomp($uSecs, $this->usecs) >= 0) { return false; } $udiff = bcsub($this->usecs, $uSecs); if (substr($udiff, 0, 1) == '-') { $blockTmSecs = (int) bcsub($this->epoch, $epoch) - 1; $udiff = bcadd($udiff, '1000000'); } else { $blockTmSecs = (int) bcsub($this->epoch, $epoch); } if (is_array($prev) && ($prev[0] < $blockTmSecs || ($prev[0] == $blockTmSecs && $prev[1] < $udiff))) { return $prev; } else { return array($blockTmSecs, $udiff); } } function complete () {} } 