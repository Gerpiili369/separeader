<?php
/**
 * SEPA XML Parser for bank transfers (palkka.fi) pain.001.001.02 material
 * Usage: Run from command line
 * php index.php 3_28052016.xml
 *
 * Licence MIT
 * @author Antti Hätinen <pharazon@phz.fi>
 */

$xml = file_get_contents($argv[1]);
$data = new SimpleXMLElement($xml);
$payments = $data->{'pain.001.001.02'}->PmtInf->CdtTrfTxInf;

$totalSum = 0.0;
$count = 0;
foreach ($payments as $payment) {
    $sum = ((string) $payment->Amt->InstdAmt);
    echo $sum . "\t" . $payment->Cdtr->Nm . PHP_EOL;
    $totalSum += $sum;
    $count++;
}

echo "Number of payments: " . $count . PHP_EOL;
echo "Total sum: " . $totalSum . PHP_EOL;
