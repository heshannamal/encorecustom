<?php

namespace App\Traits;

use domain\Facades\UserFacade\CustomerFacade;
use Exception;

trait UserHelper
{
    public function getAllCustomerCount()
    {
        $customerCount = CustomerFacade::getAllCustomersCount();
        return sprintf('%02d', $customerCount);
    }

    public function getCustomerAddress($user_id)
    {
        $customer = CustomerFacade::getCustomerByUserId($user_id);
        $address = $customer->address ? $customer->address.',' : '';
        $street = $customer->street ? $customer->street.',' : '';
        $city = $customer->city ? $customer->city.',' : '';
        $state = $customer->state ? $customer->state.',' : '';
        $postal_code = $customer->postal_code ? $customer->postal_code.',' : '';
        $country = $customer->country;

        return '<address>'.$address.' '.$street.'</address><address>'.$city.' '.$state.'</address><address>'.$postal_code.' '.$country.'</address>';
    }

    public function generateSecurePassword($length = 8)
    {
        $lettersLower = 'abcdefghijklmnopqrstuvwxyz';
        $lettersUpper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers      = '0123456789';
        $symbols      = '!@#$%^&*()_-+=<>?';

        // Combine all characters
        $allChars = $lettersLower . $lettersUpper . $numbers . $symbols;

        // Convert to array
        $charsArray = str_split($allChars);

        // Shuffle array
        shuffle($charsArray);

        // Ensure length does not exceed available unique chars
        if ($length > count($charsArray)) {
            throw new Exception('Password length exceeds available unique characters.');
        }

        // Take first $length characters
        return implode('', array_slice($charsArray, 0, $length));
    }

}
