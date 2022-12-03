<?php

namespace App\View\Composers\Snippet;

use Roots\Acorn\View\Composer;

class CommentBlock extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = ['partials.snippet.comment-block'];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function override()
    {
        global $comment;
        $email = get_comment_author_email();
        $id = get_comment_ID();
        return [
            'cmt' => [
                'authorName' => get_comment_author(),
                'authorUrl' => get_comment_author_url(),
                'authorEmail' => $email,
                'authorAvatar' => get_avatar_url($email, ['size' => 80]),
                'id' => $id,
                'ip' => $this->convertip(get_comment_author_ip()),
                'dateTime' => get_comment_date('Y-m-d'),
                'displayTime' => \ThemeNova\display_time(strtotime($comment->comment_date_gmt), true),
                'editLink' => get_edit_comment_link($comment),
            ],
            'useragent' => $this->siren_get_useragent($comment->comment_agent),
            'isPostAuthor' => $comment->user_id === get_post()->post_author,
            'isPrivate' => get_comment_meta($id, '_private', true),
        ];
    }

    // nova-todo refactor it
    private function siren_get_useragent($ua)
    {
        $imgurl = 'https://cdn.jsdelivr.net/gh/moezx/cdn@3.2.7/img/Sakura/images/ua/svg/';
        $browser = $this->siren_get_browsers($ua);
        $os = $this->siren_get_os($ua);
        return [
            'browerSrc' => $imgurl . $browser[1] . '.svg',
            'browerType' => $browser[0],
            'osSrc' => $imgurl . $os[1] . '.svg',
            'osType' => $os[0],
        ];
    }

    private function siren_get_browsers($ua)
    {
        $title = 'unknow';
        $icon = 'unknow';
        if (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Internet Explorer ' . $matches[1];
            if (strpos($matches[1], '7') !== false || strpos($matches[1], '8') !== false) {
                $icon = 'ie8';
            } elseif (strpos($matches[1], '9') !== false) {
                $icon = 'ie9';
            } elseif (strpos($matches[1], '10') !== false) {
                $icon = 'ie10';
            } else {
                $icon = 'ie';
            }
        } elseif (preg_match('#Edge/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Edge ' . $matches[1];
            $icon = 'edge';
        } elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = '360 Browser ' . $matches[1];
            $icon = '360se';
        } elseif (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'SouGou Browser 2' . $matches[1];
            $icon = 'sogou';
        } elseif (preg_match('#LBBROWSER#i', $ua, $matches)) {
            $title = 'CM Browser';
            $icon = 'LBBROWSER';
        } elseif (preg_match('#MicroMessenger/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Built-in Browser of WeChat ' . $matches[1];
            $icon = 'wechat';
        } elseif (preg_match('#QQBrowser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'QQBrowser ' . $matches[1];
            $icon = 'QQBrowser';
        } elseif (preg_match('#BIDUBrowser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Baidu Browser ' . $matches[1];
            $icon = 'baidu';
        } elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'UCWEB ' . $matches[1];
            $icon = 'ucweb';
        } elseif (preg_match('#Firefox/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Firefox ' . $matches[1];
            $icon = 'firefox';
        } elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Chrome for iOS ' . $matches[1];
            $icon = 'crios';
        } elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Google Chrome ' . $matches[1];
            $icon = 'chrome';
            if (preg_match('#OPR/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
                $title = 'Opera ' . $matches[1];
                $icon = 'opera15';
                if (preg_match('#opera mini#i', $ua)) {
                    $title = 'Opera Mini' . $matches[1];
                }
            }
        } elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Safari ' . $matches[1];
            $icon = 'safari';
        } elseif (preg_match('#Opera.(.*)Version[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Opera ' . $matches[2];
            $icon = 'opera';
            if (preg_match('#opera mini#i', $ua)) {
                $title = 'Opera Mini' . $matches[2];
            }
        } elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            $title = 'Maxthon ' . $matches[2];
            $icon = 'maxthon';
        } elseif (preg_match('#wp-(iphone|android)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
            // 1.2 增加 wordpress 客户端的判断
            $title = 'wordpress ' . $matches[2];
            $icon = 'wordpress';
        }

        return [$title, $icon];
    }

    private function siren_get_os($ua)
    {
        $title = 'unknow';
        $icon = 'unknow';
        if (preg_match('/win/i', $ua)) {
            if (preg_match('/Windows NT 10.0/i', $ua)) {
                $title = 'Windows 10';
                $icon = 'windows_win10';
            } elseif (preg_match('/Windows NT 6.1/i', $ua)) {
                $title = 'Windows 7';
                $icon = 'windows_win7';
            } elseif (preg_match('/Windows NT 5.1/i', $ua)) {
                $title = 'Windows XP';
                $icon = 'windows';
            } elseif (preg_match('/Windows NT 6.2/i', $ua)) {
                $title = 'Windows 8';
                $icon = 'windows_win8';
            } elseif (preg_match('/Windows NT 6.3/i', $ua)) {
                $title = 'Windows 8.1';
                $icon = 'windows_win8';
            } elseif (preg_match('/Windows NT 6.0/i', $ua)) {
                $title = 'Windows Vista';
                $icon = 'windows_vista';
            } elseif (preg_match('/Windows NT 5.2/i', $ua)) {
                if (preg_match('/Win64/i', $ua)) {
                    $title = 'Windows XP 64 bit';
                } else {
                    $title = 'Windows Server 2003';
                }
                $icon = 'windows';
            } elseif (preg_match('/Windows Phone/i', $ua)) {
                $matches = explode(';', $ua);
                $title = $matches[2];
                $icon = 'windows_phone';
            }
        } elseif (preg_match('#iPod.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
            $title = 'iPod ' . $matches[1];
            $icon = 'iphone';
        } elseif (preg_match('#iPhone OS ([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
            // 1.2 修改成 iphone os 来判断
            $title = 'Iphone ' . $matches[1];
            $icon = 'iphone';
        } elseif (preg_match('#iPad.*.CPU.([a-zA-Z0-9.( _)]+)#i', $ua, $matches)) {
            $title = 'iPad ' . $matches[1];
            $icon = 'ipad';
        } elseif (preg_match('/Android.([0-9. _]+)/i', $ua, $matches)) {
            if (count(explode(7, $matches[1])) > 1) {
                $matches[1] = 'Lion ' . $matches[1];
            } elseif (count(explode(8, $matches[1])) > 1) {
                $matches[1] = 'Mountain Lion ' . $matches[1];
            }
            $title = $matches[0];
            $icon = 'android';
        } elseif (preg_match('/Mac OS X.([0-9. _]+)/i', $ua, $matches)) {
            if (count(explode(7, $matches[1])) > 1) {
                $matches[1] = 'Lion ' . $matches[1];
            } elseif (count(explode(8, $matches[1])) > 1) {
                $matches[1] = 'Mountain Lion ' . $matches[1];
            }
            $title = 'Mac OSX ' . $matches[1];
            $icon = 'macos';
        } elseif (preg_match('/Macintosh/i', $ua)) {
            $title = 'Mac OS';
            $icon = 'macos';
        } elseif (preg_match('/CrOS/i', $ua)) {
            $title = 'Google Chrome OS';
            $icon = 'chrome';
        } elseif (preg_match('/Linux/i', $ua)) {
            $title = 'Linux';
            $icon = 'linux';
            if (preg_match('/Android.([0-9. _]+)/i', $ua, $matches)) {
                $title = $matches[0];
                $icon = 'android';
            } elseif (preg_match('#Ubuntu#i', $ua)) {
                $title = 'Ubuntu Linux';
                $icon = 'ubuntu';
            } elseif (preg_match('#Debian#i', $ua)) {
                $title = 'Debian GNU/Linux';
                $icon = 'debian';
            } elseif (preg_match('#Fedora#i', $ua)) {
                $title = 'Fedora Linux';
                $icon = 'fedora';
            }
        }
        return [$title, $icon];
    }

    function convertip($ip)
    {
        error_reporting(E_ALL ^ E_NOTICE);
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
            $file_contents = file_get_contents('http://ip.taobao.com/outGetIpInfo?accessKey=alibaba-inc&ip=' . $ip);
            $result = json_decode($file_contents, true);
            if ($result['data']['country'] != '中国') {
                return $result['data']['country'];
            } else {
                return $result['data']['region'] . '&nbsp;·&nbsp;' . $result['data']['city'] . '&nbsp;·&nbsp;' . $result['data']['isp'];
            }
        } else {
            $dat_path = dirname(__FILE__) . '/inc/QQWry.Dat';
            if (!($fd = @fopen($dat_path, 'rb'))) {
                return 'IP date file not exists or access denied';
            }
            $ip = explode('.', $ip);
            $ipNum = intval($ip[0]) * 16777216 + intval($ip[1]) * 65536 + intval($ip[2]) * 256 + intval($ip[3]);
            $DataBegin = fread($fd, 4);
            $DataEnd = fread($fd, 4);
            $ipbegin = implode('', unpack('L', $DataBegin));
            if ($ipbegin < 0) {
                $ipbegin += pow(2, 32);
            }

            $ipend = implode('', unpack('L', $DataEnd));
            if ($ipend < 0) {
                $ipend += pow(2, 32);
            }

            $ipAllNum = ($ipend - $ipbegin) / 7 + 1;
            $BeginNum = 0;
            $EndNum = $ipAllNum;
            $ip1num = $ip2num = $ipAddr1 = $ipAddr2 = '';
            while ($ip1num > $ipNum || $ip2num < $ipNum) {
                $Middle = intval(($EndNum + $BeginNum) / 2);
                fseek($fd, $ipbegin + 7 * $Middle);
                $ipData1 = fread($fd, 4);
                if (strlen($ipData1) < 4) {
                    fclose($fd);
                    return 'System Error';
                }
                $ip1num = implode('', unpack('L', $ipData1));
                if ($ip1num < 0) {
                    $ip1num += pow(2, 32);
                }

                if ($ip1num > $ipNum) {
                    $EndNum = $Middle;
                    continue;
                }
                $DataSeek = fread($fd, 3);
                if (strlen($DataSeek) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
                fseek($fd, $DataSeek);
                $ipData2 = fread($fd, 4);
                if (strlen($ipData2) < 4) {
                    fclose($fd);
                    return 'System Error';
                }
                $ip2num = implode('', unpack('L', $ipData2));
                if ($ip2num < 0) {
                    $ip2num += pow(2, 32);
                }

                if ($ip2num < $ipNum) {
                    if ($Middle == $BeginNum) {
                        fclose($fd);
                        return 'Unknown';
                    }
                    $BeginNum = $Middle;
                }
            }
            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(1)) {
                $ipSeek = fread($fd, 3);
                if (strlen($ipSeek) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
                fseek($fd, $ipSeek);
                $ipFlag = fread($fd, 1);
            }
            if ($ipFlag == chr(2)) {
                $AddrSeek = fread($fd, 3);
                if (strlen($AddrSeek) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $ipFlag = fread($fd, 1);
                if ($ipFlag == chr(2)) {
                    $AddrSeek2 = fread($fd, 3);
                    if (strlen($AddrSeek2) < 3) {
                        fclose($fd);
                        return 'System Error';
                    }
                    $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                    fseek($fd, $AddrSeek2);
                } else {
                    fseek($fd, -1, SEEK_CUR);
                }
                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr2 .= $char;
                }

                $AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
                fseek($fd, $AddrSeek);
                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr1 .= $char;
                }
            } else {
                fseek($fd, -1, SEEK_CUR);
                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr1 .= $char;
                }

                $ipFlag = fread($fd, 1);
                if ($ipFlag == chr(2)) {
                    $AddrSeek2 = fread($fd, 3);
                    if (strlen($AddrSeek2) < 3) {
                        fclose($fd);
                        return 'System Error';
                    }
                    $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                    fseek($fd, $AddrSeek2);
                } else {
                    fseek($fd, -1, SEEK_CUR);
                }
                while (($char = fread($fd, 1)) != chr(0)) {
                    $ipAddr2 .= $char;
                }
            }
            fclose($fd);
            if (preg_match('/http/i', $ipAddr2)) {
                $ipAddr2 = '';
            }
            $ipaddr = "$ipAddr1 $ipAddr2";
            $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr);
            $ipaddr = preg_replace('/^s*/is', '', $ipaddr);
            $ipaddr = preg_replace('/s*$/is', '', $ipaddr);
            if (preg_match('/http/i', $ipaddr) || $ipaddr == '') {
                $ipaddr = 'Unknown';
            }
            $ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr);
            if ($ipaddr != '  ') {
                return $ipaddr;
            } else {
                $ipaddr = 'Unknown';
            }

            return $ipaddr;
        }
    }
}
