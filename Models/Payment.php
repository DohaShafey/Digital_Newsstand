<?php
// File: Models/Payment.php
declare(strict_types=1);

class Payment
{
    // Payment Attributes
    private string $paymentId;
    private string $paymentMethod;
    private ?DateTime $paymentDate = null;

    // Card Details
    private string $cardHolderName;
    private string $cardNumber;
    private string $expDate;
    private string $cvv;
    private ?string $pin;

    // Amount Details
    private float $originalAmount;
    private float $finalAmountCharged;

    // Applied Promo Code Details
    private ?string $appliedPromoId = null;
    private ?string $appliedPromoName = null;
    private ?float $appliedPromoValue = null;

    // Status & Internal Flags
    private string $status;
    private bool $cardValidationAttempted = false;
    private bool $cardValidationPassed = false;

    public const STATUS_AWAITING_PROMO_CONFIRMATION = 'AwaitingPromoConfirmation';
    public const STATUS_PROMO_APPLIED = 'PromoApplied';
    public const STATUS_PROMO_REJECTED = 'PromoRejected';
    public const STATUS_AWAITING_CARD_DETAILS = 'AwaitingCardDetails';
    public const STATUS_PROCESSING_CARD = 'ProcessingCard';
    public const STATUS_REQUIRES_PIN = 'RequiresPIN';
    public const STATUS_PROCESSING_PIN = 'ProcessingPIN';
    public const STATUS_CHARGING = 'Charging';
    public const STATUS_SUCCESS = 'Success';
    public const STATUS_FAILED = 'Failed';

    public function __construct(
        string $paymentId,
        string $paymentMethod,
        string $cardHolderName,
        string $cardNumber,
        string $expDate,
        string $cvv,
        float $originalAmount,
        ?string $pin = null
    ) {
        $this->paymentId = $paymentId;
        $this->paymentMethod = $paymentMethod;
        $this->cardHolderName = $cardHolderName;
        $this->cardNumber = $cardNumber;
        $this->expDate = $expDate;
        $this->cvv = $cvv;
        $this->pin = $pin;
        $this->originalAmount = $originalAmount;
        $this->finalAmountCharged = $originalAmount; // Initially same as original
        $this->appliedPromoId = null;
        $this->appliedPromoName = null;
        $this->appliedPromoValue = null;
        $this->status = self::STATUS_AWAITING_CARD_DETAILS;
    }

    // --- Getters ---
    public function getPaymentId(): string { return $this->paymentId; }
    public function getPaymentMethod(): string { return $this->paymentMethod; }
    public function getPaymentDate(): ?DateTime { return $this->paymentDate; }
    public function getMaskedCardNumber(): string { return "************" . substr($this->cardNumber, -4); }
    public function getOriginalAmount(): float { return $this->originalAmount; }
    public function getFinalAmountCharged(): float { return $this->finalAmountCharged; }
    public function getAppliedPromoId(): ?string { return $this->appliedPromoId; }
    public function getAppliedPromoName(): ?string { return $this->appliedPromoName; }
    public function getAppliedPromoValue(): ?float { return $this->appliedPromoValue; }
    public function getStatus(): string { return $this->status; }

    // --- Validation (Basic stubs, implement real logic if needed) ---
    private function isCardInfoValidBasic(): bool
    {
        // Add actual basic validation (Luhn, date format, CVV length) here
        return true;
    }
    private function luhnCheck(string $number): bool
    {
        // Add Luhn algorithm implementation here
        return true;
    }

