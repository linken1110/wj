<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('redirect'))
{
        function redirect($uri = '', $method = 'location', $http_response_code = 302)
        {
                $uri_base = $uri;
                if ( ! preg_match('#^https?://#i', $uri))
                {
                        $uri = site_url($uri);
                }

                switch($method)
                {
                        case 'refresh'  : header("Refresh:0;url=".$uri);
                        break;
                        case 'data'     : $uri = $uri_base;
                        default:
                        {
                                $CI =& get_instance();

                                if(isset($CI->api) && method_exists($CI->api, 'is_browser_access') && $CI->api->is_browser_access())
                                {
                                        header("Location: ".$uri, TRUE, $http_response_code);
                                }
                                else
                                {
                                        echo "<html><head></head><body bgcolor=\"#000000\">";
                                        echo("<script type='text/javascript'>location.href = \"{$uri}\";</script>");

                                        echo "</body></html>";
                                }
                        }
                        break;
                }
                exit;
        }
}
