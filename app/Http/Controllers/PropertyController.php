<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\PropertyType;
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

        return redirect()->route('properties_list')->withSuccess('Property added Successfully !');
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




}


