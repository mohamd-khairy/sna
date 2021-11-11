<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\helpers;
use App\Models\HomePageSlider;
use App\Models\Snippet;
use App\Models\Founder;
use App\Models\ComingSoon;
use App\Models\ContentPage;
use App\Models\ContentCategory;
use App\Models\Enquiry;


use App\Http\Requests\StoreEnquiryRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $HomePageSliders = HomePageSlider::get();
        $Founders = Founder::get();
        $ComingSoons = ComingSoon::get();
        $ContentCategory = ContentCategory::get();
        $homepage_egyptology_dr_zahi_snippet1 = Snippet::where('slug', '=', 'homepage_egyptology_dr_zahi_snippet1')->first();
        $homepage_egyptology_dr_zahi_snippet2 = Snippet::where('slug', '=', 'homepage_egyptology_dr_zahi_snippet2')->first();
        $homepage_idu_vision = Snippet::where('slug', '=', 'homepage_idu_vision')->first();
        $homepage_iduni_video = Snippet::where('slug', '=', 'homepage_iduni_video')->first();
        $homepage_iduni_strategies = Snippet::where('slug', '=', 'homepage_iduni_strategies')->first();
        $new_lecture_join = Snippet::where('slug', '=', 'new_lecture_join')->first();

        return view('frontend.homepage')
                ->with('HomePageSliders',$HomePageSliders)
                ->with('homepage_egyptology_dr_zahi_snippet1',$homepage_egyptology_dr_zahi_snippet1)
                ->with('homepage_egyptology_dr_zahi_snippet2',$homepage_egyptology_dr_zahi_snippet2)
                ->with('homepage_idu_vision',$homepage_idu_vision)
                ->with('homepage_iduni_video',$homepage_iduni_video)
                ->with('homepage_iduni_strategies',$homepage_iduni_strategies)
                ->with('new_lecture_join',$new_lecture_join)
                ->with('Founders',$Founders)
                ->with('ComingSoons',$ComingSoons)
                ->with('ContentCategory',$ContentCategory)
                ;
    }
    public function pageContent($slug)
    {
        switch ($slug) {
            case 'IDU-Programs':
                $page_id = 1;
                break;
            case 'BioandHealthInformatics-Prog':
                $page_id = 2;
                break;
            case 'Egyptology-Prog':
                $page_id = 3;
                break;
            case 'LegalInformatics':
                $page_id = 4;
                break;
            case 'AcademicCalendar':
                $page_id = 5;
                break;
            case 'About-Us':
                $page_id = 6;
                break;
            case 'Jobs':
                $page_id = 7;
                break;
            case 'IDU-Brochure':
                $page_id = 8;
                break;
            case 'Cinema':
                $page_id = 9;
                break;
            case 'Radio':
                $page_id = 10;
                break;
            case 'Partners':
                $page_id = 11;
                break;

            default:
                $page_id = 1;
                break;
        }
        $page_content = ContentPage::where('id', '=', $page_id)->first();
        $ContentCategory = ContentCategory::get();
        return view('frontend.pageContent')->with('slug', $slug)
            ->with('page_content', $page_content)
            ->with('ContentCategory', $ContentCategory);
    }
    public function contactUs()
    {
        $ContentCategory = ContentCategory::get();
        return view('frontend.contactUs')->with('ContentCategory', $ContentCategory);
    }
    public function joinUs()
    {
        $ContentCategory = ContentCategory::get();
        return view('frontend.joinUs')->with('ContentCategory', $ContentCategory);
    }
    public function enquiry_create(StoreEnquiryRequest $request)
    {
        $all_request = $request->all();

        $secretKey = "6LenjiEbAAAAAKxtYgQIxZpGtp9iw_ZuO2nWc6rR";
        $captcha = $all_request['g-recaptcha-response'];
        $url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $responseKeys = json_decode($output,true);
        if($responseKeys['success']==1){
            $details = [
                'name' => $all_request['name'],
                'email' => $all_request['email'],
                'comment' => $all_request['message']
            ];
            // \Mail::to('eng.karimgamal90@gmail.com')->send(new \App\Mail\ContactMail($details));
            \Mail::to('contact@iduni.net')->send(new \App\Mail\ContactMail($details));
        }else{
            return redirect()->route('contactUs')->withFail('Captcha error. Pls re-submit the page again.');
        }

        $enquiry = Enquiry::create($request->all());
        return redirect()->route('contactUs')->withSuccess('Your data has been sent successfully. We will contact you shortly.');
        // return Redirect::to("/")->withFail('Error message');
        
    }
    public function join_create(StoreEnquiryRequest $request)
    {
        $all_request = $request->all();

        if(empty($all_request['message'])){
            $all_request['message'] = "-";
        }
        if(empty($all_request['mobile'])){
            $all_request['mobile'] = "-";
        }
        $secretKey = "6LenjiEbAAAAAKxtYgQIxZpGtp9iw_ZuO2nWc6rR";
        $captcha = $all_request['g-recaptcha-response'];
        $url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $responseKeys = json_decode($output,true);
        if($responseKeys['success']==1){
            $details = [
                'name' => $all_request['name'],
                'email' => $all_request['email'],
                'mobile' => $all_request['mobile'],
                'comment' => $all_request['message']
            ];
            \Mail::to($all_request['email'])->send(new \App\Mail\JoinMail($details));
            // \Mail::to('eng.karimgamal90@gmail.com')->send(new \App\Mail\ContactMail($details));
            // \Mail::to('contact@iduni.net')->send(new \App\Mail\ContactMail($details));
        }else{
            return redirect()->route('joinUs')->withFail('Captcha error. Pls re-submit the page again.');
        }
        if(!empty($all_request['programmes'])){
            $all_request['programmes'] = implode(",", $all_request['programmes']);
        }
        // $enquiry = Enquiry::create($request->all());
        $enquiry = Enquiry::create($all_request);
        return redirect()->route('joinUs')->withSuccess('Your data has been sent successfully. We will contact you shortly.');
        // return Redirect::to("/")->withFail('Error message');
        
    }
}
