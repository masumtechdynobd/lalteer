<?php

namespace App\Http\Controllers\Web;

use Toastr;
use App\Models\Faq;
use App\Models\About;
use App\Models\Farmer;
use App\Models\Member;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\Variety;
use App\Models\ContactMap;
use App\Models\Designation;
use App\Models\Testimonial;
use App\Models\WheelSlider;
use Illuminate\Http\Request;
use App\Models\CompanyHistory;
use App\Models\ContactMessage;
use App\Models\MissionContent;
use App\Models\NewsletterPhotos;
use App\Models\NewsletterVideos;
use App\Models\WheelSliderCenter;
use App\Models\ResearchAndDevelop;

use App\Http\Controllers\Controller;
use App\Models\ContactMessageSubject;

class HomeMasumController extends Controller
{
    public function AboutUs()
    {
        $data['about'] = About::where('status', '1')
            ->first();
        $data['members'] = Member::where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['missions'] = MissionContent::orderBy('id', 'desc')
            ->get();
        return view("web.pages.about-us", $data);
    }

    public function AboutUsHistory()
    {
        $history = CompanyHistory::first();

        $data['rows'] = WheelSlider::orderBy('id', 'desc')->get();

        $data['centers'] = WheelSliderCenter::orderBy('id', 'desc')->get();
        
        return view("web.pages.aboutushistory", compact('history', 'data'));
    }

    public function CropsDetailsPage($slug)
    {
        $crops = Service::where('slug', $slug)->first();
        // $varieties = Variety::where('crop_id', $crops->id)->get();
        if ($crops) {
            $varietiesByCropId = Variety::where('crop_id', $crops->id)->get();


            $serviceIds = Service::where('category_id', $crops->category_id)->pluck('id');
            $varietiesByCategoryId = Variety::whereIn('crop_id', $serviceIds)->get();


            $varieties = $varietiesByCropId->merge($varietiesByCategoryId);
        }
        $faqs = Faq::where('service_id', $crops->id)->get();
        $services = Service::get();
        return view("web.pages.cropsdetailspage", compact('crops', 'varieties', 'faqs', 'services'));
    }

    public function ResearchAndDevelopment()
    {
        $data = ResearchAndDevelop::get();
        // dd($data);
        return view("web.pages.researchanddevelopment", compact('data'));
    }

    public function ResearchAndDevelopmentDetailspage($slug)
    {
        $data = ResearchAndDevelop::where('slug', $slug)->first();
        // dd($data);
        return view("web.pages.researchanddevelopmentdetailspage", compact('data'));
    }

    public function Farmers()
    {
        $data = Farmer::get();
        // dd($data);
        return view("web.pages.farmers", compact('data'));
    }

    public function FilterFeatures($slug)
    {
        $features = Testimonial::where('slug', $slug)->first();
        $crops = Service::where('feature_id', @$features->id)->get();
        return view("web.pages.filterfeatures", compact('crops'));
    }

    public function FarmersDetails($slug)
    {
        $data = Farmer::where('slug', $slug)->first();

        return view("web.pages.farmersdetails", compact('data'));
    }

    public function Projects(Request $request)
    {
        $status = $request->query('status');

        $query = Project::query();

        if ($status === 'ongoing') {
            $query->where('status', 'ongoing');
        } elseif ($status === 'completed') {
            $query->where('status', 'completed');
        }

        // Apply pagination here
        $data = $query->paginate(6);

        $title = match ($status) {
            'ongoing' => 'Ongoing Projects',
            'completed' => 'Completed Projects',
            default => 'All Projects',
        };

        // Pass paginated data to the view
        return view('web.pages.projects', compact('data', 'title'));
    }



    public function Gallery()
    {
        $data['rows'] = Gallery::orderBy('id', 'desc')->get();

        return view("web.pages.gallery", $data);
    }

    public function ProjectsDetails($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return view("web.pages.projectsdetails", compact('project'));
    }

    public function Newsletter()
    {
        $data['articles'] = Article::where('status', '1')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        $data['photos'] = NewsletterPhotos::orderBy('id', 'desc')->get();

        $data['videos'] = NewsletterVideos::orderBy('id', 'desc')->get();

        return view("web.pages.newsletter", $data);
    }

    public function ContactUs(Request $request)
    {
        $designationId = $request->input('designation_id'); // Get designation_id from the request

        $data['members'] = $designationId
            ? Member::where('designation_id', $designationId)->get()
            : Member::all();

        $data['designations'] = Designation::orderBy('title', 'asc')->get(); // Fetch designations dynamically
        $data['rows'] = ContactMessageSubject::orderBy('id', 'desc')->get();
        $data['contactmaps'] = ContactMap::orderBy('id', 'desc')->get();

        return view("web.pages.contactus", $data);
    }



    public function ContactUsStore(Request $request)
    {
        // Validate the incoming form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'subject' => 'required|exists:contact_message_subjects,id', // Ensure the subject exists
            'message' => 'required|string',
        ]);

        try {
            // Create a new contact message record
            $contactMessage = new ContactMessage();
            $contactMessage->name = $request->input('name');
            $contactMessage->email = $request->input('email');
            $contactMessage->phone = $request->input('phone');
            $contactMessage->subject_id = $request->input('subject');
            $contactMessage->message = $request->input('message');
            $contactMessage->save();

            // Show a success message
            Toastr::success(__('dashboard.message_sent_successfully'), __('dashboard.success'));

            // Redirect to a thank you page or back to the contact form
            return redirect()->route('contactus.thankyou'); // Or wherever you'd like to redirect after success
        } catch (\Exception $e) {
            // Handle any exceptions
            Toastr::error(__('dashboard.something_went_wrong'), __('dashboard.error'));
            return redirect()->back()->withInput();
        }
    }

}
