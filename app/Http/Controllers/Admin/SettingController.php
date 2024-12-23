<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Social;
use App\User;
use Toastr;
use Image;
use File;
use Auth;
use Hash;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.setting', 1);
        $this->route = 'admin.setting';
        $this->view = 'admin.setting';
        $this->path = 'setting';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = Setting::where('status', 1)->first();
        $data['social'] = Social::where('status', 1)->first();

        return view($this->view . '.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function siteInfo(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:250',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'map_path' => 'mimes:mp4,mov,avi,wmv|max:102400',
            'pdf_path' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $id = $request->id;

        // Logo upload, fit and store inside public folder 
        if ($request->hasFile('logo')) {
            $old_file = Setting::find($id);
            if (isset($old_file->logo_path)) {
                $file_path = public_path('uploads/' . $this->path . '/' . $old_file->logo_path);
                if (File::isFile($file_path)) {
                    File::delete($file_path);
                }
            }

            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $logoNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = public_path('uploads/' . $this->path . '/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $thumbnailpath = $path . $logoNameToStore;
            $img = Image::make($request->file('logo')->getRealPath())->resize(null, 80, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbnailpath);
        } else {
            $old_file = Setting::find($id);
            $logoNameToStore = $old_file->logo_path ?? null;
        }

        // Favicon upload, fit and store inside public folder
        if ($request->hasFile('favicon')) {
            $old_file = Setting::find($id);
            if (isset($old_file->favicon_path)) {
                $file_path = public_path('uploads/' . $this->path . '/' . $old_file->favicon_path);
                if (File::isFile($file_path)) {
                    File::delete($file_path);
                }
            }

            $filenameWithExt = $request->file('favicon')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('favicon')->getClientOriginalExtension();
            $faviconNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = public_path('uploads/' . $this->path . '/');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $thumbnailpath = $path . $faviconNameToStore;
            $img = Image::make($request->file('favicon')->getRealPath())->fit(64, 64, function ($constraint) {
                $constraint->upsize();
            })->save($thumbnailpath);
        } else {
            $old_file = Setting::find($id);
            $faviconNameToStore = $old_file->favicon_path ?? null;
        }

        // Catalogue upload
        // if ($request->hasFile('catalogue_path')) {
        //     $old_file = Setting::find($id);
        //     if (isset($old_file->catalogue_path)) {
        //         $file_path = public_path('uploads/' . $this->path . '/' . $old_file->catalogue_path);
        //         if (File::isFile($file_path)) {
        //             File::delete($file_path);
        //         }
        //     }

        //     $filenameWithExt = $request->file('catalogue_path')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('catalogue_path')->getClientOriginalExtension();
        //     $catalogueNameToStore = $filename . '_' . time() . '.' . $extension;
        //     $path = public_path('uploads/' . $this->path . '/');
        //     if (!File::exists($path)) {
        //         File::makeDirectory($path, 0777, true, true);
        //     }
        //     $thumbnailpath = $path . $catalogueNameToStore;
        //     $img = Image::make($request->file('catalogue_path')->getRealPath())->save($thumbnailpath);
        // } else {
        //     $old_file = Setting::find($id);
        //     $catalogueNameToStore = $old_file->catalogue_path ?? null;
        // }

        // Map upload
        // Map upload
        if ($request->hasFile('map_path')) {
            // Retrieve the old file
            $old_file = Setting::find($id);
            if (isset($old_file->map_path)) {
                $file_path = public_path('uploads/' . $this->path . '/' . $old_file->map_path);
                if (File::isFile($file_path)) {
                    File::delete($file_path); // Delete the old file
                }
            }

            // Get file information
            $filenameWithExt = $request->file('map_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('map_path')->getClientOriginalExtension();

            // Generate a unique filename
            $mapNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = public_path('uploads/' . $this->path . '/');

            // Ensure the directory exists
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Move the uploaded video file
            $request->file('map_path')->move($path, $mapNameToStore);
        } else {
            $old_file = Setting::find($id);
            $mapNameToStore = $old_file->map_path ?? null;
        }

        if ($request->hasFile('pdf_path')) {
            // Retrieve the old file
            $old_file = Setting::find($id);
            if (isset($old_file->pdf_path)) {
                $file_path = public_path('uploads/' . $this->path . '/' . $old_file->pdf_path);
                if (File::isFile($file_path)) {
                    File::delete($file_path); // Delete the old file
                }
            }

            // Get file information for the PDF
            $filenameWithExt = $request->file('pdf_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('pdf_path')->getClientOriginalExtension();

            // Generate a unique filename for the PDF
            $pdfNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = public_path('uploads/' . $this->path . '/');

            // Ensure the directory exists for PDFs
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Move the uploaded PDF file
            $request->file('pdf_path')->move($path, $pdfNameToStore);
        } else {
            // Retain the old file if no new PDF is uploaded
            $old_file = Setting::find($id);
            $pdfNameToStore = $old_file->pdf_path ?? null;
        }
        $certificationImagePaths = [];
        if ($request->hasFile('certification_multiple_images')) {
            foreach ($request->file('certification_multiple_images') as $image) {
                // Get file details
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                // Create directory if not exists
                $path = public_path('uploads/certifications/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                // Save the image
                $imagePath = $path . $fileNameToStore;
                Image::make($image->getRealPath())->save($imagePath);

                // Add the file name to the array
                $certificationImagePaths[] = $fileNameToStore;
            }
        }
        $achievementImagePaths = [];
        if ($request->hasFile('achievement_multiple_images')) {
            foreach ($request->file('achievement_multiple_images') as $image) {
                // Extract file details
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                // Create directory for storing achievement images
                $path = public_path('uploads/achievements/');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                // Save the image to the directory
                $imagePath = $path . $fileNameToStore;
                Image::make($image->getRealPath())->save($imagePath);

                // Add the file name to the array
                $achievementImagePaths[] = $fileNameToStore;
            }
        }

        // Save or Update Data
        if ($id == -1) {
            $data = new Setting;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->keywords = $request->keywords;
            $data->logo_path = $logoNameToStore;
            $data->favicon_path = $faviconNameToStore;
            $data->pdf_path = $pdfNameToStore;
            $data->map_path = $mapNameToStore; // Save map path
            $data->google_analytics = $request->google_analytics;
            $data->footer_text = $request->footer_text;
            $data->tag_line = $request->tag_line;

            if (!empty($certificationImagePaths)) {
                $data->certification_multiple_images = json_encode($certificationImagePaths);
            }
            if (!empty($achievementImagePaths)) {
                $data->achievement_multiple_images = json_encode($achievementImagePaths);
            }
            $data->save();
        } else {
            $data = Setting::find($id);
            $data->title = $request->title;
            $data->description = $request->description;
            $data->keywords = $request->keywords;
            $data->logo_path = $logoNameToStore;
            $data->favicon_path = $faviconNameToStore;
            $data->pdf_path = $pdfNameToStore;
            $data->map_path = $mapNameToStore; // Update map path
            $data->google_analytics = $request->google_analytics;
            $data->tag_line = $request->tag_line;
            $data->footer_text = $request->footer_text;
            if (!empty($certificationImagePaths)) {
                $data->certification_multiple_images = json_encode($certificationImagePaths);
            }
            if (!empty($achievementImagePaths)) {
                $data->achievement_multiple_images = json_encode($achievementImagePaths);
            }
            $data->save();
        }

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactInfo(Request $request)
    {
        // Field Validation
        $request->validate([
            'phone_no' => 'required|max:50',
            'phone_no2' => 'nullable|max:50',
            'email_address' => 'required',
            'email_address2' => 'nullable',
            'contact_address' => 'required',
            'contact_mail' => 'required',
        ]);

        $id = $request->id;


        // -1 means no data row found
        if ($id == -1) {
            // Insert Data
            $data = new Setting;
            $data->phone_one = $request->phone_no;
            $data->phone_two = $request->phone_no2;
            $data->email_one = $request->email_address;
            $data->email_two = $request->email_address2;
            $data->contact_address = $request->contact_address;
            $data->contact_mail = $request->contact_mail;
            $data->office_hours = $request->office_hours;
            $data->google_map = $request->google_map;
            $data->save();
        } else {
            // Update Data
            $data = Setting::find($id);
            $data->phone_one = $request->phone_no;
            $data->phone_two = $request->phone_no2;
            $data->email_one = $request->email_address;
            $data->email_two = $request->email_address2;
            $data->contact_address = $request->contact_address;
            $data->contact_mail = $request->contact_mail;
            $data->office_hours = $request->office_hours;
            $data->google_map = $request->google_map;
            $data->save();
        }


        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeMail(Request $request)
    {
        // Field Validation
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check
        if ($request->email != Auth::user()->email) {
            $user = User::find(Auth::user()->id);
            $user->email = $request->email;
            $user->save();
            Auth::logout();

            Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

            return redirect()->route('login');
        } else {
            Toastr::error(__('dashboard.email_invalid'), __('dashboard.error'));

            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePass(Request $request)
    {
        // Field Validation
        $request->validate([
            'old_password' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $oldPassword = $request->old_password;
        $hashedPassword = Auth::user()->password;

        // Check old password for validation
        if (Hash::check($oldPassword, $hashedPassword)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

            return redirect()->route('login');
        } else {
            Toastr::error(__('dashboard.password_invalid'), __('dashboard.error'));

            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function socialInfo(Request $request)
    {
        $id = $request->id;


        // -1 means no data row found
        if ($id == -1) {
            // Insert Data
            $input = $request->all();
            $data = Social::create($input);
        } else {
            // Update Data
            $data = Social::find($id);

            $input = $request->all();
            $data->update($input);
        }


        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customCode(Request $request)
    {
        $id = $request->id;


        // -1 means no data row found
        if ($id == -1) {
            // Insert Data
            $data = new Setting;
            $data->custom_css = $request->custom_css;
            $data->save();
        } else {
            // Update Data
            $data = Setting::find($id);
            $data->custom_css = $request->custom_css;
            $data->save();
        }


        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->back();
    }
}
