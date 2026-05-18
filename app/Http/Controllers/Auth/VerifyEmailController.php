<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $user = $this->resolveUserFromVerificationLink($request);

        if ($user->hasVerifiedEmail()) {
            return $this->redirectToFrontend();
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectToFrontend();
    }

    private function resolveUserFromVerificationLink(Request $request): User
    {
        $user = User::findOrFail($request->route('id'));

        $expectedHash = sha1($user->getEmailForVerification());
        $providedHash = (string) $request->route('hash');

        if (! hash_equals($expectedHash, $providedHash)) {
            abort(403, 'Invalid verification hash.');
        }

        return $user;
    }

    private function redirectToFrontend(): RedirectResponse
    {
        return redirect()->to(
            config('app.frontend_url') . '/dashboard?verified=1'
        );
    }
}
