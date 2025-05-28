<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Response;

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
}