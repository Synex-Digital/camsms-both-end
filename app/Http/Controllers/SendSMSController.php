<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsConfig;
use App\Models\Category;
use App\Models\SendHistory;
use Illuminate\Support\Facades\Http;
use SMS;

class SendSMSController extends Controller
{
    //SMS Configuration//
    public function sms_config()
    {
        return view('dashboard.pages.sms.config');
    }

    public function sms_config_store(Request $request)
    {
        $request->validate([
            'url'           => 'required',
            'api_key'       => 'required',
            'sender_id'     => 'required',
        ]);

        $sms_config = new SmsConfig();
        $sms_config->url        = $request->url;
        $sms_config->api_key    = $request->api_key;
        $sms_config->sender_id  = $request->sender_id;
        $sms_config->save();

        return back()->with('success', 'SMS Configuration Added Successfully');
    }

    //Send SMS, Store and SMS History//
    public function sms_send_form()
    {
        $categories = Category::all();
        return view('dashboard.pages.sms.send', [
            'categories' => $categories
        ]);
    }

    public function sms_send_store(Request $request)
    {
        $request->validate([
            'number'        => 'required',
            'message'       => 'required',
            'type'          => 'required',
        ]);

        $smsConfig = SmsConfig::first();

        $response = SMS::Send($request->number, $request->message, $request->type);

        SendHistory::create([
            'number'        => $request->number,
            'type'          => $request->type,
            'category_id'   => $request->category_id,
            'message'       => $request->message,
        ]);

        return back()->with('success', 'SMS Sent Successfully');
    }

    public function sms_history()
    {
        $send_history = SendHistory::all();
        return view('dashboard.pages.sms.history', [
            'send_history' => $send_history
        ]);
    }

}
