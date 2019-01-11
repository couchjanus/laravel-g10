<?php
    namespace App\Helpers;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Cache;

    class Online
    {
        public static function isOnline($id, $type)
        {
            switch ($type):
                case 'admin':
                    $check = Cache::has('admin-is-online-' . $id);
                    break;
                case 'user':
                    $check = Cache::has('user-is-online-' . $id);
                    break;
                default:
                    $check = false;
            endswitch;
            return $check;
        }
    }
