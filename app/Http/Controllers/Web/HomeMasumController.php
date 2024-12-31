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
use App\Models\Section;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Variety;
use App\Models\Catalogue;
use App\Models\ContactMap;
use App\Models\Designation;
use App\Models\Testimonial;
use App\Models\WheelSlider;
use Illuminate\Http\Request;
use App\Models\CompanyHistory;
use App\Models\ContactMessage;
use App\Models\GallerySection;
use App\Models\MissionContent;
use App\Models\NewsletterPhotos;
use App\Models\NewsletterVideos;
use App\Models\WheelSliderCenter;
use App\Models\ResearchAndDevelop;
use App\Http\Controllers\Controller;

use App\Models\ContactMessageSubject;
use App\Models\NewsletterDirectVideo;

class HomeMasumController extends Controller
{
    public function AboutUs()
    {
        $data['about'] = About::where('status', '1')
            ->first();

        $data['members'] = Member::where('status', '1')
            ->where('board_of_directory', 1)  // Filter members who are part of the board of directory
            ->orderBy('id', 'asc')
            ->get();

        $data['missions'] = MissionContent::orderBy('id', 'desc')
            ->get();

        $section = Section::where('slug', 'about-us')->first();
        $data['section'] = $section;

        return view("web.pages.about-us", $data);
    }

    public function AboutUsHistory()
    {
        $history = CompanyHistory::first();

        $data['centers'] = WheelSliderCenter::orderBy('id', 'desc')->get();

        $data['catalogues'] = Catalogue::orderBy('id', 'desc')->get();
        $catalogues = $data['catalogues'];

        $data['rows'] = WheelSlider::orderBy('id', 'desc')->get();

        $section = Section::where('slug', 'about-us')->first();

        return view("web.pages.aboutushistory", compact('history', 'data', 'catalogues', 'section'));
    }

    public function getSliderDetails($id)
    {
        // Fetch the WheelSlider data by ID
        $slider = WheelSlider::find($id);

        if (!$slider) {
            return response()->json(['error' => 'Slider not found'], 404);
        }

        // Return the slider data as JSON
        return response()->json([
            'photos_path' => asset($slider->photos_path), // Ensure it's the full URL
            'title' => $slider->title,
            'description' => $slider->description,
        ]);

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

        $section = Section::where('slug', 'crops')->first();
        
        return view("web.pages.cropsdetailspage", compact('crops', 'varieties', 'faqs', 'services', 'section'));
    }

    public function ResearchAndDevelopment()
    {
        $data = ResearchAndDevelop::get();

        $section = Section::where('slug', 'r&d')->first();
        // dd($data);
        return view("web.pages.researchanddevelopment", compact('data', 'section'));
    }

    public function ResearchAndDevelopmentDetailspage($slug)
    {
        $data = ResearchAndDevelop::where('slug', $slug)->first();

        $section = Section::where('slug', 'r&d')->first();
        // dd($data);
        return view("web.pages.researchanddevelopmentdetailspage", compact('data', 'section'));
    }

    public function Farmers()
    {
        $data = Farmer::get();

        $section = Section::where('slug', 'farmers')->first();
        // dd($data);
        return view("web.pages.farmers", compact('data', 'section'));
    }

    public function FilterFeatures($slug)
    {
        $features = Testimonial::where('slug', $slug)->first();
        $crops = Service::where('feature_id', @$features->id)->get();

        $section = Section::where('slug', 'farmers')->first();

        return view("web.pages.filterfeatures", compact('crops', 'section'));
    }

    public function FarmersDetails($slug)
    {
        $data = Farmer::where('slug', $slug)->first();

        $section = Section::where('slug', 'farmers')->first();

        return view("web.pages.farmersdetails", compact('data', 'section'));
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

        $section = Section::where('slug', 'projects')->first();

        // Pass paginated data to the view
        return view('web.pages.projects', compact('data', 'title', 'section'));
    }



    public function Gallery()
    {
        $data['rows'] = GallerySection::orderBy('id', 'desc')->paginate(6); // 6 items per page

        $section = Section::where('slug', 'gallery')->first();
        $data['section'] = $section;
        
        return view("web.pages.gallery", $data);
    }


    public function GalleryDetails($id)
    {
        // Fetch the specific gallery section by ID
        $gallerySection = GallerySection::findOrFail($id);

        // Decode the multiple images and videos from JSON
        $photos = json_decode($gallerySection->multiple_images, true) ?? [];
        $directvideos = json_decode($gallerySection->multiple_videos, true) ?? [];

        $section = Section::where('slug', 'projects')->first();

        // Pass the data to the view
        return view('web.pages.gallerydetails', [
            'gallerySection' => $gallerySection,
            'photos' => $photos,
            'directvideos' => $directvideos,
            'section' => $section,
        ]);
    }


    public function ProjectsDetails($slug)
    {
        $project = Project::where('slug', $slug)->first();

        $section = Section::where('slug', 'projects')->first();
        
        return view("web.pages.projectsdetails", compact('project', 'section'));
    }

    public function Newsletter(Request $request)
    {
        $data['section'] = $request->query('section', 'photos'); // Default to 'photos'

        // Paginate articles (News & Blogs)
        $data['articles'] = Article::where('status', '1')
            ->orderBy('id', 'desc')
            ->paginate(12);

        // Paginate photos
        $data['photos'] = NewsletterPhotos::orderBy('id', 'desc')
            ->paginate(12);

        // Paginate direct videos
        $data['directvideos'] = NewsletterDirectVideo::orderBy('id', 'desc')
            ->paginate(12);

        $section = Section::where('slug', 'subscribe')->first();
        $data['section'] = $section;

        // Capture the current URL (including query string)
        $data['currentUrl'] = url()->current();
        

        return view("web.pages.newsletter", $data);
    }


    public function NewsletterDetails($id)
    {
        // Fetch the article by ID
        $article = Article::where('id', $id)->where('status', '1')->firstOrFail();

        // Optionally, fetch related articles if needed
        $relatedArticles = Article::where('status', '1')
            ->where('id', '!=', $id)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        $section = Section::where('slug', 'subscribe')->first();

        
        // Pass the data to the view
        return view("web.pages.newsletterdetails", [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'section' => $section,
        ]);
    }

    public function ContactUs(Request $request)
    {
        $designationId = $request->input('designation_id'); // Get designation_id from the request

        $data['members'] = $designationId
            ? Member::where('designation_id', $designationId)->get()
            : Member::all();

        $data['rows'] = ContactMessageSubject::orderBy('id', 'desc')->get();
        $data['contactmaps'] = ContactMap::orderBy('id', 'desc')->get();
        $data['settings'] = Setting::where('status', 1)->first();
        $data['designations'] = Designation::whereIn('id', Member::where('board_of_directory', 0)->pluck('designation_id'))
            ->orderBy('title', 'asc')
            ->get();

            
        $section = Section::where('slug', 'contact_us')->first();
        $data['section'] = $section;

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
