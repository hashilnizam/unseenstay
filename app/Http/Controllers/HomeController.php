<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Instagram;
use App\Models\Property;
use App\Models\Banner;
use App\Models\PropertyType;
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
        $rooms = Room::get();
        $blogs = Blog::get();
        return view('user.index',['properties' => $properties,
            'rooms' => $rooms,
            'blogs' => $blogs,
            'instagrams' => $instagrams]);

    }

    public function contact()
    {

        return view('user.contact');
    }

    public function properties()
    {
        $properties = Property::get();
        $property_types = PropertyType::get();
        $instagrams = Instagram::get();
        $rooms = Room::get();
        $users = User::get();
        return view('user.properties',['properties' => $properties,
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
    public function user_feedback()
    {
        $user_messages = UserMessage::get();
        return view('admin.dashboard.user_massage', ['user_messages' => $user_messages]);
    }

    public function blog_single($id)
    {
        $blog = Blog::where('id', $id)->first();
        $blogs = Blog::get();
        return view('user.blog_single', ['blog' => $blog , 'blogs' => $blogs]);
    }

    public function rooms_single($propertyId)
    {
        $properties = Property::with('rooms')->find($propertyId);
        $users = User::get();
        $blogs = Blog::get();
        $instagrams = Instagram::get();
        return view('user.rooms_single', ['properties' => $properties,
            'user' => $users,
            'blogs' => $blogs,
            'instagrams' => $instagrams]);
    }
    public function rooms_book_now($id,$user_id)
    {
        $room = Room::find($id);
        $user = User::with('bookings')->find($user_id);
        return view('user.rooms_book_now', ['room' => $room,
            'user' => $user]);
    }

    public function bookings_table()
    {
        $userBookings = Booking::with('room','userOrder')
            ->get();
        return view('admin.bookings.bookings',
            ['userBookings'=> $userBookings]);
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

     public function admin_index(){

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

}

