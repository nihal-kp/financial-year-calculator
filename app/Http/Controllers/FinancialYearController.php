<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class FinancialYearController extends Controller
{
    public function getFinancialYear(Request $request)
    {
        $request->validate([
            'country' => 'required|in:GB,IE',
            'year' => 'required|string',
        ]);

        $country = $request->country;
        $year = (int)$request->year;

        if ($country === 'IE') {
            $start = Carbon::createFromDate($year, 1, 1);
            if($start->isWeekend()){
                $start = $start->nextWeekday();
            }
            $end = Carbon::createFromDate($year, 12, 31);
            if($end->isWeekend()){
                $end = $end->previousWeekday();
            }

            $response = Http::accept("text/plain")->get("https://date.nager.at/api/v3/PublicHolidays/" . $year . "/" . $country);
            $holidays = $response->successful() ? $response->json() : [];
        } else {
            $start = Carbon::createFromDate($year, 4, 6);
            if($start->isWeekend()){
                $start = $start->nextWeekday();
            }
            $end = Carbon::createFromDate($year + 1, 4, 5);
            if($end->isWeekend()){
                $end = $end->previousWeekday();
            }

            $response1 = Http::accept("text/plain")->get("https://date.nager.at/api/v3/PublicHolidays/" . $year . "/" . $country);
            $response2 = Http::accept("text/plain")->get("https://date.nager.at/api/v3/PublicHolidays/" . ($year + 1) . "/" . $country);
            $holidays = [];
            if ($response1->successful()) {
                $holidays = array_merge($holidays, $response1->json());
            }

            if ($response2->successful()) {
                $holidays = array_merge($holidays, $response2->json());
            }
        }

        $holidays = array_filter($holidays, function ($holiday) use ($start, $end) {
            $date = Carbon::parse($holiday['date']);
            return $date->between($start, $end, true) && !$date->isWeekend();
        });

        return response()->json([
            'start' => $start->toFormattedDateString(),
            'end' => $end->toFormattedDateString(),
            'holidays' => array_values($holidays),
        ]);
    }
}
