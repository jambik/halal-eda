<?php namespace App\Http\Controllers;

use App\Addition;
use App\Contact;
use App\Drink;
use App\Garnish;
use App\Lunch;
use App\Meal1;
use App\Meal2;
use App\Salad;
use App\Sub;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Mail;
use ReCaptcha\ReCaptcha;
use Validator;

class IndexController extends Controller {

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $lunchs   = Lunch::byUser(0)->with('meal1', 'meal2', 'garnish', 'salad', 'drink', 'additions')->get();

        $meal1     = Meal1::all();
        $meal2     = Meal2::all();
        $garnishs  = Garnish::all();
        $salads    = Salad::all();
        $drinks    = Drink::all();
        $additions = Addition::all();

        $daysOfWeek = trans('vars.day_of_week');
        $subs       = Auth::user() ? Sub::with('lunch.meal1', 'lunch.meal2', 'lunch.garnish', 'lunch.salad', 'lunch.drink', 'lunch.additions')->byUser(Auth::user()->id)->get() : false;
        $user       = Auth::user() ? User::with('contact')->find(Auth::user()->id) : false;

        $lunchCount = 3;
        $menuCount  = 5;

        return view('app', compact('user', 'subs', 'lunchs', 'meal1', 'meal2', 'garnishs', 'salads', 'drinks', 'additions', 'daysOfWeek', 'lunchCount', 'menuCount'));
    }

    public function contacts(Request $request)
    {
        $user = Auth::user() ? User::find(Auth::user()->id) : false;

        if ( ! $user)
        {
            $ajaxResponse['status'] = 'error';
            $ajaxResponse['errors'] = 'Вы не авторизованы. Пройдите авторизацию снова.';
            return $ajaxResponse;
        }

        $contact = Contact::findOrNew($user->contact_id);
        $contact->fill($request->input('contact'));
        $contact->save();

        $user->update(['contact_id' => $contact->id]);

        $ajaxResponse['status'] = 'success';
        $ajaxResponse['success_text'] = 'Контактная информация сохранена';
        return $ajaxResponse;
    }

    public function feedback(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required_if:phone,""',
            'phone' => 'required_if:email,""',
            'message' => 'required',
        ];

        $messages = [
            'name.required' => 'Введите Ваше имя. Мы же должны как-то к Вам обращаться :)',
            'email.required_if' => 'А где же ваш email для обратной связи?',
            'phone.required_if' => 'Укажите пожалуйста Ваш телефончик для обратной связи',
            'message.required' => 'А где собственно сообщение?',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function($validator) use ($request)
        {
            $recaptcha = new ReCaptcha(env('GOOGLE_RECAPTCHA_SECRET'));
            $resp = $recaptcha->verify($request->get('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

            if ( ! $resp->isSuccess())
            {
                $validator->errors()->add('google_recaptcha_error', 'Ошибка reCAPTCHA: '.implode(', ', $resp->getErrorCodes()));
            }
        });

        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        Mail::queue('emails.feedback', ['input' => $request->all()], function ($message) {
            $message->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            $message->to(env('MAIL_ADDRESS'));
            $message->subject('Обратная связь');
        });

        return;
    }

    public function subscribe(Request $request)
    {
        $user = Auth::user();

        $result = Sub::subscribe($user->id, $request);

        $ajaxResponse['status'] = 'success';
        $ajaxResponse['success_text'] = 'Подписка оформлена';
        $ajaxResponse['result'] = $result;
        return $ajaxResponse;
    }

    public function unsubscribe()
    {
        $user = Auth::user();

        $result = Sub::unsubscribe($user->id);

        $ajaxResponse['status'] = 'success';
        $ajaxResponse['success_text'] = 'Подписка отменена';
        $ajaxResponse['result'] = $result;
        return $ajaxResponse;
    }

}
