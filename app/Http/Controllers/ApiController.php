<?php

namespace App\Http\Controllers;

use App\Models\ContectMessage;
use App\Models\Event;
use App\Models\SliderImage;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSocialLinks()
    {
        try {
            $data = (object)[
                'facebook' => setting('settings.general_settings.facebook'),
                'linkedin' => setting('settings.general_settings.linkedin')
            ];
            return response()->json($data);
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function baseInfoSection()
    {
        try {
            $data = (object)[
                'logo' => setting('settings.general_settings.app_logo'),
                'address' => setting('settings.general_settings.address'),
                'phone' => setting('settings.general_settings.phone'),
                'email' => setting('settings.general_settings.email')
            ];
            return response()->json($data);
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function sliderView()
    {
        try {
            return response()->json(SliderImage::all());
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function aboutSection()
    {
        try {
            return response()->json(setting('pages.home.about'));
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function goalSection()
    {
        try {
            return response()->json(setting('pages.home.goal'));
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function eventsSection()
    {
        try {
            return response()->json(Event::orderBy("id", "desc")->where("status", true)->take(3)->get());
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function eventsAll()
    {
        try {
            return response()->json(Event::orderBy("id", "desc")->where("status", true)->get());
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function eventShow(Event $event)
    {
        try {
            $data = (object)[
                'logo' => setting('settings.general_settings.app_logo'),
                'address' => setting('settings.general_settings.address'),
                'phone' => setting('settings.general_settings.phone'),
                'email' => setting('settings.general_settings.email'),
                'event' => $event
            ];
            return response()->json($data);
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function aboutPage()
    {
        try {
            return response()->json(setting('pages.about'));
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function contactMessage(Request $request)
    {
        try {
            $message = new ContectMessage();
            $message->first_name = $request->name;
            $message->last_name = $request->lastname;
            $message->email = $request->email;
            $message->subject = $request->subject;
            $message->message = $request->notes;
            $message->save();
            return response()->json((object)[
                'status' => 201,
                'message' => 'Thank you for your response.'
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
