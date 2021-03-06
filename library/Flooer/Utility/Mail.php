<?php

/**
 * Flooer Framework
 *
 * LICENSE: BSD License (2 Clause)
 *
 * @category    Flooer
 * @package     Flooer_Utility
 * @author      Akira Ohgaki <akiraohgaki@gmail.com>
 * @copyright   2014, Akira Ohgaki
 * @license     https://opensource.org/licenses/BSD-2-Clause  BSD License (2 Clause)
 * @link        https://github.com/akiraohgaki/flooer
 */

/**
 * Usage
 *
 * $bool = Flooer_Utility_Mail::send($to, $subject, $message, $from);
 */

/**
 * Email sending wrapper class
 *
 * @category    Flooer
 * @package     Flooer_Utility
 * @author      Akira Ohgaki <akiraohgaki@gmail.com>
 */
class Flooer_Utility_Mail
{

    /**
     * Send an email
     *
     * @param   string $to
     * @param   string $subject
     * @param   string $message
     * @param   string $from
     * @param   string $cc
     * @param   string $bcc
     * @return  bool
     */
    public static function send($to, $subject, $message, $from, $cc = null, $bcc = null)
    {
        $presetMbLanguage = mb_language();
        mb_language('uni');
        $additionalHeaders = "From: $from\n";
        if ($cc) {
            $additionalHeaders .= "Cc: $cc\n";
        }
        if ($bcc) {
            $additionalHeaders .= "Bcc: $bcc\n";
        }
        $bool = mb_send_mail($to, $subject, $message, $additionalHeaders);
        if ($presetMbLanguage) {
            mb_language($presetMbLanguage);
        }
        return $bool;
    }

}
