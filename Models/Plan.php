<?php

declare(strict_types=1);

class Plan
{
    private string $planId;
    private string $planName;
    private float $planPrice;
    private int $planDuration; // Duration in days
    private array $planFeatures;

    /**
     * Finds a Plan by its ID using the provided DBController.
     * @param string $planId
     * @param DBController $db
     * @return Plan|null
     */
    public static function findById(string $planId, DBController $db): ?Plan
    {
        $safePlanId = (int)$planId;
        $query = "SELECT planId, planName, planPrice, planDuration, planFeatures
                  FROM plan
                  WHERE planId = $safePlanId";

        echo "[Plan] Executing DB Query: " . $query . "\n";
        $result = $db->selectSingle($query);

        if ($result) {
            $data = $result;
            $featuresArray = array_map('trim', array_filter(preg_split('/\r\n|\r|\n/', $data['planFeatures'])));

            echo "[Plan] Plan data found for ID: $safePlanId\n";
            return new Plan(
                (string)$data['planId'],
                (string)$data['planName'],
                (float)$data['planPrice'],
                (int)$data['planDuration'],
                $featuresArray
            );
        } else {
            echo "[Plan] Plan data NOT found for ID: $safePlanId\n";
            return null;
        }
    }

    public function __construct(
        string $planId,
        string $planName,
        float $planPrice,
        int $planDuration,
        array $planFeatures
    ) {
        $this->planId = $planId;
        $this->planName = $planName;
        $this->planPrice = $planPrice;
        $this->planDuration = $planDuration;
        $this->planFeatures = $planFeatures;
    }

    public function getPlanId(): string
    {
        return $this->planId;
    }

    public function getPlanName(): string
    {
        return $this->planName;
    }

    public function getPlanPrice(): float
    {
        return $this->planPrice;
    }

    public function getPlanDuration(): int
    {
        return $this->planDuration;
    }

    public function getPlanFeatures(): array
    {
        return $this->planFeatures;
    }
}
     echo 'hello';
?>