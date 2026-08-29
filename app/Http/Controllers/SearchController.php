<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    /**
     * TfL Central London Congestion Charge Zone (approximate boundary).
     * Each point is [latitude, longitude]. Refine with official TfL GeoJSON
     * for production-grade accuracy.
     */
    private const CONGESTION_POLYGON = [
        [51.5200, -0.1040],
        [51.5200, -0.1800],
        [51.5000, -0.1950],
        [51.4800, -0.1200],
        [51.4900, -0.0800],
        [51.5100, -0.0600],
    ];

    public function index(Request $request, ?string $slug = null)
    {
        [$slugPickup, $slugDropoff] = $this->extractLocationsFromSlug($slug);

        $tripType   = $request->query('trip_type', 'one_way');
        $pickup     = $request->query('pickup') ?: $slugPickup ?: 'Heathrow';
        $dropoff    = $request->query('dropoff') ?: $slugDropoff ?: 'Central London';
        $returnPickup  = $request->query('return_pickup', '');
        $returnDropoff = $request->query('return_dropoff', '');

        $distance       = is_numeric($request->query('distance')) ? (float) $request->query('distance') : 0.0;
        $returnDistance = is_numeric($request->query('return_distance')) ? (float) $request->query('return_distance') : 0.0;

        $stops       = $this->extractStops($request);
        $returnStops = $this->extractStops($request, 'return_stops');

        $pickupDate = $request->query('pickup_date', '');
        $pickupTime = $request->query('pickup_time', '');
        $returnDate = $request->query('return_date', '');
        $returnTime = $request->query('return_time', '');
        $passengers = $request->query('passengers', 1);
        $luggage = $request->query('luggage', 0);
        $vehicleType = $request->query('vehicle_type', '');

        $meetGreet = $request->query('meet_greet', 0) == 1;

        $pLat = $request->query('pickup_lat');
        $pLng = $request->query('pickup_lng');
        $dLat = $request->query('dropoff_lat');
        $dLng = $request->query('dropoff_lng');

        $rpLat = $request->query('return_pickup_lat') ?? $dLat;
        $rpLng = $request->query('return_pickup_lng') ?? $dLng;
        $rdLat = $request->query('return_dropoff_lat') ?? $pLat;
        $rdLng = $request->query('return_dropoff_lng') ?? $pLng;

        $isCongestionZone = $this->congestionApplies($request, $pickup, $dropoff);

        if (empty($distance) && !empty($pickup) && !empty($dropoff)) {
            $distance = $this->calculateDistance($pickup, $dropoff, $stops);
        }

        if ($tripType === 'return' && empty($returnDistance) && !empty($returnPickup) && !empty($returnDropoff)) {
            $returnDistance = $this->calculateDistance($returnPickup, $returnDropoff, $returnStops);
        }

        $cars = Car::oldest()->get()->map(function ($car) use (
            $distance,
            $returnDistance,
            $tripType,
            $meetGreet,
            $isCongestionZone,
            $pLat,
            $pLng,
            $dLat,
            $dLng,
            $rpLat,
            $rpLng,
            $rdLat,
            $rdLng
        ) {
            // One way base price calculation
            $oneWayPrice = $this->calculatePrice($car, $distance);

            $locationFare = 0.0;
            if (is_numeric($pLat) && is_numeric($pLng)) {
                $locationFare += $this->getLocationFare((float) $pLat, (float) $pLng, 'pickup', $distance, $car->id);
            }
            if (is_numeric($dLat) && is_numeric($dLng)) {
                $locationFare += $this->getLocationFare((float) $dLat, (float) $dLng, 'dropoff', $distance, $car->id);
            }
            $oneWayPrice += $locationFare;

            if ($meetGreet) {
                $oneWayPrice += 15;
            }

            if ($isCongestionZone) {
                $oneWayPrice += (float) $car->base_price;
            }

            $onewayTotal = ceil($oneWayPrice);
            $returnOriginal = $onewayTotal * 2;
            $returnDiscounted = round($returnOriginal * 0.95, 2);

            $car->oneway_price = $onewayTotal;
            $car->return_original_price = $returnOriginal;
            $car->return_price = $returnDiscounted;
            $car->return_savings = round($returnOriginal - $returnDiscounted, 2);

            if ($tripType === 'return') {
                $car->calculated_price = $returnDiscounted;
                $car->original_price = $returnOriginal;
            } else {
                $car->calculated_price = $onewayTotal;
                $car->original_price = null;
            }

            $car->base_price_display = ceil($this->calculatePrice($car, $distance));

            return $car;
        });

        if (!empty($vehicleType) && $vehicleType !== 'any') {
            $cars = $cars->filter(function ($car) use ($vehicleType) {
                return strtolower($car->vehicle_type ?? '') === strtolower($vehicleType) ||
                    str_contains(strtolower($car->name), strtolower($vehicleType));
            });
        }

        $cars = $cars->filter(function ($car) use ($passengers) {
            $capacity = $car->price ?? $car->max_passengers ?? 4;
            return (int) $capacity >= (int) $passengers;
        });

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'cars' => $cars->values(),
                'trip_type' => $tripType,
                'pickup' => $pickup,
                'dropoff' => $dropoff,
                'return_pickup' => $returnPickup,
                'return_dropoff' => $returnDropoff,
                'distance' => round($distance, 2),
                'return_distance' => round($returnDistance, 2),
                'stops' => $stops,
                'return_stops' => $returnStops,
                'meet_greet' => $meetGreet,
                'congestion_zone' => $isCongestionZone,
                'pickup_date' => $pickupDate,
                'pickup_time' => $pickupTime,
                'return_date' => $returnDate,
                'return_time' => $returnTime,
                'passengers' => $passengers,
                'luggage' => $luggage,
                'vehicle_type' => $vehicleType,
                'total_cars' => $cars->count(),
            ]);
        }

        $routeSlug = $this->buildRouteSlug($pickup, $dropoff);

        return view('search', compact(
            'cars',
            'tripType',
            'pickup',
            'dropoff',
            'returnPickup',
            'returnDropoff',
            'distance',
            'returnDistance',
            'routeSlug',
            'stops',
            'returnStops',
            'meetGreet',
            'pickupDate',
            'pickupTime',
            'returnDate',
            'returnTime',
            'passengers',
            'luggage',
            'vehicleType',
            'isCongestionZone'
        ));
    }

    /**
     * Calculate driving distance between locations using Google Maps API
     */
    /**
     * Calculate driving distance between locations using Google Maps API or coordinates fallback
     */
    private function calculateDistance($pickup, $dropoff, array $stops = [], $pLat = null, $pLng = null, $dLat = null, $dLng = null): float
    {
        $apiKey = config('services.google.maps_key');
        
        if ($apiKey) {
            try {
                $waypoints = array_slice($stops, 0, 10);
                $waypointsStr = !empty($waypoints) ? '|' . implode('|', array_map('urlencode', $waypoints)) : '';
                
                $url = sprintf(
                    'https://maps.googleapis.com/maps/api/distancematrix/json?origins=%s&destinations=%s%s&key=%s&units=imperial',
                    urlencode($pickup),
                    urlencode($dropoff),
                    $waypointsStr,
                    $apiKey
                );
                
                $response = Http::get($url);
                
                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['rows'][0]['elements'][0]['distance']['value'])) {
                        // Convert meters to miles
                        return round($data['rows'][0]['elements'][0]['distance']['value'] / 1609.34, 2);
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Distance calculation failed: ' . $e->getMessage());
            }
        }
        
        if (is_numeric($pLat) && is_numeric($pLng) && is_numeric($dLat) && is_numeric($dLng)) {
            $haversine = $this->haversineDistance((float)$pLat, (float)$pLng, (float)$dLat, (float)$dLng);
            if ($haversine > 0) {
                return $haversine;
            }
        }
        
        return $this->estimateDistance($pickup, $dropoff);
    }

    /**
     * Calculate Haversine distance in miles using latitude/longitude with UK road curvature factor
     */
    private function haversineDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 3958.8; // Radius of Earth in miles
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $crowMiles = $earthRadius * $c;
        
        return round($crowMiles * 1.28, 2);
    }
    
    /**
     * Estimate distance as a fallback when API fails
     */
    private function estimateDistance($pickup, $dropoff): float
    {
        // Common UK airport distances (miles) - fallback approximations
        $airportDistances = [
            'heathrow' => ['central london' => 16, 'london' => 16, 'city' => 18],
            'gatwick' => ['central london' => 28, 'london' => 28],
            'stansted' => ['central london' => 38, 'london' => 38],
            'luton' => ['central london' => 34, 'london' => 34],
            'london city' => ['central london' => 8, 'heathrow' => 22],
            'manchester' => ['city centre' => 9, 'manchester' => 9],
            'birmingham' => ['city centre' => 8, 'birmingham' => 8],
        ];
        
        $pickupLower = strtolower($pickup);
        $dropoffLower = strtolower($dropoff);
        
        foreach ($airportDistances as $airport => $destinations) {
            if (str_contains($pickupLower, $airport)) {
                foreach ($destinations as $dest => $dist) {
                    if (str_contains($dropoffLower, $dest)) {
                        return $dist;
                    }
                }
            }
            if (str_contains($dropoffLower, $airport)) {
                foreach ($destinations as $dest => $dist) {
                    if (str_contains($pickupLower, $dest)) {
                        return $dist;
                    }
                }
            }
        }
        
        // Default fallback: 25 miles
        return 25.00;
    }

    /**
     * Search API endpoint for AJAX requests from the welcome page
     */
    public function searchAjax(Request $request)
    {
        $pickup = $request->input('pickup');
        $dropoff = $request->input('dropoff');
        $distance = $request->input('distance');
        $stops = $request->input('stops', '[]');
        $tripType = $request->input('trip_type', 'oneway');
        
        $pLat = $request->input('pickup_lat');
        $pLng = $request->input('pickup_lng');
        $dLat = $request->input('dropoff_lat');
        $dLng = $request->input('dropoff_lng');
        
        // Parse stops if it's a JSON string
        if (is_string($stops)) {
            $stops = json_decode($stops, true) ?: [];
        }
        
        // Calculate distance if not provided
        if (empty($distance) && !empty($pickup) && !empty($dropoff)) {
            $distance = $this->calculateDistance($pickup, $dropoff, $stops, $pLat, $pLng, $dLat, $dLng);
        }
        
        $cars = Car::oldest()->get()->map(function($car) use ($distance, $tripType) {
            $price = $this->calculatePrice($car, $distance);
            
            if ($tripType === 'return') {
                $returnPrice = $this->calculatePrice($car, $distance);
                $totalBeforeDiscount = $price + $returnPrice;
                $car->original_price = round($totalBeforeDiscount, 2);
                $price = round($totalBeforeDiscount * 0.95, 2);
            } else {
                $price = round($price, 2);
            }
            
            $car->calculated_price = $price;
            $car->base_price = $price;
            
            return $car;
        });
        
        return response()->json([
            'cars' => $cars->values(),
            'distance' => round($distance, 2)
        ]);
    }
    
    /**
     * Full price for one leg = slab mileage price (or fallback base + per-mile).
     */
    private function calculatePrice($car, float $dist): float
    {
        if ($dist <= 0) {
            return 0.0;
        }

        $pricing = $car->mileage_pricing;

        if (is_array($pricing) && !empty($pricing)) {
            return $this->calculateMileagePrice($pricing, $dist);
        }

        return (float) $car->base_price + ($dist * (float) $car->price_per_mile);
    }

    /**
     * Location fares based on lat/lng.
     */
    private function getLocationFare(float $lat, float $lng, string $type, float $dist, $carId): float
    {
        $loc = DB::table('location_fares')
            ->where('latitude', '>=', $lat - 0.0001)
            ->where('latitude', '<=', $lat + 0.0001)
            ->where('longitude', '>=', $lng - 0.0001)
            ->where('longitude', '<=', $lng + 0.0001)
            ->whereIn('applies_to', [$type, 'both'])
            ->when(!empty($carId), function ($query) use ($carId) {
                $query->where('vehicle_id', $carId);
            })
            ->where('status', 1)
            ->orderBy('priority', 'DESC')
            ->first();

        if ($loc) {
            if ($loc->fare_type === 'fixed') {
                return (float) $loc->fare_amount;
            }

            $fare = $dist * (float) $loc->fare_amount;
            if (!empty($loc->max_cap)) {
                $fare = min($fare, (float) $loc->max_cap);
            }

            return $fare;
        }

        return 0.0;
    }

    /**
     * Slab-based mileage pricing.
     */
    private function calculateMileagePrice(array $pricing, float $dist): float
    {
        usort($pricing, function ($a, $b) {
            return (float) ($a['min'] ?? 0) <=> (float) ($b['min'] ?? 0);
        });

        $total = 0.0;
        $remaining = $dist;

        foreach ($pricing as $range) {
            if ($remaining <= 0) {
                break;
            }

            $min = (float) ($range['min'] ?? 0);
            $max = (float) ($range['max'] ?? 0);
            $rate = (float) ($range['price'] ?? 0);
            $tierWidth = $max - $min;

            if ($tierWidth <= 0) {
                continue;
            }

            $milesInTier = min($remaining, $tierWidth);
            $total += $milesInTier * $rate;
            $remaining -= $milesInTier;
        }

        return $total;
    }

    /**
     * Congestion applies when either pickup or dropoff is inside the polygon or
     * when the location name falls inside a known zone.
     */
    private function congestionApplies(Request $request, string $pickup, string $dropoff): bool
    {
        $pLat = $request->query('pickup_lat');
        $pLng = $request->query('pickup_lng');
        $dLat = $request->query('dropoff_lat');
        $dLng = $request->query('dropoff_lng');

        $hasCoords = is_numeric($pLat) && is_numeric($pLng)
            && is_numeric($dLat) && is_numeric($dLng);

        if ($hasCoords) {
            return $this->checkCongestionZoneByLatLng((float) $pLat, (float) $pLng, (float) $dLat, (float) $dLng);
        }

        return $this->isCongestionZoneByName($pickup)
            || $this->isCongestionZoneByName($dropoff);
    }

    /**
     * Ray-casting point-in-polygon for lat/lng.
     */
    private function isInCongestionZone(float $lat, float $lng): bool
    {
        $polygon = self::CONGESTION_POLYGON;
        $inside = false;
        $n = count($polygon);
        $j = $n - 1;

        for ($i = 0; $i < $n; $i++) {
            $yi = $polygon[$i][0];
            $xi = $polygon[$i][1];
            $yj = $polygon[$j][0];
            $xj = $polygon[$j][1];

            $intersect = (($yi > $lat) !== ($yj > $lat))
                && ($lng < ($xj - $xi) * ($lat - $yi) / (($yj - $yi) ?: 1e-12) + $xi);

            if ($intersect) {
                $inside = !$inside;
            }

            $j = $i;
        }

        return $inside;
    }

    /**
     * Combined pickup/dropoff congestion check.
     */
    private function checkCongestionZoneByLatLng(float $pickupLat, float $pickupLng, float $dropLat, float $dropLng): bool
    {
        return $this->isInCongestionZone($pickupLat, $pickupLng)
            || $this->isInCongestionZone($dropLat, $dropLng);
    }

    /**
     * Name-based fallback for congestion zone without coordinates.
     */
    private function isCongestionZoneByName(string $location): bool
    {
        $zones = [
            'westminster', 'soho', 'mayfair', 'covent garden', 'charing cross',
            'waterloo', 'city of london', 'holborn', 'bloomsbury', 'barbican',
            'southwark', 'marylebone',
        ];

        $location = strtolower($location);

        foreach ($zones as $zone) {
            if (str_contains($location, $zone)) {
                return true;
            }
        }

        if (preg_match('/\bec\d[a-z]?\b/i', $location)) {
            return true;
        }

        return false;
    }

    private function extractStops(Request $request, string $param = 'stops'): array
    {
        $raw = $request->query($param);
        if (empty($raw) && $param === 'stops') {
            $raw = $request->query('via');
        }

        $stops = [];

        if (is_string($raw) && $raw !== '') {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                $stops = $decoded;
            } else {
                $stops = [$raw];
            }
        } elseif (is_array($raw)) {
            $stops = $raw;
        }

        $stops = array_values(array_filter(array_map(function ($v) {
            return is_string($v) ? trim($v) : '';
        }, $stops), function ($v) {
            return $v !== '';
        }));

        return array_slice($stops, 0, 10);
    }

    private function buildRouteSlug(string $pickup, string $dropoff): string
    {
        if (empty($pickup) || empty($dropoff)) {
            return '';
        }
        return $this->slugifySegment($pickup) . '-to-' . $this->slugifySegment($dropoff);
    }

    private function extractLocationsFromSlug(?string $slug): array
    {
        if (empty($slug) || !str_contains($slug, '-to-')) {
            return [null, null];
        }

        [$pickupSegment, $dropoffSegment] = explode('-to-', $slug, 2);

        $pickup = $this->humanizeSegment($pickupSegment);
        $dropoff = $this->humanizeSegment($dropoffSegment);

        return [$pickup, $dropoff];
    }

    private function slugifySegment(string $value): string
    {
        return trim(preg_replace('/-+/', '-', strtolower(preg_replace('/[^a-z0-9]+/i', '-', $value))), '-');
    }

    private function humanizeSegment(string $segment): string
    {
        return trim(ucwords(str_replace('-', ' ', $segment)));
    }

    /**
     * Find address suggestions via external live UK locations API
     */
    public function findAddress(Request $request)
    {
        $text = $request->input('text') ?: $request->input('query');

        if (empty($text)) {
            return response()->json([
                'status' => false,
                'message' => 'Search text is required'
            ]);
        }

        $url = "https://www.airporttaxis-uk.co.uk/live.php";

        $postData = http_build_query([
            "query" => $text,
            "data"  => "action=suggestlocations&filters="
        ]);

        $headers = [
            "accept: application/json, text/javascript, */*; q=0.01",
            "accept-language: en-US,en;q=0.9",
            "content-type: application/x-www-form-urlencoded; charset=UTF-8",
            "x-requested-with: XMLHttpRequest",
            "referer: https://www.airporttaxis-uk.co.uk/"
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return response()->json([
                'status' => false,
                'message' => 'Curl Error: ' . $error
            ], 500);
        }

        curl_close($ch);

        return response($response, 200)->header('Content-Type', 'application/json');
    }
}