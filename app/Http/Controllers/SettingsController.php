<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Models\Admin\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;

class SettingsController extends Controller {
    public $successStatus = 200;
    public $unAuthorizedStatus = 401;
    public $unprocessableStatus = 422;

    // Start Here
    public function testTbl(Request $request) {
        echo $request->user()->id;
        return Settings::all();
    }

    public function add_setting(Request $request) {
        $rules = [
            'setting_primary_color' => 'required',
            'setting_secondary_color' => 'required',
            'setting_text_color' => 'required',
            'setting_text_bg_color' => 'required',
            'setting_background' => 'required',
            'setting_font' => 'required',
            'setting_language' => 'required'
        ];
        $customMessages = [
            'setting_primary_color.required' => 'Primary Color is required!',
            'setting_secondary_color.required' => 'Secondary Color is required!',
            'setting_text_color.required' => 'Text Color is required!',
            'setting_text_bg_color.required' => 'Text Color on Background is required!',
            'setting_background.required' => 'Background Color is required!',
            'setting_font.required' => 'Font is required!',
            'setting_language.required' => 'Please select language!'
        ];
        $this->validate($request, $rules, $customMessages);
        $setting = Settings::add_setting($request);
        if ($setting) {
            return response()->json([
                'error' => false,
                'setting' => 'Successfully Added'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }
    }
    public function get_setting(Request $request) {
        $setting = Settings::get_setting($request);
        if ($setting) {
            return response()->json(['error' => false, 'setting' => $setting]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function get_site_settings(Request $request) {
        $setting = Settings::get_site_settings($request);
        if ($setting) {
            return response()->json(['error' => false, 'setting' => $setting]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }
    }
    public function add_location(Request $request) {
        $validatedData = $request->validate([
            'location_name' => 'required',
            'location_number_of_target' => 'required|numeric',
            'location_price_each_position' => 'required|numeric',
            'location_total_position' => 'required|numeric',
            'location_tax' => 'required|numeric'
        ]);

        $Location = Locations::add_location($request);
        $LocationDays = LocationDays::add_locationday($request, $Location);

        if ($Location && $LocationDays) {
            return response()->json([
                'error' => false,
                'setting' => 'Successfully Added'
            ]);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong'], $this->unprocessableStatus);
        }
    }

    public function get_days() {
        $Days = Days::get_days();
        if ($Days) {
            return response()->json(['error' => false, 'days' => $Days]);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong'], $this->unprocessableStatus);
        }
    }

    public function get_locations() {
        $branches = Locations::get_locations();
        $total_locations = sizeof($branches);

        if ($branches !== '') {
            return response()->json([
                'error' => false,
                'locations' => $branches,
                'total_locations' => $total_locations
            ]);
        }
    }

    public function get_site_locations(Request $request) {
        $Locations = Locations::get_site_locations($request);
        if ($Locations !== '') {
            return response()->json([
                'error' => false,
                'locations' => $Locations
            ]);
        }
    }

    public function get_locations_site(Request $request) {
        $Locations = Locations::get_locations_site($request);
        if ($Locations !== '') {
            return response()->json([
                'error' => false,
                'locations' => $Locations
            ]);
        }
    }

    public function get_location_data(Request $request, $location_id) {
        $date = $request->date;
        list($Location, $LocationTimes, $total_bookings, $Days) = Locations::get_location_data($request, $location_id, $date);
        $DaysClose = Days::get_days_Location($location_id);
        $SpecialDays = EventDays::getEventDays($request, $location_id, $date);
        if ($Location != '' && $LocationTimes != '') {
            return response()->json([
                'error' => false,
                'location' => $Location,
                'locationtimes' => $LocationTimes,
                'total_bookings' => $total_bookings,
                'DaysClose' => $DaysClose,
                'Days' => $Days,
                'holidays' => $SpecialDays
            ]);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong'], $this->unprocessableStatus);
        }
    }

    public function get_days_Location($location_id) {
        list($Days, $DaysClose) = Days::get_days_Location($location_id);
        if ($Days && $DaysClose) {
            return response()->json([
                'error' => false,
                'days' => $Days,
                'daysClose' => $DaysClose
            ]);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong'], $this->unprocessableStatus);
        }
    }

    public function update_location(Request $request, $location_id) {
        $validatedData = $request->validate([
            'location_name' => 'required',
            'location_address' => 'required',
            'country' => 'required',
            'location_number_of_target' => 'required|numeric',
            'price_of_target' => 'required|numeric',
            'no_of_positions' => 'required|numeric',
            'sales_tax' => 'required|numeric'
        ]);
        $Location = Locations::update_location($request, $location_id);
        $LocationDays = LocationDays::update_locationday($request, $location_id);
        if ($Location) {
            return response()->json([
                'error' => false,
                'message' => 'Successfully Updated'
            ]);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong'], $this->unprocessableStatus);
        }
    }

    public function view_locations() {
        $site_id = Auth::user()->site_id;
        $locations = Locations::where('location_fk_site_id', $site_id)->get();
        if ($locations) {
            return response()->json([
                'error' => false,
                'locations' => $locations
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function get_language(Request $request) {
        $user = $request->user();

        return response()->json([
            'error' => false,
            'message' => 'Un authenticated'
        ]);
        // $user->assignRole('COMAN');
        // $user->syncRoles(['COMAN', 'SUP']);
        // $roles = $user->getRoleNames();

        $permission = $user->getPermissionsViaRoles();

        return response()->json($permission, 200);
        // return response()->json($roles, 200);
        // print_r($roles);
        exit();

        $local = Settings::select('setting_language')->first();
        if ($local) {
            $setting_language = $local->setting_language;
        } else {
            $setting_language = 'en';
        }
        App::setlocale($setting_language);
        $dashboard = Lang::get('dashboard');
        $targets = Lang::get('targets');
        $bookings = Lang::get('bookings');
        $finance = Lang::get('finance');
        $notifications = Lang::get('notifications');
        $settings = Lang::get('settings');
        $add_customer_popup = Lang::get('add_customer_popup');
        $manage_booking = Lang::get('manage_booking');

        $languages = [
            'dashboard' => $dashboard,
            'targets' => $targets,
            'bookings' => $bookings,
            'finance' => $finance,
            'notifications' => $notifications,
            'settings' => $settings,
            'add_customer_popup' => $add_customer_popup,
            'manage_booking' => $manage_booking
        ];
        return response()->json(['error' => false, 'language' => $languages]);
    }
    public function get_location_data_site(Request $request, $location_id) {
        $date = $request->date;
        list($Location, $LocationTimes, $total_bookings, $Days) = Locations::get_location_data_site($request, $location_id, $date);
        $DaysClose = Days::get_days_Location($location_id);
        $SpecialDays = EventDays::getEventDaysSite($request, $location_id, $date);
        if ($Location != '' && $LocationTimes != '') {
            return response()->json([
                'error' => false,
                'location' => $Location,
                'locationtimes' => $LocationTimes,
                'total_bookings' => $total_bookings,
                'DaysClose' => $DaysClose,
                'Days' => $Days,
                'holidays' => $SpecialDays
            ]);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong'], $this->unprocessableStatus);
        }
    }
    public function site_configuration(Request $request) {
        $rules = [
            'setting_company_name' => 'required',
            'setting_service_name' => 'required',
            'setting_employee_first_name' => 'required',
            'setting_employee_last_name' => 'required',
            'setting_company_email' => 'required|email',
            'setting_company_phone' => 'required',
            'setting_mail_host' => 'required',
            'setting_mail_username' => 'required|email',
            'setting_mail_password' => 'required',
            'setting_mail_encryption' => 'required'
        ];
        $customMessages = [
            'setting_company_name.required' => 'Company name is required!',
            'setting_service_name.required' => 'Service name is required!',
            'setting_employee_first_name.required' => 'First name is required!',
            'setting_employee_last_name.required' => 'Last name on Background is required!',
            'setting_company_email.required' => 'Email is required!',
            'setting_company_email.email' => 'Invalid email!',
            'setting_company_phone.required' => 'Phone number is required!',
            'setting_mail_host.required' => 'SMTP Mail Host is required',
            'setting_mail_username.required' => 'SMTP Mail Username is required',
            'setting_mail_username.email' => 'Invalid SMTP Mail !',
            'setting_mail_password.required' => 'SMTP Mail password is required',
            'setting_mail_encryption.required' => 'SMTP Mail Encryption is required'
        ];

        $this->validate($request, $rules, $customMessages);
        $setting = Settings::site_configuration($request);
        if ($setting) {
            return response()->json([
                'error' => false,
                'setting' => 'Successfully Added'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }
    }
    public function delete_location(Request $request, $location_id) {
        $site_id = Auth::user()->site_id;
        $total_locations = Locations::where('location_fk_site_id', $site_id)->count();
        if ($total_locations > 1) {
            $delete_location = Locations::delete_location($request, $location_id);
            $DaysClose = LocationDays::delete_location_days($location_id);
            $SpecialDays = EventDays::delete_location_events($location_id);
            $delete_booking_by_location = Booking::delete_booking_by_location($location_id);
            if ($delete_location && $DaysClose) {
                return response()->json([
                    'error' => false,
                    'message' => 'Deleted Successfully'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Something went wrong'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Can not delete last location'
            ]);
        }
    }
}
