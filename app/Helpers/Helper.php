<?php

namespace App\Helpers;

use App\Contracts\Repositories\WebAppRepository;
use App\Models\Broadcast;
use App\Services\S3ServiceAWS;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class Helper
{
    public static function RETURN_SUCCESS_FORMAT($statusCode, $message, $data = [], $extraData = []): array
    {
        return [
            'status' => $statusCode,
            'success' => true,
            'message' => $message,
            'data' => $data,
            'extra_data' => $extraData
        ];
    }


    public static function RETURN_ERROR_FORMAT($status_code, $message = "Something is wrong !!", $data = []): array
    {
        return [
            'success' => false,
            'message' => $message,
            'status' => $status_code,
            'data' => $data
        ];
    }

    public static function RETURN_HTML_FORMAT($status_code, $html, $data = []): array
    {
        return [
            'success' => true,
            'html' => $html,
            'status' => $status_code,
            'data' => $data
        ];
    }


    public static function randomNumber($min, $max): int
    {
        return rand($min, $max);
    }

    public static function randomString($length = 10): string
    {
        return Str::random($length);
    }

    public static function personalizedReplace(string $message, Request $request): array|string
    {
        $message = str_replace('[[first_name]]', $request['first_name'] ? $request['first_name'] : '', $message);
        $message = str_replace('[[last_name]]', $request['last_name'] ? $request['last_name'] : '', $message);
        $message = str_replace('[[name]]', $request['first_name'] ? $request['first_name'] : '', $message);
        $message = str_replace('[[email]]', $request['email'] ? $request['email'] : '', $message);
        $message = str_replace('[[password]]', $request['password_personalize'] ? $request['password_personalize'] : '', $message);
        return str_replace('[[url]]', $request['url'] ? $request['url'] : '', $message);
    }

    public static function isValidDomain($domain): bool
    {
        return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain) //valid chars check
            && preg_match("/^.{1,253}$/", $domain) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain)); //length of each label
    }


    /**
     * Takes in "token ABCDEFG" and returns "ABCDEFG"
     * @param $request
     * @return string|null
     */
    public static function parseAuthorizationHeader($request): ?string
    {
        $authorizationHeader = $request->headers->get('Authorization');

        if ($authorizationHeader != null && $authorizationHeader != "") {
            $tokenString = explode(' ', $authorizationHeader);
            return $tokenString[1];
        }

        return null;
    }


    /**
     * @param int $length
     * @return string
     */
    public static function generateNumber(int $length = 6): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomString($length = 10, $pass = false)
    {
        $characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        if ($pass) {
            return $randomString;
        }
        return $randomString . time();
    }


    /**
     * Get Ip Address
     * @return array|false|mixed|string
     */
    public static function getIpAddress()

        //

    {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                return $_SERVER["HTTP_X_FORWARDED_FOR"];

            if (isset($_SERVER["HTTP_CLIENT_IP"]))
                return $_SERVER["HTTP_CLIENT_IP"];

            return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        }

        if (getenv('HTTP_X_FORWARDED_FOR'))
            return getenv('HTTP_X_FORWARDED_FOR');

        if (getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');

        return getenv('REMOTE_ADDR');
    }


    /**
     * @param $image_path
     * @return string
     */
    public static function getImageType($image_path): string
    {
        Log::info('get_image_type');
        $extension = array(
            IMAGETYPE_GIF => "gif",
            IMAGETYPE_JPEG => "jpeg",
            IMAGETYPE_PNG => "png",
            IMAGETYPE_SWF => "swf",
            IMAGETYPE_PSD => "psd",
            IMAGETYPE_BMP => "bmp",
            IMAGETYPE_TIFF_II => "tiff",
            IMAGETYPE_TIFF_MM => "tiff",
            IMAGETYPE_JPC => "jpc",
            IMAGETYPE_JP2 => "jp2",
            IMAGETYPE_JPX => "jpx",
            IMAGETYPE_JB2 => "jb2",
            IMAGETYPE_SWC => "swc",
            IMAGETYPE_IFF => "iff",
            IMAGETYPE_WBMP => "wbmp",
            IMAGETYPE_XBM => "xbm",
            IMAGETYPE_ICO => "ico"
        );

        return $extension[exif_imagetype($image_path)];
    }


    public static function getCustomFileName($file): string
    {
        return self::generateRandomString(6) . time() . '.' . $file->getClientOriginalExtension();

    }


    public static function DATE_FORMATE_OVERALL_STATE()
    {
        return date('Y-m-d');
    }


    public static function image_resize($target, $image, $w, $h, $ext)
    {
        list($w_orginal, $h_orginal) = getimagesize($target);
        $scale_ratio = $w_orginal / $h_orginal;
        if ($ext == 'png' || $ext == 'PNG') {
            $img = imagecreatefrompng($target);
        } else if ($ext == 'jpeg' || $ext == 'JPEG') {
            $img = imagecreatefromjpeg($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }

        $tci = imagecreatetruecolor($w, $h);
        //Below two lines are used for making image background transparent
        $white = imagecolorallocate($tci, 255, 255, 255);
        imagefill($tci, 0, 0, $white);
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orginal, $h_orginal);
        imagejpeg($tci, $image, 80);
        chmod($image, 0777);
        return true;
    }

    public static function image_resizeFromFilePath($target, $image, $w, $h, $ext)
    {
        list($w_orginal, $h_orginal) = getimagesize($target);
        $scale_ratio = $w_orginal / $h_orginal;
        if ($ext == 'png' || $ext == 'PNG') {
            $img = imagecreatefrompng($target);
        } else if ($ext == 'jpeg' || $ext == 'JPEG') {
            $img = imagecreatefromjpeg($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }

        $tci = imagecreatetruecolor($w, $h);
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orginal, $h_orginal);
        imagejpeg($tci, $image, 80);
        chmod($image, 0777);
        return true;
    }


    /**
     * @param $data
     * @param string $badge
     * @return string
     */
    public static function span_not_applicable($data, string $badge = 'badge-light-primary'): string
    {
        if (is_null($data)) {
            return '<span class="badge rounded-pill  badge-light-danger">N/A</span>';
        }

        return '<span class="badge rounded-pill ' . $badge . '">' . $data . '</span>';
    }

    /**
     * @param $data
     * @return string
     */
    public static function delivery_status($data): string
    {

        if (Broadcast::DELIVERY_STATUS_PENDING == $data) {
            return '<span class="badge rounded-pill  badge-light-warning">PENDING</span>';
        }elseif (Broadcast::DELIVERY_STATUS_RUNNING == $data) {
            return '<span class="badge rounded-pill  badge-light-primary">RUNNING</span>';

        }elseif (Broadcast::DELIVERY_STATUS_SEND == $data) {
            return '<span class="badge rounded-pill  badge-light-info">SEND</span>';
        }elseif (Broadcast::DELIVERY_STATUS_DELIVERED == $data) {
            return '<span class="badge rounded-pill  badge-light-success">DELIVERED</span>';
        }else{
            return '<span class="badge rounded-pill  badge-light-danger">FAILED</span>';
        }

        return '<span class="badge rounded-pill  badge-light-danger">N/A</span>';

    }

    /**
     * @param $data
     * @return string
     */
    public static function date_format_for_date($data, $format = 'Y-m-d'): string
    {
        return Carbon::parse($data)->format($format);
    }

    /**
     * @param $name
     * @param array $data
     * @return string
     */
    public static function data_table_basic_action($name, array $data = []): string
    {
        /**
         *
         * [
         *  [
         *   'name' => '',
         *   'class' => '',
         *   'id' => '',
         *   'data_id' => '',
         *   'icon' => '',
         *  ]
         * ];
         */

        $listOfData = '';

        foreach ($data as $lists) {
            foreach ($lists as $list) {
                $listOfData .= '<a href="javascript:void(0)" class="btn btn-sm dropdown-item ' . $list['class'] . '" id="' . $list['id'] . '" data-id = "' . $list['data_id'] . '"> ' . $list['name'] . '  </a>';
            }
        }

        return '<div class="btn-group">
                    <a href="" class="btn btn-sm btn-primary dropdown-toggle hide-arrow" data-toggle="dropdown">
                        <span class="">
                            <i class="fa fa-cog" ></i>
                        </span>' . $name . '
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        ' . $listOfData . '
                    </div>
               </div>';

    }

    /**
     * @param $name
     * @param array $data
     * @return string
     */
    public static function data_table_basic_action_three_dot( array $data = []): string
    {
        /**
         *
         * [
         *  [
         *   'name' => '',
         *   'class' => '',
         *   'id' => '',
         *   'data_id' => '',
         *   'icon' => '',
         *  ]
         * ];
         */

        $listOfData = '';

        foreach ($data as $lists) {
            foreach ($lists as $list) {
                $listOfData .= '<a href="javascript:void(0)" class="btn btn-sm dropdown-item ' . $list['class'] . '" id="' . $list['id'] . '" data-id = "' . $list['data_id'] . '"> ' . $list['name'] . '  </a>';
            }
        }

        return '<div class="btn-group">
                    <a href="" class="dropdown-toggle hide-arrow" data-toggle="dropdown">
                        <span class="">
                            <i data-feather="more-vertical"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        ' . $listOfData . '
                    </div>
               </div>';

    }

    public static function Upload($file, $fileName, $customPath): array
    {
        $s3Service = new S3ServiceAWS();

        $response = $s3Service->setCustomUrl($customPath)->uploadFileToS3($file, $fileName);

        return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'File successfully upload', $response);

    }

    /**
     * @param $appId
     * @return string
     */
    public static function code_one_signal($appId): string
    {
        return '<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
                    <script>
                      window.OneSignal = window.OneSignal || [];
                      OneSignal.push(function() {
                        OneSignal.init({
                          appId: "'. $appId .'",
                          notifyButton: {
                            enable: true,
                          },
                        });
                      });
                    </script>';

    }

    /**
     * Get rest api key from specific app
     * @param $where
     * @param $select
     * @return mixed
     */
    public static function getAppInfo($where, $select)
    {
        return App::make(WebAppRepository::class)->getSpecificAppData($where, $select);
    }

    public static function getAppList()
    {
        return App::make(WebAppRepository::class)->getAllData(
            ['user_id'=> Auth::id()] ,
            ['app_id','app_name']
        );
    }

    public static function preparedPagination(
        $limit, $active_list, $total_list, $select_structure = 7,
        $click_class = 'conversation-pagination-list', $active_class_custom = 'active',
        $extra_classes_in_nav = '', $extra_classes_in_ul = '', $extra_classes_in_li = '', $extra_classes_in_a = '',
        $remove_nav = false)
    {
        //total list is for total count
        //total selected structure = 3,5,7
        //click class for each click on li
        //active class custom for change the design of active li
        // remove nav for show or hide nav tag
        $pagination = '';

        if ($total_list / $limit > 1) {
            if ($remove_nav == false) {
                $pagination .= '<nav aria-label="Page navigation ' . $extra_classes_in_nav . '">';
            }

            $pagination .= '<ul class="pagination ' . $extra_classes_in_ul . '">';

            for ($i = 0; $i < (int)ceil($total_list / $limit); $i++) {
                //create structure for different selected structure
                if ($select_structure == 7) {
                    $active = '';
                    if ($total_list > 7) {

                        if ($active_list < 4) {
                            if ($active_list == $i) {
                                $active = $active_class_custom;
                            }
                            if ($i < 5) {
                                $pagination .= '<li data-id="' . $i . '" class="page-item ' . $active   . ' ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link  ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($i + 1) . '</a></li>';
                            } else {
                                if ($i == ((int)ceil($total_list / $limit) - 2)) {
                                    $pagination .= '<li data-id="null" class="page-item disabled ' . $active . ' ' . $extra_classes_in_li . '"> <a class="page-link  ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';
                                } elseif ($i == ((int)ceil($total_list / $limit) - 1)) {
                                    $pagination .= '<li data-id="' . $i . '" class="page-item ' . $active   . ' ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">>></a></li>';
                                }
                            }
                        } else if (((int)ceil($total_list / $limit) - $active_list) <= 4) {
                            if ($active_list == $i) {
                                $active = $active_class_custom;
                            }
                            if ($i >= ((int)ceil($total_list / $limit) - 5)) {
                                $pagination .= '<li data-id="' . $i . '" class="page-item ' . $active   . ' ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($i + 1) . '</a></li>';
                            } else {
                                if ($i == 0) {
                                    $pagination .= '<li data-id="' . $i . '" class="page-item ' . $active   . ' ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)"><<</a></li>';
                                } elseif ($i == 1) {
                                    $pagination .= '<li data-id="null" class="page-item disabled ' . $active   . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';
                                } else {
                                    continue;
                                }
                            }
                        } else {
                            $pagination .= '<li data-id="0" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)"><<</a></li>';

                            $pagination .= '<li data-id="null" class="page-item disabled ' . $active   . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';

                            $pagination .= '<li data-id="' . ($active_list - 1) . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($active_list) . '</a></li>';

                            $pagination .= '<li data-id="' . ($active_list) . '" class="page-item ' . $active_class_custom   . ' ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active_class_custom . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($active_list + 1) . '</a></li>';

                            $pagination .= '<li data-id="' . ($active_list + 1) . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($active_list + 2) . '</a></li>';

                            $pagination .= '<li data-id="null" class="page-item disabled ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';

                            $pagination .= '<li data-id="' . (ceil($total_list / $limit) - 1) . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">>></a></li>';

                            break;
                        }
                    } else {
                        if ($active_list == $i) {
                            $active = $active_class_custom;
                        }
                        $pagination .= '<li data-id="' . $i . '" class="page-item ' . $active   . ' ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($i + 1) . '</a></li>';
                    }

                } elseif ($select_structure == 5) {

                } elseif ($select_structure == 3) {
                    if ($total_list > 3) {
                        if ($active_list = 0) {

                        } elseif ($active_list == ((int)ceil(($total_list / $limit)) - 1)) {

                        } else {

                        }
                    } else {

                    }

                } elseif ($select_structure == 2) {
                    $pagination .= '<li data-id="' . ($active_list - 1) . '" class="page-item ' . ($active_list == 0 ? 'disabled' : $click_class) . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)" >Previous</a></li>';
                    $pagination .= '<li data-id="' . ($active_list + 1) . '" class="page-item ' . ($active_list == ((int)ceil($total_list / $limit) - 1) ? 'disabled' : $click_class) . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">Next</a></li>';
                    break;
                } elseif ($select_structure > 7) {
                    $active = '';
                    if ($total_list > $select_structure) {
                        if ($active_list < ($select_structure - 3)) {
                            if ($active_list == $i) {
                                $active = $active_class_custom;
                            }
                            if ($i < ($select_structure - 2)) {
                                $pagination .= '<li data-id="' . $i . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($i + 1) . '</a></li>';
                            } else {
                                if ($i == ((int)ceil($total_list / $limit) - 2)) {
                                    $pagination .= '<li data-id="null" class="page-item disabled' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';
                                } elseif ($i == ((int)ceil($total_list / $limit) - 1)) {
                                    $pagination .= '<li data-id="' . $i . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">>></a></li>';
                                }
                            }
                        } else if (((int)ceil($total_list / $limit) - $active_list) <= ($select_structure - 3)) {
                            if ($active_list == $i) {
                                $active = $active_class_custom;
                            }
                            if ($i >= ((int)ceil($total_list / $limit) - ($select_structure - 2))) {
                                $pagination .= '<li data-id="' . $i . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($i + 1) . '</a></li>';
                            } else {
                                if ($i == 0) {
                                    $pagination .= '<li data-id="' . $i . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)"><<</a></li>';
                                } elseif ($i == 1) {
                                    $pagination .= '<li data-id="null" class="page-item disabled' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';
                                } else {
                                    continue;
                                }
                            }
                        } else {
                            //todo first two list
                            $pagination .= '<li data-id="0" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)"><<</a></li>';

                            $pagination .= '<li data-id="null" class="page-item disabled' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';

                            //todo dynamic list start
                            //todo before active list
                            for ($loop = 0; $loop < (int)ceil(($select_structure - 5) / 2); $loop++) {
                                $pagination .= '<li data-id="' . ($active_list - ($loop + 1)) . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($active_list - $loop) . '</a></li>';
                            }

                            $pagination .= '<li data-id="' . ($active_list) . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active_class_custom . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($active_list + 1) . '</a></li>';

                            //todo after active list
                            for ($loop = 0; $loop < (int)floor(($select_structure - 5) / 2); $loop++) {
                                $pagination .= '<li data-id="' . ($active_list + ($loop + 1)) . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($active_list + ($loop + 2)) . '</a></li>';
                            }
                            //todo dynamic list end


                            //todo last two list
                            $pagination .= '<li data-id="null" class="page-item disabled ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">...</a></li>';

                            $pagination .= '<li data-id="' . (ceil($total_list / $limit) - 1) . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $extra_classes_in_a . '" href="javascript:void(0)">>></a></li>';

                            break;
                        }
                    } else {
                        if ($active_list == $i) {
                            $active = $active_class_custom;
                        }
                        $pagination .= '<li data-id="' . $i . '" class="page-item ' . $click_class . ' ' . $extra_classes_in_li . '"> <a class="page-link ' . $active . ' ' . $extra_classes_in_a . '" href="javascript:void(0)">' . ($i + 1) . '</a></li>';
                    }
                }
            }
            $pagination .= '</ul>';
            if ($remove_nav == false) {
                $pagination .= '</nav>';
            }
        }

        return $pagination;
    }

    public static function getDefaultConfigData ()
    {
        $bellPrompt = [
            'theme' => 'default',
            'position' => 'bottom-right',
            'size' => 'large',
            'message' => 'Subscribe to notifications',
        ];

        $slidePrompt = [
            'acceptButton' => 'Allow',
            'cancelButton' => 'Cancel',
            'message' => 'We\'d like to show you notifications for the latest news and updates.',
        ];

        return [
            'type' => 1,
            'bellPrompt' => (object)$bellPrompt,
            'slidePrompt' => (object)$slidePrompt,
        ];
    }

}
