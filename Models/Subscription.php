<?php
// File: Models/Subscription.php
declare(strict_types=1);

require_once __DIR__ . '/Plan.php';
require_once __DIR__ . '/Payment.php';

class Subscription
{
    // Attributes
    private string $subscriptionId;
    private string $PlanId; // Stores the ID of the Plan object
    private ?string $paymentId = null; // Stores the ID of the Payment object, nullable
    private string $UserId;
    private ?DateTime $startDate = null;
    private ?DateTime $endDate = null;
    private ?float $paymentAmount = null;

    // Supporting object properties
    private Plan $planObject;
    private ?Payment $paymentObject = null;
    private bool $isActive = false;

    public function __construct(string $subscriptionId, string $UserId, Plan $planObject)
    {
        $this->subscriptionId = $subscriptionId;
        $this->UserId = $UserId;
        $this->planObject = $planObject;
        $this->PlanId = $planObject->getPlanId();
        $this->isActive = false;
        $this->paymentAmount = null;
    }

    // --- Getters ---
    public function getSubscriptionId(): string { return $this->subscriptionId; }
    public function getPlanId(): string { return $this->PlanId; }
    public function getPaymentId(): ?string { return $this->paymentId; }
    public function getUserId(): string { return $this->UserId; }
    public function getStartDate(): ?DateTime { return $this->startDate; }
    public function getEndDate(): ?DateTime { return $this->endDate; }
    public function getPaymentAmount(): ?float { return $this->paymentAmount; }
    public function getPlanObject(): Plan { return $this->planObject; }
    public function getPaymentObject(): ?Payment { return $this->paymentObject; }
    public function getStatus(): string { return $this->isActive ? "Active" : "Inactive"; }

    /**
     * Activates the subscription and saves using DBController and stored procedure.
     */
    public function activate(Payment $payment, DBController $db): bool
    {
        if ($payment->getStatus() !== Payment::STATUS_SUCCESS) {
            echo "[Subscription] Error: Cannot activate. Payment not successful.\n";
            return false;
        }

        $expectedFinalAmount = $this->planObject->getPlanPrice();
        $appliedPromoValue = $payment->getAppliedPromoValue();
        if ($appliedPromoValue !== null && $appliedPromoValue > 0) {
            $expectedFinalAmount = max(0, $expectedFinalAmount - $appliedPromoValue);
        }

        if (abs($payment->getFinalAmountCharged() - $expectedFinalAmount) > 0.01) {
            echo "[Subscription] Error: Payment amount (\${$payment->getFinalAmountCharged()}) mismatch. Expected \${$expectedFinalAmount}.\n";
            return false;
        }

        $this->paymentObject = $payment;
        $dbPaymentId = $payment->getPaymentId();
        if ($dbPaymentId === null || !ctype_digit($dbPaymentId)) {
            error_log("Cannot activate subscription: Invalid Payment ID '{$dbPaymentId}'.");
            return false;
        }
        $this->paymentId = $dbPaymentId;
        $this->paymentAmount = $payment->getFinalAmountCharged();
        $this->startDate = $payment->getPaymentDate() ?? new DateTime();

        $safePlanId = (int)$this->PlanId;
        $safePaymentId = (int)$this->paymentId;
        $safeUserId = (int)$this->UserId;
        $query = "CALL insert_subscription($safePlanId, $safePaymentId, $safeUserId)";

        echo "[Subscription] Executing DB Query: " . $query . "\n";
        if ($db->execute($query)) {
            $newSubId = $db->getLastInsertId(); // Try this first
            if (!$newSubId) {
                $fetchIdQuery = "SELECT subscriptionId FROM subscriptions WHERE paymentId = $safePaymentId AND userId = $safeUserId ORDER BY subscriptionId DESC LIMIT 1";
                echo "[Subscription] Executing DB Query: " . $fetchIdQuery . "\n";
                $result = $db->selectSingle($fetchIdQuery);
                if ($result && isset($result['subscriptionId'])) {
                    $newSubId = $result['subscriptionId'];
                }
            }

            if ($newSubId) {
                $this->subscriptionId = (string)$newSubId;
                echo "[Subscription] Procedure executed. Got Subscription ID: {$this->subscriptionId}\n";
            } else {
                error_log("Subscription procedure CALL succeeded, but failed to get new subscriptionId.");
            }

            $this->endDate = (clone $this->startDate)->modify('+' . $this->planObject->getPlanDuration() . ' days');
            $this->isActive = true;
            echo "[Subscription] {$this->subscriptionId} activated state set for User {$this->UserId}.\n";
            return true;
        } else {
            error_log("Failed to execute insert_subscription procedure. Query: " . $query);
            return false;
        }
    }

    /** Cancel subscription, passing DBController */
    public function cancelSubscription(DBController $db): void
    {
        $this->isActive = false;
        // --- Database UPDATE ---
        // $safeSubscriptionId = (int)$this->subscriptionId;
        // $query = "UPDATE subscriptions SET ... WHERE subscriptionId = $safeSubscriptionId";
        // $db->execute($query);
        echo "[Subscription] {$this->subscriptionId} cancelled (state set).\n";
        echo "[Subscription] DB UPDATE for cancellation would happen here.\n";
    }
}
     echo 'hello';

?>