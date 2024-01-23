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
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'address' => 'required|string',
            'property_type' => 'required|exists:property_types,id'
        ]);

        $properties = new property();


        if ($request->hasFile('logo')) {
            $logoName = time() . '_logo.' . $request->logo->extension();
            $request->logo->move(public_path('images'), $logoName);
            $properties->logo = $logoName;
        } else {
            // Add some debugging output
            dd('No logo file provided');
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $properties->image = $imageName;
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
    public function delete(Room $room)
    {
        abort_if(!$room, 404);

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
        $bookings->status = 1;
        $bookings->save();

        return redirect()->route('unseen.properties')->with('success', 'Booked');
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
            'image_1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $banners = new Banner();

        if ($request->hasFile('image_1')) {
            $image_1Name = time() . '_image_1.' . $request->image_1->extension();
            $request->image_1->move(public_path('images'), $image_1Name);
            $banners->image_1 = $image_1Name;
        } else {
            // Add some debugging output
            dd('No logo file provided');
        }

        if ($request->hasFile('image_2')) {
            $image_2Name = time() . '_image_2.' . $request->image_2->extension();
            $request->image_2->move(public_path('images'), $image_2Name);
            $banners->image_2 = $image_2Name;
        } else {
            // Add some debugging output
            dd('No logo file provided');
        }

        if ($request->hasFile('image_3')) {
            $image_3Name = time() . '_image_3.' . $request->image_3->extension();
            $request->image_3->move(public_path('images'), $image_3Name);
            $banners->image_3 = $image_3Name;
        } else {
            // Add some debugging output
            dd('No logo file provided');
        }

        if ($request->hasFile('image_4')) {
            $image_4Name = time() . '_image_4.' . $request->image_4->extension();
            $request->image_4->move(public_path('images'), $image_4Name);
            $banners->image_4 = $image_4Name;
        } else {
            // Add some debugging output
            dd('No logo file provided');
        }


        $banners->heading = $validatedData['heading'];
        $banners->sub_heading = $validatedData['sub_heading'];
        $banners->save();
        return redirect()->route('banner_index')->withSuccess('Banner Added Successfully');
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


