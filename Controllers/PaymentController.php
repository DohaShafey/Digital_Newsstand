<?php
// File: Controllers/PaymentController.php
declare(strict_types=1);

// Require necessary classes
require_once __DIR__ . '/DBController.php';
require_once __DIR__ . '/../Models/Plan.php';
require_once __DIR__ . '/../Models/Payment.php';
require_once __DIR__ . '/../Models/Subscription.php';

class PaymentController
{
    private DBController $db;

    public function __construct(DBController $dbController)
    {
        $this->db = $dbController;
    }

    /**
     * Orchestrates the entire payment and subscription process.
     * @return Subscription|false
     */
    public function processSubscriptionPayment(
        string $userId,
        string $selectedPlanId,
        ?string $promoCodeString,
        string $cardHolderName,
        string $cardNumber,
        string $expDate, // MM/YY
        string $cvv,
        ?string $pin = null,
        ?string $userProvidedPin = null
    ): Subscription | false {

        echo "[PaymentController] Starting payment process for User: $userId, Plan: $selectedPlanId\n";

        // 1. Get Plan Details
        $plan = Plan::findById($selectedPlanId, $this->db);
        if (!$plan) {
            echo "[PaymentController] Error: Plan with ID {$selectedPlanId} not found.\n";
            return false;
        }
        echo "[PaymentController] Found Plan: {$plan->getPlanName()} (\${$plan->getPlanPrice()})\n";

        // 2. Create Payment Object
        $payment = new Payment(
            uniqid("pay_tmp_"),
            "CreditCard",
            $cardHolderName, $cardNumber, $expDate, $cvv,
            $plan->getPlanPrice(),
            $pin
        );
        echo "[PaymentController] Payment object created. Initial Amount: \${$payment->getOriginalAmount()}\n";

        // 3. Apply Promo Code
        if ($promoCodeString !== null && trim($promoCodeString) !== '' && strtoupper(trim($promoCodeString)) !== 'NOPROMO0') {
            if ($payment->applyPromoCode($promoCodeString, $this->db)) {
                echo "[PaymentController] Promo '{$payment->getAppliedPromoName()}' applied. New amount: \${$payment->getFinalAmountCharged()}\n";
            } else {
                echo "[PaymentController] Promo '{$promoCodeString}' rejected or not found.\n";
            }
        }

        // 4. Process Card Details
        $currentStatus = $payment->processCardDetails($this->db);
        echo "[PaymentController] Card processing status: {$currentStatus}\n";

        // 5. Handle PIN if Required
        if ($currentStatus === Payment::STATUS_REQUIRES_PIN) {
            if ($userProvidedPin !== null) {
                echo "[PaymentController] Submitting user provided PIN.\n";
                $currentStatus = $payment->submitPinAndCharge($userProvidedPin, $this->db);
                echo "[PaymentController] PIN submission status: {$currentStatus}\n";
            } else {
                echo "[PaymentController] Error: Payment requires PIN, but none provided.\n";
                return false;
            }
        }

        // 6. Check Final Payment Status & Activate Subscription
        if ($currentStatus === Payment::STATUS_SUCCESS) {
            echo "[PaymentController] Payment successful (DB Payment ID: {$payment->getPaymentId()}). Activating subscription...\n";
            $subscription = new Subscription(uniqid("sub_tmp_"), $userId, $plan);
            if ($subscription->activate($payment, $this->db)) {
                echo "[PaymentController] Subscription activated successfully (DB Subscription ID: {$subscription->getSubscriptionId()}).\n";
                return $subscription;
            } else {
                echo "[PaymentController] Error: Subscription activation/save failed AFTER successful payment.\n";
                return false;
            }
        } else {
            echo "[PaymentController] Payment failed. Final Status: {$payment->getStatus()}.\n";
            return false;
        }
    }
}

?>