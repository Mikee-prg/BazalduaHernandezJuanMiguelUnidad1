<?php

namespace App\Http\Controllers;

use App\Support\Recaptcha;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\s\-\+\(\)\.]+$/'],
            'subject' => ['required', 'in:ventas,soporte,reparacion,sugerencia,otro'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'g-recaptcha-response' => Recaptcha::rules(),
            'agree' => ['required', 'accepted'],
            'website' => ['nullable', 'prohibited'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe ser válido.',
            'phone.regex' => 'El teléfono no es válido.',
            'subject.required' => 'Debes seleccionar un asunto.',
            'subject.in' => 'El asunto seleccionado no es válido.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'message.max' => 'El mensaje no puede exceder 1000 caracteres.',
            'g-recaptcha-response.required' => 'Debes verificar que no eres un robot.',
            'agree.required' => 'Debes aceptar los términos y condiciones.',
            'agree.accepted' => 'Debes aceptar los términos y condiciones.',
            'website.prohibited' => 'La verificación humana falló. Intenta nuevamente.',
        ]);

        Recaptcha::verify($request);

        if ($this->detectSpam($validated['message'])) {
            return back()
                ->withInput()
                ->withErrors(['message' => 'Tu mensaje fue identificado como posible spam. Por favor, intenta nuevamente con un mensaje legítimo.']);
        }

        return redirect()
            ->route('contact.show')
            ->with('success', 'Gracias por contactarnos. Te responderemos pronto.');
    }

    private function detectSpam(string $message): bool
    {
        if (substr_count(strtolower($message), 'http') > 2) {
            return true;
        }

        if (preg_match('/(.)\1{9,}/', $message)) {
            return true;
        }

        if (substr_count($message, '@') > 2) {
            return true;
        }

        $spamKeywords = ['viagra', 'casino', 'lottery', 'winner', 'bitcoin', 'click here', 'free money'];
        $messageLower = strtolower($message);

        foreach ($spamKeywords as $keyword) {
            if (str_contains($messageLower, $keyword)) {
                return true;
            }
        }

        return false;
    }
}
