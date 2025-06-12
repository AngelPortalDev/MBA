<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Log,Validator,DB};
use Stripe\Webhook;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use App\Models\CourseModule;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('Invalid payload', Response::HTTP_BAD_REQUEST);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('Invalid signature', Response::HTTP_BAD_REQUEST);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                // Fulfill the purchase...
                $this->handleCheckoutSessionCompleted($session);
                break;
            // Add other event types as needed
            default:
                Log::info('Received unknown event type ' . $event->type);
        }

        return response('Webhook handled', Response::HTTP_OK);
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        // Retrieve the metadata
        $metadata = $session->metadata;
        $user_id = $metadata->user_id;

        // Here you can update your database, send a confirmation email, etc.
        // For example, mark the order as paid in your database
        Log::info('Checkout session completed for user: ' . $user_id);
    }

    public function redirectToGoogle(GoogleCalendarService $calendarService)
    {
        return redirect($calendarService->getAuthUrl());
    }

    public function handleGoogleCallback(Request $request, GoogleCalendarService $calendarService)
    {
        $calendarService->handleCallback($request->code);
        return redirect('/');
    }

   public function scheduleMeeting(Request $request, GoogleCalendarService $calendarService)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
        'endtime'=>'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'code' => 202,
            'data' => $validator->errors(),
        ]);
    }

    try {
        $start = Carbon::parse("{$request->date} {$request->time}",'Europe/Malta');
        #$end = (clone $start)->addHour();
        $end = Carbon::parse("{$request->date} {$request->endtime}",'Europe/Malta');
        $course= base64_decode($request->course_id);

        $StudentCourseMaster = DB::table('student_course_master')
        ->where('course_id',$course)
        ->leftJoin('users','users.id','=','student_course_master.user_id')
        ->pluck('users.email')   // directly get email array
        ->toArray();

        // Convert array to comma separated string
        $emailString = implode(',', $StudentCourseMaster);

        // Get mentor email
        $useremail = CourseModule::where('id', $course)->with('Ementor')->first();
        $mentorEmail = $useremail->Ementor->email ?? '';

        // Prepare attendee email list (both mentor and students)
        $attendeeEmails = $mentorEmail;
        if (!empty($emailString)) {
            $attendeeEmails .= ',' . $emailString;
        }
        // dd($useremail[0]['Ementor']['email']);
        $eventData = [
            'summary' => $request->name,
            'description' => 'Meeting scheduled via web form',
            'start' => $start,
            'end' => $end,
            'attendee_email' => $attendeeEmails,
        ];

        $meetLink = $calendarService->createGoogleMeetEvent($eventData);

        return response()->json([
            'code' => 200,
            'title' => 'Meeting Scheduled',
            'message' => 'Google Meet link created and emailed!',
            'icon' => 'success',
            'link' => $meetLink,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'code' => 500,
            'message' => 'Something went wrong: ' . $e->getMessage(),
        ]);
    }
}


}
