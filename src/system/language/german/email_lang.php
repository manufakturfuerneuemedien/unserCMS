<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'Die E-Mail-Validierungsmethode muss als Array &uuml;bermittelt werden.';
$lang['email_invalid_address'] = 'Ung&uuml;ltige E-Mail-Adresse: %s';
$lang['email_attachment_missing'] = 'Der Dateianhang %s konnte nicht gefunden werden.';
$lang['email_attachment_unreadable'] = 'Der Dateianhang %s konnte nicht ge&ouml;ffnet werden.';
$lang['email_no_from'] = 'Die Nachricht kann ohne "From" header nicht gesendet werden.';
$lang['email_no_recipients'] = 'Die Empf&auml;nger To, Cc oder Bcc m&uuml;ssen angegeben werden.';
$lang['email_send_failure_phpmail'] = 'Die Nachricht konnte nicht &uuml;ber die PHP-Funktion mail() versandt werden. Der Server muss m&ouml;glicherweise so konfiguriert werden, dass er Mails mit dieser Funktion versenden kann.';
$lang['email_send_failure_sendmail'] = 'Die Nachricht konnte nicht &uuml;ber sendmail versandt werden. Der Server muss m&ouml;glicherweise so konfiguriert werden, dass er Mails mit sendmail versenden kann.';
$lang['email_send_failure_smtp'] = 'Die Nachricht konnte nicht &uuml;ber die PHP SMTP versandt werden. Der Server muss m&ouml;glicherweise so konfiguriert werden, dass er Mails mit dieser Funktion versenden kann.';
$lang['email_sent'] = 'Die Nachricht wurde erfolgreich mittels %s versandt.';
$lang['email_no_socket'] = 'Es konnte kein Socket f&uuml;r Sendmail ge&ouml;ffnet werden. Bitte pr&uuml;fen Sie die Einstellungen.';
$lang['email_no_hostname'] = 'Es wurde kein SMTP-Hostname angegeben.';
$lang['email_smtp_error'] = 'Der SMTP-Fehler %s ist aufgetreten';
$lang['email_no_smtp_unpw'] = 'SMTP-Benutzername und -Passwort m&uuml;ssen angegeben werden.';
$lang['email_failed_smtp_login'] = 'Der AUTH LOGIN konnte nicht gesendet werden. Fehler: %s';
$lang['email_smtp_auth_un'] = 'Der Benutzername konnte nicht best&auml;tigt werden. Fehler: %s';
$lang['email_smtp_auth_pw'] = 'Das Passwort konnte nicht best&auml;tigt werden. Fehler: %s';
$lang['email_smtp_data_failure'] = 'Die Daten %s konnten nicht versandt werden.';
$lang['email_exit_status'] = 'Abbruch Statuscode: %s';