    /**
     * Finds and applies promo code using DBController. Queries the 'promo' table.
     */
    public function applyPromoCode(string $promoCodeString, DBController $db): bool
    {
        echo "\n[:Payment] User attempts to apply promo code: '{$promoCodeString}'\n";
        if (!in_array($this->status, [self::STATUS_AWAITING_CARD_DETAILS, self::STATUS_AWAITING_PROMO_CONFIRMATION, self::STATUS_PROMO_REJECTED, self::STATUS_PROMO_APPLIED])) {
            return false;
        }

        $this->status = self::STATUS_AWAITING_PROMO_CONFIRMATION;
        // Reset any previously applied promo
        $this->appliedPromoId = null;
        $this->appliedPromoName = null;
        $this->appliedPromoValue = null;
        $this->finalAmountCharged = $this->originalAmount;

        $escapedPromoName = $db->escape(strtoupper($promoCodeString));
        $query = "SELECT promoId, promoName, promoValue
                  FROM promo
                  WHERE UPPER(promoName) = '$escapedPromoName'";

        echo "[Payment] Executing DB Query: " . $query . "\n";
        $promoData = $db->selectSingle($query);

        if ($promoData) {
            echo "[Payment] Promo data found for: $escapedPromoName in 'promo' table.\n";
            if (isset($promoData['promoValue']) && $promoData['promoValue'] > 0) {
                $this->appliedPromoId = (string)$promoData['promoId'];
                $this->appliedPromoName = (string)$promoData['promoName'];
                $this->appliedPromoValue = (float)$promoData['promoValue'];
                $discountedPrice = $this->originalAmount - $this->appliedPromoValue;
                $this->finalAmountCharged = max(0, $discountedPrice);
                $this->status = self::STATUS_PROMO_APPLIED;
                echo "[:Payment] Promo '{$this->appliedPromoName}' applied. Discount: \${$this->appliedPromoValue}. New total: \${$this->finalAmountCharged}\n";
                return true;
            } else {
                $this->status = self::STATUS_PROMO_REJECTED;
                echo "[:Payment] Promo '{$escapedPromoName}' found but has no discount value.\n";
                return false;
            }
        } else {
            $this->status = self::STATUS_PROMO_REJECTED;
            echo "[:Payment] Promo '{$escapedPromoName}' not found in 'promo' table.\n";
            return false;
        }
    }

    /** Process card details, passing DBController down */
    public function processCardDetails(DBController $db): string
    {
        echo "\n[:Payment] Processing card details\n";
        $this->status = self::STATUS_PROCESSING_CARD;
        $this->cardValidationAttempted = true;
        if (!$this->isCardInfoValidBasic()) {
            $this->status = self::STATUS_FAILED;
            return $this->status;
        }

        $bankCardValidationSuccess = $this->simulateBankCardValidation();
        if (!$bankCardValidationSuccess) {
            $this->status = self::STATUS_FAILED;
            return $this->status;
        }

        $this->cardValidationPassed = true;
        $pinRequiredByFlow = true; // Simulate PIN requirement

        if ($pinRequiredByFlow) {
            $this->status = self::STATUS_REQUIRES_PIN;
            return $this->status;
        } else {
            return $this->chargePayment($db); // Pass DBController
        }
    }

    /** Submit PIN, passing DBController down */
    public function submitPinAndCharge(string $userProvidedPin, DBController $db): string
    {
        echo "\n[:Payment] Submitting PIN '{$userProvidedPin}'\n";
        if ($this->status !== self::STATUS_REQUIRES_PIN || !$this->cardValidationPassed) {
            $this->status = self::STATUS_FAILED;
            return $this->status;
        }

        $this->status = self::STATUS_PROCESSING_PIN;
        $bankPinValidationSuccess = $this->simulateBankPinValidation($userProvidedPin);
        if (!$bankPinValidationSuccess) {
            $this->status = self::STATUS_FAILED;
            return $this->status;
        }
        return $this->chargePayment($db); // Pass DBController
    }

    /** Charge payment and INSERT using DBController */
    private function chargePayment(DBController $db): string
    {
        echo "[:Payment -> :Bank] Charging \${$this->finalAmountCharged}\n";
        $bankChargeSuccess = $this->simulateBankCharge($this->finalAmountCharged);

        if (!$bankChargeSuccess) {
            $this->status = self::STATUS_FAILED;
        } else {
            $methodId = ($this->paymentMethod === 'CreditCard' ? 1 : 0); // Example mapping
            $query = "INSERT INTO payment (paymentMethodId, paymentDate) VALUES ($methodId, NOW())";

            echo "[Payment] Executing DB Query: " . $query . "\n";
            if ($db->execute($query)) {
                $generatedPaymentId = $db->getLastInsertId();
                if ($generatedPaymentId) {
                    $this->paymentId = (string)$generatedPaymentId;
                    echo "[:Payment] Payment record inserted. DB Payment ID: {$this->paymentId}\n";
                } else {
                    error_log("Failed to get last insert ID after payment insert.");
                }
                $this->paymentDate = new DateTime();
                $this->status = self::STATUS_SUCCESS;
            } else {
                error_log("Failed to insert payment record. Query: " . $query);
                $this->status = self::STATUS_FAILED;
            }
        }
        return $this->status;
    }

    // --- Bank Simulators ---
    private function simulateBankCardValidation(): bool { echo "  (Sim Bank validation: {$this->getMaskedCardNumber()})\n"; return rand(0, 10) > 1; }
    private function simulateBankPinValidation(string $pin): bool { echo "  (Sim Bank PIN validation: '{$pin}')\n"; return $pin === "1234"; }
    private function simulateBankCharge(float $amount): bool { return rand(0, 10) > 0; }
}
     echo 'hello';
?>