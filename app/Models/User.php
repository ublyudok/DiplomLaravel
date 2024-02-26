<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static where(string $string, array|string|null $email)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password' => 'hashed',
    ];

    protected $table = 'users';

    public function isAdmin()
    {
        return $this->permissions == 'admin';
    }

    function testReg(Request $request, $email, $password, $name, $workplace, $telephone, $adress, $status, $vk, $telegram, $instagram, $avatar) {


        $test = DB::table('users')->select('email')->where('email', $email)->exists();

        if ($test) {
            $request->session()->flash('alreadyExists', 'Данный пользователь уже существует');

            return redirect('/register');
        } else {

            DB::table('users')->insert(
                ['email' => $email, 'password' => $password, 'name' => $name, 'workplace' => $workplace, 'telephone' => $telephone,
                    'adress' => $adress,'status' => $status, 'vk' => $vk, 'telegram' => $telegram, 'instagram' => $instagram,'avatar' => $avatar, 'updated_at' => Carbon::today()]
            );

            $request->session()->flash('forLogin', 'Успешная регистрация!');

            return redirect('/login');
        }
    }

    function register(Request $request) {

        $email = $request->post('email');

        $password = $request->post('password');

        $hashedPassword = Hash::make($password);

        $adress = "";

        $status = "Онлайн";

        $name = 'Не указано';

        $workplace = 'Не указано';

        $telephone = 'Не указан';

        $vk = 'Не указано';

        $telegram = "Не указано";

        $instagram = "Не указано";

        $image = "kot.jpg";

        $this->testReg($request, $email, $hashedPassword, $name, $workplace, $telephone, $adress, $status, $vk, $telegram, $instagram, $image);


    }

    function loginUser(Request $request) {

        if(!empty(Session::get('email'))) {
            $request->session()->flash('existsLogin', 'Вы уже вошли');
            return redirect('/login');
        }

        $email = $request->post('email');

        $password = $request->post('password');

        $permission = DB::table('users')->select('email')->where('email', $email)->where('permissions', 'admin')->exists();


        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            Auth::user()->isAdmin();

            Session::put('email', $email);

            if($permission) {
                Session::put('permission', 'admin');
            }


            return redirect('/');
        } else {
            $request->session()->flash('notValid', 'Неверный логин или пароль');
            return redirect('/login');
        }

    }

    function logout() {
        Auth::logout();
        Session::forget('email');
        Session::forget('permission');
        session_destroy();
        return redirect('/');
    }

    function deleteUser($id) {

        DB::table('users')->where('id', $id)->delete();
        Session::put('deleted', "Пользователь успешно удалён...");
        return redirect('/');
    }

    function statusEdit(Request $request, $id) {

        $status = $request->post('status');

        DB::table('users')->where('id', $id)->update(
            ['status' => $status]
        );
        Session::put('HasUpdated', 'Профиль успешно обновлён!');
        return redirect('/');
    }

    function editMail(Request $request, $id) {

        $email = $request->post('email');

        $newpass = $request->post('newpassword');


        $existsUser = DB::table('users')->select('*')->where('email', $email)->exists();

        if($existsUser) {
            Session::put('alrexistsemail', 'Данный email уже занят!');
            return redirect('/');
        } else {
            $user = User::find($id);

            $user->password = Hash::make($newpass);

            $user->save();

            DB::table('users')->where('id', $id)->update(
                ['email' => $email]
            );
            Session::put('HasUpdated', 'Профиль успешно обновлён!');
        }

        return redirect('/');

    }

    function editdate(Request $request, $id) {

        $name = $request->post('name');

        $workplace = $request->post('workplace');

        $telephone = $request->post('telephone');

        $adress =  $request->post('adress');

        DB::table('users')->where('id', $id)->update(
            ['name' => $name, 'workplace' => $workplace, 'telephone' => $telephone, 'adress' => $adress]
        );
        Session::put('HasUpdated', 'Профиль успешно обновлён!');
        return redirect('/');
    }

    function newUser(Request $request) {

        $name = $request->post('name');

        $workplace = $request->post('workplace');

        $telephone = $request->post('telephone');

        $adress =  $request->post('adress');

        $email = $request->post('email');

        $password = $request->post('password');

        $status = $request->post('status');

        $vk = $request->post('vk');

        $telegram = $request->post('telegram');

        $instagram = $request->post('instagram');

        $image = $request->file('avatar');

        $hashedPassword = Hash::make($password);

        $this->testReg($request, $email, $hashedPassword, $name, $workplace, $telephone, $adress, $status, $vk, $telegram, $instagram, $image->store('uploads'));
    }

}
