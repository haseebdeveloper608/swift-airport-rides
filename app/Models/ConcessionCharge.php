<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcessionCharge extends Model
{
    use HasFactory;

    protected $table = 'concession_charges';

    protected $fillable = [
        'car_id',
        'place',
        'post_code',
        'radius',
        'fare_type',
        'amount',
        'applies',
        'lat',
        'lng',
    ];

    protected $casts = [
        'car_id' => 'integer',
        'radius' => 'float',
        'amount' => 'float',
        'lat' => 'float',
        'lng' => 'float',
    ];

    public function appliesToType(string $type): bool
    {
        $applies = strtolower($this->applies ?? 'pickup');
        $type = strtolower($type);
        return $applies === $type || $applies === 'both';
    }

    public function matchesLocation(?float $lat, ?float $lng, string $locationName): bool
    {
        $locationName = trim($locationName);
        $isMatch = false;

        if (is_numeric($lat) && is_numeric($lng) && is_numeric($this->lat) && is_numeric($this->lng)) {
            $radius = $this->radius;
            if ($radius <= 0) {
                $radius = 0.5;
            }

            $distance = $this->calculateDistanceKm($lat, $lng, $this->lat, $this->lng);
            if ($distance <= $radius) {
                $isMatch = true;
            }
        }

        if (!$isMatch && !empty($locationName)) {
            if (!empty($this->post_code) && stripos($locationName, $this->post_code) !== false) {
                $isMatch = true;
            } else {
                $placeText = $this->normalizeLocationText($this->place);
                $searchText = $this->normalizeLocationText($locationName);

                if (!empty($placeText) && (str_contains($searchText, $placeText) || str_contains($placeText, $searchText))) {
                    $isMatch = true;
                } elseif ($this->hasCommonLocationTokens($placeText, $searchText)) {
                    $isMatch = true;
                }
            }
        }

        return $isMatch;
    }

    private function normalizeLocationText(string $text): string
    {
        return trim(preg_replace('/[^a-z0-9]+/', ' ', strtolower($text)));
    }

    private function hasCommonLocationTokens(string $placeText, string $searchText): bool
    {
        $placeWords = array_filter(explode(' ', $placeText), fn($word) => strlen($word) > 2);
        $searchWords = array_filter(explode(' ', $searchText), fn($word) => strlen($word) > 2);

        if (empty($placeWords) || empty($searchWords)) {
            return false;
        }

        $common = array_intersect($placeWords, $searchWords);
        return count($common) >= 1;
    }

    public function getChargeAmount(float $distance): float
    {
        if (strtolower($this->fare_type) === 'fixed') {
            return $this->amount;
        }

        return $distance * $this->amount;
    }

    private function calculateDistanceKm(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371.0;
        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);

        $a = sin($latDelta / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($lngDelta / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
