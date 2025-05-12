<?php
// File: Views/test/subscriptionTest.php
declare(strict_types=1);

// Adjust paths to go UP TWO levels from 'Views/test' then into 'Controllers' or 'Models'
require_once __DIR__ . '/../../Controllers/DBController.php';    // ../../ goes up two levels
require_once __DIR__ . '/../../Controllers/PaymentController.php'; // ../../ goes up two levels
// Models are required within PaymentController and Subscription,
// but if you were to use them directly here first, you'd need:
// require_once DIR . '/../../Models/Plan.php';
// require_once DIR . '/../../Models/Payment.php';
// require_once DIR . '/../../Models/Subscription.php';


// --- Create ONE DBController instance ---
$db = new DBController();

// --- Create PaymentController instance ---
$paymentController = new PaymentController($db);

// --- Example Usage ---
echo "====================================================================\n";
echo "== SCENARIO: Process Payment via Controller (from Views/test folder) ==\n";
echo "====================================================================\n";

// --- Input Data ---
$userId = "1";
$selectedPlanId = '3';
$promoCodeString = 'SAVE10';
$cardHolderName = "Subscription Test User";
$cardNumber = "4111111111111111";
$expDate = "12/29";
$cvv = "789";
$pin = null;
$userProvidedPin = "1234";

// --- Call the Controller Method ---
$subscriptionResult = $paymentController->processSubscriptionPayment(
    $userId,
    $selectedPlanId,
    $promoCodeString,
    $cardHolderName,
    $cardNumber,
    $expDate,
    $cvv,
    $pin,
    $userProvidedPin
);

echo "====================================================================\n";
// --- Check the Result ---
if ($subscriptionResult instanceof Subscription) {
    echo "[Main Script] SUCCESS! Subscription process completed.\n";
    echo "  Subscription DB ID: " . $subscriptionResult->getSubscriptionId() . "\n";
    echo "  Plan: " . $subscriptionResult->getPlanObject()->getPlanName() . "\n";
    echo "  Status: " . $subscriptionResult->getStatus() . "\n";
    echo "  User ID: " . $subscriptionResult->getUserId() . "\n";
    echo "  Payment ID: " . $subscriptionResult->getPaymentId() . "\n";
    echo "  Amount Paid: $" . number_format($subscriptionResult->getPaymentAmount() ?? 0, 2) . "\n";
    echo "  Start Date: " . ($subscriptionResult->getStartDate() ? $subscriptionResult->getStartDate()->format('Y-m-d H:i:s') : 'N/A') . "\n";
    echo "  End Date: " . ($subscriptionResult->getEndDate() ? $subscriptionResult->getEndDate()->format('Y-m-d H:i:s') : 'N/A') . "\n";

    $paymentObject = $subscriptionResult->getPaymentObject();
    if ($paymentObject && $paymentObject->getAppliedPromoName()) {
         echo "  Promo Applied: " . $paymentObject->getAppliedPromoName() . " (Value: $" . number_format($paymentObject->getAppliedPromoValue() ?? 0, 2) . ")\n";
    }

} else {
    echo "[Main Script] FAILURE: Subscription process failed.\n";
}
echo "====================================================================\n";

?>