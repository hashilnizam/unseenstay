<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use App\Models\Property;
use App\Models\Review;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Contact;
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
            'image1' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image5' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image6' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image7' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image8' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image9' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image10' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
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

        if ($request->hasFile('image5')) {
            $image5Name = time() . '_image5.' . $request->image5->extension();
            $request->image5->move(public_path('images'), $image5Name);
            $properties->image5 = $image5Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image6')) {
            $image6Name = time() . '_image6.' . $request->image6->extension();
            $request->image6->move(public_path('images'), $image6Name);
            $properties->image6 = $image6Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image7')) {
            $image7Name = time() . '_image7.' . $request->image7->extension();
            $request->image7->move(public_path('images'), $image7Name);
            $properties->image7 = $image7Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image8')) {
            $image8Name = time() . '_image8.' . $request->image8->extension();
            $request->image8->move(public_path('images'), $image8Name);
            $properties->image8 = $image8Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image9')) {
            $image9Name = time() . '_image9.' . $request->image9->extension();
            $request->image9->move(public_path('images'), $image9Name);
            $properties->image9 = $image9Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image10')) {
            $image10Name = time() . '_image10.' . $request->image10->extension();
            $request->image10->move(public_path('images'), $image10Name);
            $properties->image10 = $image10Name;
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

    public function property_edit($id)
    {
        $Property = Property::findOrFail($id);
        $PropertyTypes = PropertyType::get();
        $RoomTypes = RoomType::get();

        return view('admin.properties.property_edit', [
            'Property' => $Property,
            'PropertyTypes' => $PropertyTypes,
            'RoomTypes' => $RoomTypes
        ]);
    }

    public function property_edit_store(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'property_type' => 'required|exists:property_types,id',
            'description' => 'required',
            'location' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'image1' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image2' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image3' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image4' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image5' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image6' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image7' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image8' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image9' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image10' => 'nullable|mimes:jpeg,png,gif|max:5120',
        ]);

        $property = Property::findOrFail($id);

        $property->name = $validatedData['name'];
        $property->property_type_id = $request->property_type;
        $property->description = $validatedData['description'];
        $property->location = $validatedData['location'];
        $property->email = $validatedData['email'];
        $property->mobile = $validatedData['mobile'];
        $property->address = $validatedData['address'];

        if ($request->hasFile('image1')) {
            $image1Name = time() . '_image1.' . $request->image1->extension();
            $request->image1->move(public_path('images'), $image1Name);
            $property->image1 = $image1Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image2')) {
            $image2Name = time() . '_image2.' . $request->image2->extension();
            $request->image2->move(public_path('images'), $image2Name);
            $property->image2 = $image2Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image3')) {
            $image3Name = time() . '_image3.' . $request->image3->extension();
            $request->image3->move(public_path('images'), $image3Name);
            $property->image3 = $image3Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image4')) {
            $image4Name = time() . '_image4.' . $request->image4->extension();
            $request->image4->move(public_path('images'), $image4Name);
            $property->image4 = $image4Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image5')) {
            $image5Name = time() . '_image5.' . $request->image5->extension();
            $request->image5->move(public_path('images'), $image5Name);
            $property->image5 = $image5Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image6')) {
            $image6Name = time() . '_image6.' . $request->image6->extension();
            $request->image6->move(public_path('images'), $image6Name);
            $property->image6 = $image6Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image7')) {
            $image7Name = time() . '_image7.' . $request->image7->extension();
            $request->image7->move(public_path('images'), $image7Name);
            $property->image7 = $image7Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image8')) {
            $image8Name = time() . '_image8.' . $request->image8->extension();
            $request->image8->move(public_path('images'), $image8Name);
            $property->image8 = $image8Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image9')) {
            $image9Name = time() . '_image9.' . $request->image9->extension();
            $request->image9->move(public_path('images'), $image9Name);
            $property->image9 = $image9Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image10')) {
            $image10Name = time() . '_image10.' . $request->image10->extension();
            $request->image10->move(public_path('images'), $image10Name);
            $property->image10 = $image10Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        $property->save();
        return redirect()->route('properties_list')->withSuccess('Property Edited Successfully');
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
            'person' => 'required|string',
            'view' => 'required|string',
            'image1' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'price' => 'required|string',
            'room_type' => 'required|exists:room_types,id',
            'property_id' => 'required|exists:properties,id'
        ]);

        $rooms = new Room();

        if ($request->hasFile('image1')) {
            $image1Name = time() . '_image1.' . $request->image1->extension();
            $request->image1->move(public_path('images'), $image1Name);
            $rooms->image1 = $image1Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image2')) {
            $image2Name = time() . '_image2.' . $request->image2->extension();
            $request->image2->move(public_path('images'), $image2Name);
            $rooms->image2 = $image2Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image3')) {
            $image3Name = time() . '_image3.' . $request->image3->extension();
            $request->image3->move(public_path('images'), $image3Name);
            $rooms->image3 = $image3Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
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

    public function room_edit($id)
    {
        $rooms = Room::findorFail($id);
        $PropertyTypes = PropertyType::get();
        $RoomTypes = RoomType::get();
        return view('admin.properties.room_edit', [
            'rooms' => $rooms,
            'PropertyTypes' => $PropertyTypes,
            'RoomTypes' => $RoomTypes
        ]);
    }

    public function room_edit_store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'person' => 'required',
            'view' => 'required',
            'price' => 'required',
            'room_type' => 'required',
            'image1' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image2' => 'nullable|mimes:jpeg,png,gif|max:5120',
            'image3' => 'nullable|mimes:jpeg,png,gif|max:5120',
        ]);

        $rooms = Room::findOrFail($id);

        $rooms->description = $validatedData['description'];
        $rooms->person = $validatedData['person'];
        $rooms->view = $validatedData['view'];
        $rooms->price = $validatedData['price'];
        $rooms->room_type_id = $validatedData['room_type'];

        if ($request->hasFile('image1')) {
            $image1Name = time() . '_image1.' . $request->image1->extension();
            $request->image1->move(public_path('images'), $image1Name);
            $rooms->image1 = $image1Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image2')) {
            $image2Name = time() . '_image2.' . $request->image2->extension();
            $request->image2->move(public_path('images'), $image2Name);
            $rooms->image2 = $image2Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        if ($request->hasFile('image3')) {
            $image3Name = time() . '_image3.' . $request->image3->extension();
            $request->image3->move(public_path('images'), $image3Name);
            $rooms->image3 = $image3Name;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        $rooms->save();
        return redirect()->route('room_list')->withSuccess('Room Edited successfully');
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

    public function blog_edit($id)
    {
        $blog = Blog::findorFail($id);
        return view('admin.dashboard.blog_edit', [
            'blog' => $blog
        ]);
    }

    public function blog_edit_store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $blog->image = $imageName;
        } else {
            // Add some debugging output
            dd('No logo file provided');
        }

        $blog->heading = $validatedData['heading'];
        $blog->description = $validatedData['description'];
        $blog->save();
        return redirect()->route('blog_form_index')->withSuccess('Blog Edited Successfully');
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

    public function contact_store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|string',
            'mobile_1' => 'required|string',
            'mobile_2' => 'required|string',
            'email' => 'required|string',
            'website' => 'required|string',
            'description' => 'required|string',
        ]);

        $contacts = new Contact();


        $contacts->address = $validatedData['address'];
        $contacts->mobile_1 = $validatedData['mobile_1'];
        $contacts->mobile_2 = $validatedData['mobile_2'];
        $contacts->email = $validatedData['email'];
        $contacts->website = $validatedData['website'];
        $contacts->description = $validatedData['description'];

        $contacts->save();

        return redirect()->route('contact_index')->with('success', 'Contact information saved successfully');
    }

    public function contact_delete($id)
    {
        $contacts = Contact::findOrFail($id);
        $contacts->delete();

        return back()->withSuccess("Contact Deleted Successfully");
    }

    public function contact_edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.dashboard.contact_edit', ['contact' => $contact]);
    }

    public function contact_edit_store(Request $request, $id)
    {

        $validatedData = $request->validate([
            'address' => 'required|string',
            'mobile_1' => 'required|string',
            'mobile_2' => 'required|string',
            'email' => 'required|string',
            'website' => 'required|string',
            'description' => 'required|string',
        ]);


        $contact = Contact::findOrFail($id);


        $contact->address = $validatedData['address'];
        $contact->mobile_1 = $validatedData['mobile_1'];
        $contact->mobile_2 = $validatedData['mobile_2'];
        $contact->email = $validatedData['email'];
        $contact->website = $validatedData['website'];
        $contact->description = $validatedData['description'];
        $contact->save();
        return redirect()->route('contact_index')->withSuccess('Contact Edited Successfully');
    }

    public function banner_store(Request $request)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string',
            'sub_heading' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',

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

    public function banner_edit($id)
    {
        $banner = Banner::findOrFail($id);

        return view('admin.dashboard.banner_edit', ['banner' => $banner]);
    }

    public function banner_edit_store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string',
            'sub_heading' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->heading = $validatedData['heading'];
        $banner->sub_heading = $validatedData['sub_heading'];

        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $banner->image = $imageName;
        } else {
            // Add some debugging output
            dd('No image file provided');
        }

        $banner->save();

        return redirect()->route('banner_index')->withSuccess('Banner Edited Successfully');
    }

    public function insta_store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
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

    public function review_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $reviews = new Review();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $reviews->image = $imageName;
        }

        $reviews->name = $validatedData['name'];
        $reviews->description = $validatedData['description'];
        $reviews->save();
        return redirect()->route('review_index')->withSuccess('Review added Successfully !');
    }

    public function review_delete($id)
    {

        $reviews = Review::findOrFail($id);
        $reviews->delete();

        return back()->withSuccess("Review Deleted Successfully");
    }

    public function review_edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.dashboard.review_edit', ['review' => $review]);
    }

    public function review_edit_store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $review = Review::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $review->image = $imageName;
        } else {
            // Add some debugging output
            dd('No Image file provided');
        }

        $review->name = $validatedData['name'];
        $review->description = $validatedData['description'];
        $review->save();
        return redirect()->route('review_index')->withSuccess('Review Edited Successfully');
    }

}


