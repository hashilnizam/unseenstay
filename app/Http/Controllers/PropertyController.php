<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use App\Models\Property;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\Banner;
use App\Models\PropertyType;
use App\Models\UserMessage;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function propertiesList()
    {
        $properties = property::get();
        return view('admin.properties.index', ['properties' => $properties]);
    }

    public function propertyAdd()
    {
        $PropertyTypes = PropertyType::get();
        $RoomTypes = RoomType::get();

        return view('admin.properties.form_1', [
            'PropertyTypes' => $PropertyTypes,
            'RoomTypes' => $RoomTypes,
        ]);

    }

    public function propertyStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'address' => 'required|string',
            'property_type' => 'required|exists:property_types,id'
        ]);

        $properties = new property();


        if ($request->hasFile('image1')) {
            $image1Name = time() . '_image1.' . $request->image1->extension();
            $request->image1->move(public_path('images'), $image1Name);
            $properties->image1 = $image1Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image2')) {
            $image2Name = time() . '_image2.' . $request->image2->extension();
            $request->image2->move(public_path('images'), $image2Name);
            $properties->image2 = $image2Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image3')) {
            $image3Name = time() . '_image3.' . $request->image3->extension();
            $request->image3->move(public_path('images'), $image3Name);
            $properties->image3 = $image3Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image4')) {
            $image4Name = time() . '_image4.' . $request->image4->extension();
            $request->image4->move(public_path('images'), $image4Name);
            $properties->image4 = $image4Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }


        $properties->name = $validatedData['name'];
        $properties->description = $validatedData['description'];
        $properties->location = $validatedData['location'];
        $properties->email = $validatedData['email'];
        $properties->mobile = $validatedData['mobile'];
        $properties->address = $validatedData['address'];
        $properties->property_type_id = $request->property_type;
        $properties->status = 1;


        $properties->save();

        return redirect()->route('property_add_form_2')->withSuccess('Add Room Details!');
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return back()->withSuccess("Property Deleted Successfully");
    }

    public function delete_feedback($id)
    {
        $user_messages = UserMessage::findOrFail($id);
        $user_messages->delete();

        return back()->withSuccess("Feedback Deleted Successfully");
    }


    public function propertyAdd2()
    {
        $PropertyTypes = PropertyType::get();
        $RoomTypes = RoomType::get();
        $Properties = Property::get();// Assuming RoomType is another model or method to get room types
        return view('admin.properties.form_2', [
            'PropertyTypes' => $PropertyTypes,
            'RoomTypes' => $RoomTypes,
            'Properties' => $Properties
        ]);

    }
    public function roomStore(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'person' => 'required|int',
            'view' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|string',
            'room_type' => 'required|exists:room_types,id',
            'property_id' => 'required|exists:properties,id'
        ]);

        $rooms = new Room();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $rooms->image = $imageName;
        }

        $rooms->description = $validatedData['description'];
        $rooms->person = $validatedData['person'];
        $rooms->view = $validatedData['view'];
        $rooms->price = $validatedData['price'];
        $rooms->room_type_id = $request->room_type;
        $rooms->status = 1;
        $rooms->property_id = $validatedData['property_id'];


        $rooms->save();

        return redirect()->route('properties_list')->withSuccess('Added Successfully !');
    }

    public function room_delete($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return back()->withSuccess("Room Deleted Successfully");
    }

    public function roomList()
    {
        $rooms = room::get();

        return view('admin.properties.room_index', ['rooms' => $rooms]);
    }


    public function reservation(Request $request)
    {
//        dd("bkabd");
        $min = 1000000;
        $max = 9999999;

        $order_id = random_int($min, $max);

        $validatedData = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        $bookings = new Booking();

        $bookings->check_in = $validatedData['check_in'];
        $bookings->room_id = $request->room_id;
        $bookings->user_id = $request->user_id;
        $bookings->order_id = $order_id;
        $bookings->check_out = $validatedData['check_out'];
        $bookings->price = $request->price;
        $bookings->status = 1;
        $bookings->save();

    }

    public function roomAdd()
    {
        $PropertyTypes = PropertyType::get();
        $RoomTypes = RoomType::get();
        $Properties = Property::get();
        return view('admin.properties.room_add', [
            'PropertyTypes' => $PropertyTypes,
            'RoomTypes' => $RoomTypes,
            'Properties' => $Properties
        ]);

    }

    public function user_messages(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $user_messages = new UserMessage();
        $user_messages->name = $validatedData['name'];
        $user_messages->email = $validatedData['email'];
        $user_messages->subject = $validatedData['subject'];
        $user_messages->message = $validatedData['message'];


        $user_messages->save();

        return redirect()->route('unseen.contact')->withSuccess('Thank you for your feedback !');
    }

    public function banner_store(Request $request)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string',
            'sub_heading' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $banners = new Banner();

        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $banners->image = $imageName;
        } else {
            // Add some debugging output
            dd('No logo file provided');
        }


        $banners->heading = $validatedData['heading'];
        $banners->sub_heading = $validatedData['sub_heading'];
        $banners->save();
        return redirect()->route('banner_index')->withSuccess('Banner Added Successfully');
    }

    public function banner_delete($id)
    {
        $banners = Banner::findOrFail($id);
        $banners->delete();

        return back()->withSuccess("Banner Deleted Successfully");
    }


    public function insta_store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $instagrams = new Instagram();

        if ($request->hasFile('image')) {
            $imageName = time() . 'image.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $instagrams->image = $imageName;
        }

        $instagrams->save();
        return redirect()->route('insta_index')->withSuccess('Insta Image Added Successfully');
    }

    public function instagram_delete($id)
    {

        $instagrams = Instagram::findOrFail($id);
        $instagrams->delete();

        return back()->withSuccess("Instagram Image Deleted Successfully");
    }

}


