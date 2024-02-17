<?php

namespace App\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Helper {

	/**
	 * To upload a file to storage.
	 * 
	 * @param file
	 * 
	 * @param string
	 * 
	 * @return string
	*/
	public static function upload_file($file, $folder_path): string 
	{

        if(!is_file($file)) return asset('placeholders/user/avatar.png');
		
		info("Uploaded file extension : ". $file->extension());

        $disk = 'public';

        return asset(Storage::disk($disk)->url($file->store($folder_path, $disk)));
    }

    /**
	 * To delete a file from storage.
	 * 
	 * @param string
	 * 
	 * @param string
	 * 
	 * @return bool
	*/
	public static function delete_file($url, $folder_path): bool 
	{
		if(!$path = "$folder_path/".basename($url)) return false;

		$disk = 'public';

        return Storage::disk($disk)->delete($path);
    }

	/**
	 * To generate a verification code & verification code expiry.
	 * 
	 * @return array
	*/
	public static function generate_verification_code(): array {

		return [
			'verification_code' => self::generateOTP(),
			'verification_code_expiry' => time() + (config('app.otp_expiry_in_minutes') * 60)
		];
	}

	/**
	 * To generate a OTP code.
	 * 
	 * @return string
	*/
	public static function generateOTP($digits = 6): string {

		$numbers = Arr::shuffle(range(0, 9));

		$otp = Arr::random($numbers, $digits);

		return Arr::join($otp, "");
	}
}