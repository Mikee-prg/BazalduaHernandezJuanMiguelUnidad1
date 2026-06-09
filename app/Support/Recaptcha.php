<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class Recaptcha
{
    public static function rules(): array
    {
        if (app()->environment('testing')) {
            return ['nullable'];
        }

        return config('services.recaptcha.secret_key') ? ['required'] : ['nullable'];
    }

    public static function messages(): array
    {
        return [
            'g-recaptcha-response.required' => 'Debes verificar que no eres un robot.',
        ];
    }

    public static function verify(Request $request): void
    {
        if (app()->environment('testing')) {
            return;
        }

        if (!config('services.recaptcha.secret_key')) {
            return;
        }

        $response = Http::asForm()
            ->timeout(5)
            ->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

        $data = $response->json();

        if (!$response->ok() || !($data['success'] ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'La verificación reCAPTCHA falló. Por favor, intenta nuevamente.',
            ]);
        }
    }
}
