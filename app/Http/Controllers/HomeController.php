<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Booking;
use App\Models\Instagram;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\PropertyType;
use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use App\Models\UserMessage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::get();
        $instagrams = Instagram::get();
        $banners = Banner::get();
        $rooms = Room::get();
        $blogs = Blog::get();
        $contacts = Contact::get();
        $reviews = Review::get();
        return view('user.index', ['properties' => $properties,
            'rooms' => $rooms,
            'blogs' => $blogs,
            'instagrams' => $instagrams,
            'banners' => $banners,
            'contacts' => $contacts,
            'reviews' => $reviews]);

    }

    public function contact()
    {
        $contacts = Contact::get();
        return view('user.contact',
            ['contacts' => $contacts]);
    }

    public function properties()
    {
        $properties = Property::get();
        $property_types = PropertyType::get();
        $instagrams = Instagram::get();
        $rooms = Room::get();
        $users = User::get();
        return view('user.properties', ['properties' => $properties,
            'rooms' => $rooms,
            'instagrams' => $instagrams]);
    }

    public function about()
    {
        $instagrams = Instagram::get();
        return view('user.about',
            ['instagrams' => $instagrams]);
    }

    public function blog()
    {
        $blogs = Blog::get();
        return view('user.blog', ['blogs' => $blogs]);
    }

    public function review_form()
    {
        return view('admin.dashboard.review_form');
    }

    public function review_index()
    {
        $reviews = Review::get();
        return view('admin.dashboard.review_index',
            ['reviews' => $reviews]);
    }

    public function banner()
    {
        return view('admin.dashboard.banner_form');
    }

    public function banner_index()
    {
        $banners = Banner::get();
        return view('admin.dashboard.banner_index', ['banners' => $banners]);
    }

    public function insta_image()
    {
        return view('admin.dashboard.instagram_image_form');
    }

    public function insta_index()
    {
        $instagrams = Instagram::get();
        return view('admin.dashboard.instagram_image_index', ['instagrams' => $instagrams]);
    }

    public function contact_index()
    {
        $contacts = Contact::get();
        return view('admin.dashboard.contact_index', ['contacts' => $contacts]);
    }

    public function contact_form()
    {
        return view('admin.dashboard.contact_form');
    }

    public function user_feedback()
    {
        $user_messages = UserMessage::get();
        return view('admin.dashboard.user_massage', ['user_messages' => $user_messages]);
    }

    public function blog_single($id)
    {
        $blog = Blog::where('id', $id)->first();
        $blogs = Blog::get();
        return view('user.blog_single', ['blog' => $blog, 'blogs' => $blogs]);
    }

    public function rooms_single($propertyId)
    {
        $properties = Property::with('rooms')->find($propertyId);
        $blogs = Blog::get();
        $instagrams = Instagram::get();
        return view('user.rooms_single', ['properties' => $properties,
            'blogs' => $blogs,
            'instagrams' => $instagrams]);
    }

    public function rooms_book_now($id)
    {
        $room = Room::find($id);
        return view('user.rooms_book_now', ['room' => $room]);
    }

    public function bookings_table()
    {

        return view('admin.bookings.bookings');
    }


    public function login_page()
    {
        return view('user.userlogin');
    }

    //admin side

    public function Admin_Dashboard()
    {

        return view('admin.dashboard.index');

    }

    public function admin_index()
    {

        return view('admin.dashboard.login');
    }

    //user datatable

    public function showUser()
    {
        $users = User::get();
        return view('admin.dashboard.userDatatable', ['users' => $users]);
    }

    public function tableUserAdd()
    {
        return view('admin.useradd.user_login_form');
    }

    public function user_payment_index()
    {
        $payments = Payment::get();
        $userBookings = Booking::with('room', 'userOrder')
            ->get();
        return view('admin.dashboard.payment_index', ['payments' => $payments, 'userBookings' => $userBookings]);
    }


}

