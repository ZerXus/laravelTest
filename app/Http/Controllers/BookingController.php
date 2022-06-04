<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function createBooking(Request $request)
    {
        $checkinDate = $request->checkinDate;
        $userID = $request->user;
        $booking = [];
        $status = 400;

        if (!empty($user)) {
            $user = User::findOrFail($userID);
            $booking->user = $user;
        }

        if (!empty($checkinDate)) {
            $booking = new Booking();
            $booking->checkinDate = $checkinDate;
            $booking->save();
            $status = 200;
        }

        return response()->json(['booking' => $booking], $status);
    }


    public function getAllBookings(Request $request)
    {
        $limit = $request->limit;
        $offset = $request->offset;
        $status = $request->status;

        return $this->getList($limit, $offset, $status);
    }

    public function getUserBookings(Request $request, User $user)
    {
        $limit = $request->limit;
        $offset = $request->offset;
        $status = $request->status;

        return $this->getList($limit, $offset, $status, $user);
    }

    public function getBooking(Booking $booking)
    {
        return ['booking' => $booking];
    }


    public function updateBooking(Request $request, Booking $booking)
    {
        $bookingUpdates = $request->booking;

        if (!empty($bookingUpdates['status'])) {
            $booking->is_confrimed = $bookingUpdates['status'];
        }
        if (!empty($bookingUpdates['checkin'])) {
            $booking->checkin_date = $bookingUpdates['checkin'];
        }
        if (!empty($bookingUpdates['user'])) {
            $booking->user_id = $bookingUpdates['user'];
        }
        $booking->save();

        return ['booking' => $booking];
    }

    public function deleteBooking(Booking $booking)
    {
        $booking->delete();

        return ['booking' => $booking];
    }


    private function getList($limit = null, $offset = null, $status = null, $user = null)
    {
        $bookings = Booking::query();
        if (!empty($limit)) {
            $bookings->limit($limit);
            if (!empty($offset)) {
                $bookings->offset($offset);
            }
        }
        if (!empty($status)) {
            $bookings->where('is_confirmed', '=', $status);
        }
        if (!empty($user)) {
            $bookings->where('user_id', '=', $user->id);
        }
        $total = Booking::query()->count();
        return [
            'booking' => $bookings->get(),
            'paginate' => [
                'total' => $total,
                'limit' => (int)$limit,
                'offset' => (int)$offset
            ]
        ];
    }
}
