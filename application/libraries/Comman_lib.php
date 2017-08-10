<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comman_lib {

    public $CI;

    function __construct() {
        $this->CI = &get_instance();
    }

    function isLogin() {
        if ($this->CI->session->userdata('user')) {
            return true;
        } else {
            $url = site_url();
            redirect($url);
        }
    }

    function is_valid_access($id, $page_access) {
        //echo $page_access;exit;
        $this->CI->load->model("commonmodel", "common", true);
        $user_access = $this->CI->common->get_user_access($id);
        if (!empty($user_access)) {
            $access = explode(',', $user_access['module_access']);
            if (in_array($page_access, $access)) {
                return true;
            } else {
                $this->CI->message_stack->add_message('message', 'You have not authorized to access this page.');
                $this->CI->message_stack->add_message('class', 'danger');
                $url = base_url() . 'admin';
                redirect($url);
            }
        } else {
            $this->CI->message_stack->add_message('message', 'You have not authorized to access this page.');
            $this->CI->message_stack->add_message('class', 'danger');
            $url = base_url() . 'admin';
            redirect($url);
        }
    }

    public function convertArray($arrays, $keyName) {
        $newArray = $arrays;
        if (!empty($arrays)) {
            foreach ($arrays as $key => $array) :
                $newArray[$key] = $array[$keyName];
            endforeach;
        }
        return $newArray;
    }

    public function get_offset_limit($data) {
        //$this -> CI -> load -> model("admin_model", "admin", true);
        //$perPageRecord = $this->CI->admin->get_per_page_record();
        $perPageRecord = 20;
        $offset = '0';
        if (isset($data['PageNo']) && !empty($data['PageNo']) && $data['PageNo'] > 1) {
            $offset = (($data['PageNo'] - 1) * $perPageRecord);
        }
        unset($data['PageNo']);
        $data['Offset'] = $offset;
        $data['Limit'] = $perPageRecord;
        return $data;
    }

    public function get_no_of_pages($total_rows) {
        $this->CI->load->model("admin_model", "admin", true);
        $perPageRecord = $this->CI->admin->get_per_page_record();
        //$perPageRecord = 1;
        return ceil($total_rows / $perPageRecord);
    }

    function valid_hash($HashKey) {
        if (strcmp(urldecode($HashKey), HASHKEY) == 0) {
            return true;
        } else {
            $data['Message'] = "Error";
            $data['MessageInfo'] = "Invalid Hash Key";
            echo json_encode($data);
            exit;
        }
    }

    function get_data() {
        $get_data = $this->CI->input->get();
        $post_data = $this->CI->input->post();
        if (!empty($get_data)) {
            $data = $get_data;
        } else if (!empty($post_data)) {
            $data = $post_data;
        }
        return $data;
    }

    function distance($lat1, $lng1, $lat2, $lng2, $miles = false) {
        //number_format($number, 2, '.', '')
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;

        $r = 6372.797;
        // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;
        return ($miles ? number_format(($km * 0.621371192), 2, '.', '') : number_format($km, 2, '.', ''));
    }

    function ResizeImage($sourcePath, $size, $destPath) {
        $this->CI->load->library('image_lib');
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $destPath;
        $config['create_thumb'] = False;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $size;
        $config['height'] = $size;
        $this->CI->image_lib->clear();
        $this->CI->image_lib->initialize($config);
        if (!$this->CI->image_lib->resize()) {
            echo $sourcePath . ":::";
            echo $destPath;
            echo $this->CI->image_lib->display_errors();
            return false;
        }
        return true;
    }

    function compress_image($source_url, $destination_url, $quality) {

        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);

        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }

    function get_image_quality($source_url) {
        $size = filesize($source_url);
        $calculate = floor((($size / 1024) / 1024));
        if ($calculate >= 1) {
            $quality = floor((($size / 1024) / 1024) * 40);
        } else {
            $quality = 80;
        }

        return $quality;
    }

    function uploadPhoto($field_name, $upload_path, $allowed_types, $file, $folderName, $thumb_folder = false, $ratio = 512, $other = false) {
        if (!is_dir($upload_path . $folderName)) {
            mkdir($upload_path . $folderName, 0777, TRUE);
        }
        if ($thumb_folder) {
            if (!is_dir($upload_path . $folderName . "/thumb_small")) {
                mkdir($upload_path . $folderName . "/thumb_small", 0777, TRUE);
            }
        }

        if ($other) {
            if (!is_dir($upload_path . $folderName . "/thumb_720")) {
                mkdir($upload_path . $folderName . "/thumb_720", 0777, TRUE);
            }
            if (!is_dir($upload_path . $folderName . "/thumb_360")) {
                mkdir($upload_path . $folderName . "/thumb_360", 0777, TRUE);
            }
        }
        $config['upload_path'] = $upload_path . $folderName;
        $config['allowed_types'] = $allowed_types;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = true;
        $this->CI->load->library('upload', $config);
        $photo = "";
        if ($this->CI->upload->do_upload($field_name)) {
            $img = $this->CI->upload->data();
            $photo = $img['file_name'];
            /* if($allowed_types != "mp3")
              {
              if (!$this -> ResizeImage($upload_path . $folderName . "/" . $photo, 200, $upload_path . $folderName . "/" . $thumb_folder . "/" . $photo)) {
              exit ;
              }
              } */
            if ($thumb_folder) {
                $this->ResizeImage($upload_path . $folderName . "/" . $photo, $ratio, $upload_path . $folderName . "/thumb_small/" . $photo);
            }
            if ($other) {
                $this->ResizeImage($upload_path . $folderName . "/" . $photo, 720, $upload_path . $folderName . "/thumb_720/" . $photo);
                $this->ResizeImage($upload_path . $folderName . "/" . $photo, 360, $upload_path . $folderName . "/thumb_360/" . $photo);
            }
        } else {
            $error = array('error' => $this->CI->upload->display_errors());
            print_r($error);
            exit;
        }
        return $photo;
    }

    function socialImage($image_name, $upload_path, $folderName, $thumb_folder = false, $ratio = 512, $other = false, $isConvert = false) {
        if (!is_dir($upload_path . $folderName)) {
            mkdir($upload_path . $folderName, 0777, TRUE);
        }
        if ($thumb_folder) {
            if (!is_dir($upload_path . $folderName . "/thumb_small")) {
                mkdir($upload_path . $folderName . "/thumb_small", 0777, TRUE);
            }
        }
        if ($other) {
            if (!is_dir($upload_path . $folderName . "/thumb_720")) {
                mkdir($upload_path . $folderName . "/thumb_720", 0777, TRUE);
            }
            if (!is_dir($upload_path . $folderName . "/thumb_360")) {
                mkdir($upload_path . $folderName . "/thumb_360", 0777, TRUE);
            }
        }
        $photo = $image_name;
        if ($isConvert) {
            //$this->compress_image($source_url, $destination_url);
            $this->ResizeImage($upload_path . $folderName . "/temp/temp_" . $photo, 2048, $upload_path . $folderName . "/" . $photo);
        }

        if ($thumb_folder) {
            $this->ResizeImage($upload_path . $folderName . "/" . $photo, $ratio, $upload_path . $folderName . "/thumb_small/" . $photo);
        }
        if ($other) {
            $this->ResizeImage($upload_path . $folderName . "/" . $photo, 720, $upload_path . $folderName . "/thumb_720/" . $photo);
            $this->ResizeImage($upload_path . $folderName . "/" . $photo, 360, $upload_path . $folderName . "/thumb_360/" . $photo);
        }

        // compress image size
        if (!is_dir($upload_path . $folderName . "/compress")) {
            mkdir($upload_path . $folderName . "/compress", 0777, TRUE);
        }
        $source_url = $upload_path . $folderName . "/" . $photo;
        $quality = $this->get_image_quality($source_url);
        $destination_url = $upload_path . $folderName . "/compress/" . $photo;
        $this->compress_image($source_url, $destination_url, $quality);
        return true;
    }

    public function initPagination($base_url, $total_rows, $per_page) {
        $this->CI->load->library('pagination');
        $config['base_url'] = base_url() . $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        return $config;
    }

    /**
     * Ago time calculation
     *
     * @access  public
     * @param   string - date from
     * @param   string - date to
     * @return  string
     */
    function time_ago($datefrom, $dateto = -1) {
        // Defaults and assume if 0 is passed in that
        // its an error rather than the epoch

        if ($datefrom <= 0) {
            return "A long time ago";
        }
        if ($dateto == -1) {
            $dateto = time();
        }

        // Calculate the difference in seconds betweeen
        // the two timestamps

        $difference = $dateto - $datefrom;

        // If difference is less than 60 seconds,
        // seconds is a good interval of choice

        if ($difference < 60) {
            $interval = "s";
        }

        // If difference is between 60 seconds and
        // 60 minutes, minutes is a good interval
        elseif ($difference >= 60 && $difference < 60 * 60) {
            $interval = "n";
        }

        // If difference is between 1 hour and 24 hours
        // hours is a good interval
        elseif ($difference >= 60 * 60 && $difference < 60 * 60 * 24) {
            $interval = "h";
        }

        // If difference is between 1 day and 7 days
        // days is a good interval
        elseif ($difference >= 60 * 60 * 24 && $difference < 60 * 60 * 24 * 7) {
            $interval = "d";
        }

        // If difference is between 1 week and 30 days
        // weeks is a good interval
        elseif ($difference >= 60 * 60 * 24 * 7 && $difference <
                60 * 60 * 24 * 30) {
            $interval = "ww";
        }

        // If difference is between 30 days and 365 days
        // months is a good interval, again, the same thing
        // applies, if the 29th February happens to exist
        // between your 2 dates, the function will return
        // the 'incorrect' value for a day
        elseif ($difference >= 60 * 60 * 24 * 30 && $difference <
                60 * 60 * 24 * 365) {
            $interval = "m";
        }

        // If difference is greater than or equal to 365
        // days, return year. This will be incorrect if
        // for example, you call the function on the 28th April
        // 2008 passing in 29th April 2007. It will return
        // 1 year ago when in actual fact (yawn!) not quite
        // a year has gone by
        elseif ($difference >= 60 * 60 * 24 * 365) {
            $interval = "y";
        }

        // Based on the interval, determine the
        // number of units between the two dates
        // From this point on, you would be hard
        // pushed telling the difference between
        // this function and DateDiff. If the $datediff
        // returned is 1, be sure to return the singular
        // of the unit, e.g. 'day' rather 'days'

        switch ($interval) {
            case "m":
                $months_difference = floor($difference / 60 / 60 / 24 /
                        29);
                while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                    $months_difference++;
                }
                $datediff = $months_difference;
                // We need this in here because it is possible
                // to have an 'm' interval and a months
                // difference of 12 because we are using 29 days
                // in a month
                if ($datediff == 12) {
                    $datediff--;
                }
                $res = ($datediff == 1) ? "$datediff month ago" : "$datediff months ago";
                break;

            case "y":
                $datediff = floor($difference / 60 / 60 / 24 / 365);
                $res = ($datediff == 1) ? "$datediff year ago" : "$datediff years ago";
                break;

            case "d":
                $datediff = floor($difference / 60 / 60 / 24);
                $res = ($datediff == 1) ? "$datediff day ago" : "$datediff days ago";
                break;

            case "ww":
                $datediff = floor($difference / 60 / 60 / 24 / 7);
                $res = ($datediff == 1) ? "$datediff week ago" : "$datediff weeks ago";
                break;

            case "h":
                $datediff = floor($difference / 60 / 60);
                $res = ($datediff == 1) ? "$datediff hour ago" : "$datediff hours ago";
                break;

            case "n":
                $datediff = floor($difference / 60);
                //$res = ($datediff==1) ? "$datediff minute ago" : "$datediff minutes ago";
                $res = ($datediff == 1) ? "Just updated" : "$datediff mins ago";
                break;

            case "s":
                $datediff = $difference;
                //$res = ($datediff==1) ? "$datediff second ago" : "$datediff seconds ago";
                $res = ($datediff == 1) ? "Just updated" : "Just now";
                break;
        }
        return $res;
    }

    function sendCustomParametersWithPagination($request_data, $dataTableColumns) {

        $data = array();
        $i = -1;
        foreach ($request_data as $key => $records) {
            if (substr($key, -1) == $i + 1) {
                $i++;
            }
            if (substr($key, -1) == $i) {
                $keyName = substr($key, 1, -2);
                $columns[$i][$keyName] = $records;
            } else {
                $columns['others'][$key] = $records;
            }
        }
        //print_r($columns);exit;
        $sortBy = $sortOrder = $search = '';
        foreach ($columns as $key => $value) {
            if ($request_data['iSortCol_0'] == $key) {
                if (!empty($value['Sortable']) && $value['Sortable'] == true) {
                    $sortBy = $dataTableColumns[$request_data['iSortCol_0']];
                    $sortOrder = (!empty($request_data['sSortDir_0']) && $request_data['sSortDir_0'] == '') ? '' : $request_data['sSortDir_0'];
                } else {
                    $sortBy = '';
                    $sortOrder = '';
                }
            }
        }

        $search = (empty($request_data['sSearch'])) ? "" : $request_data['sSearch'];
        $data['SortBy'] = $sortBy;
        $data['Search'] = $search;
        $data['SortOrder'] = $sortOrder;
        return $data;
    }

    function role_modules() {
        $modules = array(
            'user', 'user_access', 'shop', 'coupon', 'category', 'festival', 'offer', 'ratting'
        );
        return $modules;
    }

}
