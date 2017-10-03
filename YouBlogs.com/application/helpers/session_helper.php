<?php

        function is_logged_in()
         {     
            $CI= get_instance();
            $user = $CI->session->username;
            $CI->db->where('username',$user);
            $exist=$CI->db->count_all_results("users");
            $ok=false;
            if ($exist===1 and isset($user)) {
                $ok=true;
            }                        
            return $ok;
         }?>