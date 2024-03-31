<?php

namespace App\Http\Controllers\Api\Passbook;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassbookResource;
use Exception;
use Illuminate\Http\Request;

class PassbookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {

            return $this->success('', [
                'passbook' => new PassbookResource($request->user()->passbook)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
