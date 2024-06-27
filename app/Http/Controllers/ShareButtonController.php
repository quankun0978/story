<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jorenvh\Share\Share;

class ShareButtonController extends Controller
{
    function shareWidget()
    {
        $share = new Share();
        $shareComponent = $share->page('http://127.0.0.1:8000/', 'Share link')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        return view('share.post', compact('shareComponent'));
    }
}
