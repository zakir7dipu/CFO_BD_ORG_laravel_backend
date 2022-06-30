<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function backWithError($message)
    {
        $notification = [
            'danger' => $message,
        ];
        return back()->with($notification);
    }

    public function backWithSuccess($message)
    {
        $notification = [
            'success' => $message,
        ];
        return back()->with($notification);
    }

    public function backWithWarning($message)
    {
        $notification = [
            'warning' => $message,
        ];
        return back()->with($notification);
    }
}
