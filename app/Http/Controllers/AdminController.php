<?php

namespace App\Http\Controllers;

use App\Models\ContectMessage;
use App\Models\Event;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index() {
        try {
            $title = "Dashboard";
            return view("backend.pages.dashboard", compact('title'));
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function generalSettings() {
        try {
            $title = "General Settings";
            return view("backend.pages.general-settings", compact('title'));
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function storeGeneralSettings(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);
        try {
            $generalSettings = 'settings.general_settings.';
            setting([$generalSettings . 'app_name' => $request->name]);
            setting([$generalSettings . 'phone' => $request->phone]);
            setting([$generalSettings . 'email' => $request->email]);
            setting([$generalSettings . 'address' => $request->address]);

            if($request->hasFile('logo')){
                if(setting($generalSettings.'app_logo')) {
                    if (file_exists(public_path(setting($generalSettings . 'app_logo')))) {
                        unlink(public_path(setting($generalSettings . 'app_logo')));
                    }
                }
                $image = $request->logo;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(120, 60)
                    ->save(public_path('/upload/settings/' . $filename));
                $logo = "/upload/settings/".$filename;
                setting([$generalSettings . 'app_logo' => $logo]);
            }

            if($request->hasFile('favicon')){
                if(setting($generalSettings.'favicon')) {
                    if (file_exists(public_path(setting($generalSettings . 'favicon')))) {
                        unlink(public_path(setting($generalSettings . 'favicon')));
                    }
                }
                $image = $request->favicon;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(45, 20)
                    ->save(public_path('/upload/settings/' . $filename));
                $favicon = "/upload/settings/".$filename;
                setting([$generalSettings . 'app_favicon' => $favicon]);
            }

            $facebook = str_replace("https://","",$request->facebook);
            $facebook = str_replace("www.","",$facebook);
            $facebook = strlen($facebook)?'https://www.'.$facebook:'';
            setting([$generalSettings . 'facebook' => $facebook]);

            $linkedin = str_replace("https://","",$request->linkedin);
            $linkedin = str_replace("www.","",$linkedin);
            $linkedin = strlen($linkedin)?'https://www.'.$linkedin:'';
            setting([$generalSettings . 'linkedin' => $linkedin]);

            return $this->backWithSuccess('Data saved successfully');
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function homePageSettings() {
        try {
            $title = "Home Page Settings";
            $sliders = SliderImage::all();
            $events = Event::all();
            return view("backend.pages.home-page-settings", compact('title', 'sliders', 'events'));
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    // slider
    public function createSlider() {
        try {
            $content = '<form action="'.route('settings.home-slider').'" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex">
                        <div class="form-group col-4">
                            <label for="sliderImage">Slider Image <code>Size Should be 1519px X 791px</code></label>
                            <input class="form-control" type="file" name="slider_img" id="sliderImage">
                        </div>
                        <div class="form-group col-8">
                            <img class="img img-thumbnail img-fluid" src="" alt="" id="sliderImageView">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>';
            return response()->json($content);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function showSlider(SliderImage $slider) {
        try {
            $content = '<form action="'.route('settings.home-slider-update',$slider->id).'" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex">
                        <div class="form-group col-4">
                            <label for="sliderImage">Slider Image <code>Size Should be 1519px X 791px</code></label>
                            <input class="form-control" type="file" name="slider_img" id="sliderImage">
                        </div>
                        <div class="form-group col-8">
                            <img class="img img-thumbnail img-fluid" src="'.$slider->img.'" alt="" id="sliderImageView">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="'.route('settings.home-slider-destroy',$slider->id).'"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button></a>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>';
            return response()->json($content);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function storeSlider(Request $request) {
        $this->validate($request,[
            'slider_img' => ['required']
        ]);
        DB::beginTransaction();
        try {
            if($request->hasFile('slider_img')){
                $image = $request->slider_img;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(1519, 791)
                    ->save(public_path('/upload/sliders/' . $filename));
                $sliderImg = "/upload/sliders/".$filename;
                $slider = new SliderImage();
                $slider->img = $sliderImg;
                $slider->save();
                DB::commit();
                return $this->backWithSuccess('Slider saved successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->backWithError($th->getMessage());
        }
    }

    public function updateSlider(Request $request, SliderImage $slider) {
        $this->validate($request,[
            'slider_img' => ['required']
        ]);
        DB::beginTransaction();
        try {
            if($request->hasFile('slider_img')){
                if (file_exists(public_path($slider->img))){
                    unlink(public_path($slider->img));
                }
                $image = $request->slider_img;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(1519, 791)
                    ->save(public_path('/upload/sliders/' . $filename));
                $sliderImg = "/upload/sliders/".$filename;
                $slider->img = $sliderImg;
                $slider->save();
                DB::commit();
                return $this->backWithSuccess('Slider updated successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->backWithError($th->getMessage());
        }
    }

    public function destroySlider(SliderImage $slider){
        DB::beginTransaction();
        try {
            if (file_exists(public_path($slider->img))){
                unlink(public_path($slider->img));
            }
            $slider->delete();
            DB::commit();
            return $this->backWithSuccess('Slider deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->backWithError($th->getMessage());
        }
    }

    // about
    public function storeAbout(Request $request){

        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        try {
            $root = 'pages.home.about.';
            setting([$root . 'title' => $request->title]);
            setting([$root . 'description' => $request->description]);
            if($request->hasFile('about_img')){
                if(setting($root.'about_img')) {
                    if (file_exists(public_path(setting($root . 'about_img')))) {
                        unlink(public_path(setting($root . 'about_img')));
                    }
                }
                $image = $request->about_img;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(464, 464)
                    ->save(public_path('/upload/settings/' . $filename));
                $aboutImg = "/upload/settings/".$filename;
                setting([$root . 'image' => $aboutImg]);
            }

            return $this->backWithSuccess("Data saved successfully.");
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    // goal
    public function storeGoal(Request $request){
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        try {
            $root = 'pages.home.goal.';
            setting([$root . 'title' => $request->title]);
            setting([$root . 'description' => $request->description]);
            if($request->hasFile('goal_img')){
                if(setting($root.'goal_img')) {
                    if (file_exists(public_path(setting($root . 'goal_img')))) {
                        unlink(public_path(setting($root . 'goal_img')));
                    }
                }
                $image = $request->goal_img;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(464, 464)
                    ->save(public_path('/upload/settings/' . $filename));
                $goalImg = "/upload/settings/".$filename;
                setting([$root . 'image' => $goalImg]);
            }

            return $this->backWithSuccess("Data saved successfully.");
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    // event
    public function createEvent() {
        try {
            $content = '<form action="'.route('settings.home-event').'" method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="eventTitel">Title</label>
                            <input class="form-control" type="text" name="title" id="eventTitel">
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="startAt">Start At</label>
                                <input class="form-control" type="date" name="start_at" id="startAt">
                            </div>
                            <div class="form-group col-4">
                                <label for="endAt">End At</label>
                                <input class="form-control" type="date" name="end_at" id="endAt">
                            </div>
                            <div class="form-group col-4">
                                <label for="eventLocation">Location</label>
                                <input class="form-control" type="text" name="location" id="eventLocation">
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-8">
                                 <div class="form-group">
                                     <label for="eventDescription">Description</label>
                                     <textarea type="text" name="description" id="eventDescription" required></textarea>
                                 </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                     <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="eventStatus" name="status" checked>
                                            <label class="form-check-label" for="eventStatus">Event Publish</label>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="eventButtonLabel">Button Label</label>
                                     <input class="form-control" type="text" name="btn_label" id="eventButtonLabel">
                                 </div>
                                 <div class="form-group">
                                     <label for="eventButtonLink">Button Link</label>
                                     <input class="form-control" type="text" name="btn_link" id="eventButtonLink">
                                 </div>
                                 <div class="form-group">
                                    <img class="img img-thumbnail img-fluid" src="" alt="" id="eventImageView">
                                </div>
                                <div class="form-group">
                                    <label for="eventImage">Slider Image <code>Size Should be 500px X 375px</code></label>
                                    <input class="form-control" type="file" name="event_img" id="eventImage">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>';
            return response()->json($content);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function showEvent(Event $event) {
        try {
            $content = '<form action="'.route('settings.home-event-update', $event->id).'" method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit <i>'.$event->title.'</i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="eventTitel">Title</label>
                            <input class="form-control" type="text" name="title" id="eventTitel" value="'.$event->title.'">
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="startAt">Start At</label>
                                <input class="form-control" type="date" name="start_at" id="startAt" value="'.$event->start_at.'">
                            </div>
                            <div class="form-group col-4">
                                <label for="endAt">End At</label>
                                <input class="form-control" type="date" name="end_at" id="endAt" value="'.$event->end_at.'">
                            </div>
                            <div class="form-group col-4">
                                <label for="eventLocation">Location</label>
                                <input class="form-control" type="text" name="location" id="eventLocation" value="'.$event->location.'">
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-8">
                                 <div class="form-group">
                                     <label for="eventDescription">Description</label>
                                     <textarea type="text" name="description" id="eventDescription" required>'.$event->description.'</textarea>
                                 </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                     <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="eventStatus" name="status" '.($event->status?"checked":"").' >
                                            <label class="form-check-label" for="eventStatus">Event Publish</label>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="eventButtonLabel">Button Label</label>
                                     <input class="form-control" type="text" name="btn_label" id="eventButtonLabel" value="'.$event->btn_label.'">
                                 </div>
                                 <div class="form-group">
                                     <label for="eventButtonLink">Button Link</label>
                                     <input class="form-control" type="text" name="btn_link" id="eventButtonLink" value="'.$event->btn_link.'">
                                 </div>
                                 <div class="form-group">
                                    <img class="img img-thumbnail img-fluid" src="'.$event->img.'" alt="" id="eventImageView">
                                </div>
                                <div class="form-group">
                                    <label for="eventImage">Slider Image <code>Size Should be 500px X 375px</code></label>
                                    <input class="form-control" type="file" name="event_img" id="eventImage">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="'.route('settings.event-destroy',$event->id).'"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button></a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>';
            return response()->json($content);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function storeEvent(Request $request) {
        $this->validate($request,[
            'start_at' => ['required'],
            'location' => ['required'],
            'title' => ['required'],
            'description' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $event = new Event();
            $event->start_at = $request->start_at;
            $event->end_at = $request->end_at;
            $event->location = $request->location;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->btn_label = $request->btn_label;
            $event->btn_link = $request->btn_link;
            $event->status = $request->status === 'on'?true:false;
            if($request->hasFile('event_img')){
                $image = $request->event_img;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(500, 375)
                    ->save(public_path('/upload/events/' . $filename));
                $eventImg = "/upload/events/".$filename;
                $event->img = $eventImg;
            }
            $event->save();
            DB::commit();
            return $this->backWithSuccess('Event saved successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->backWithError($th->getMessage());
        }
    }

    public function destroyEvent(Event $event) {
        DB::beginTransaction();
        try {
            if (file_exists(public_path($event->img))){
                unlink(public_path($event->img));
            }
            $event->delete();
            DB::commit();
            return $this->backWithSuccess('Event deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->backWithError($th->getMessage());
        }
    }

    // about page
    public function aboutPageSettings() {
        try {
            $title = "About Page Settings";
            return view("backend.pages.about-settings", compact('title'));
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function storeAboutPageSettings(Request $request) {
        $this->validate($request, [
           'title',
            'description_1',
        ]);
        $root = 'pages.about.';
        try {
            setting([$root . 'title' => $request->title]);
            setting([$root . 'description_1' => $request->description_1]);
            setting([$root . 'description_2' => $request->description_2]);
            setting([$root . 'video_link' => $request->video_link]);

            if ($request->hasFile('thumbnail')){
                if(setting($root.'thumbnail')) {
                    if (file_exists(public_path(setting($root . 'thumbnail')))) {
                        unlink(public_path(setting($root . 'thumbnail')));
                    }
                }
                $image = $request->thumbnail;
                $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $x = str_shuffle($x);
                $x = substr($x, 0, 6) . 'DAC.';
                $filename = time() . $x . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())
                    ->resize(523, 570)
                    ->save(public_path('/upload/settings/' . $filename));
                $thumbnail = "/upload/settings/".$filename;
                setting([$root . 'thumbnail' => $thumbnail]);
            }

            return $this->backWithSuccess('About page saved successfully.');
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    // contact message
    public function contactMessageIndex() {
        try {
            $title = "Contact Messages";
            $messages = ContectMessage::all();
            return view("backend.pages.contact-messages", compact('title', 'messages'));
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    public function contactMessageShow(ContectMessage $message) {
        try {
            $content = '<div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">'.$message->subject.'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Name: '.$message->first_name." ".$message->last_name.'</h6>
                        <h6>Subject: '.$message->subject.'</h6>
                        <p>'.$message->message.'</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>';
            return response()->json($content);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
