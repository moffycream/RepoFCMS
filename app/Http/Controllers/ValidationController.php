<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function validatePostcode(Request $request)
    {
        $postcode = $request->postcode;
        $postcode = str_replace(' ', '', $postcode);
        $postcode = strtoupper($postcode);
        $postcode = trim($postcode);

        $postcodeRegex = "/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/";

        if (preg_match($postcodeRegex, $postcode)) {
            return true;
        } else {
            return false;
        }
    }
}