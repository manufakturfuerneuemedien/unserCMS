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

$lang['db_invalid_connection_str'] = 'Die Datenbankkonfiguration konnte nicht f&uuml;r die angegebene Verbindung ermittelt werden.';
$lang['db_unable_to_connect'] = 'Mit den angegebenen Verbindungsdaten konnte keine Verbindung zur Datenbank hergestellt werden.';
$lang['db_unable_to_select'] = 'Die Verbindung zur Datenbank %s ist fehlgeschlagen.';
$lang['db_unable_to_create'] = 'Die Datenbank %s konnte nicht erstellt werden.';
$lang['db_invalid_query'] = 'Die angegebene Abfrage ist nicht g&uuml;ltig.';
$lang['db_must_set_table'] = 'Es muss eine Datenbanktabelle f&uuml;r die Abfrage angegeben werden.';
$lang['db_must_use_set'] = 'Der Befehl "SET" muss in der Aktualisierungs-Abfrage enthalten sein.';
$lang['db_must_use_index'] = 'Ein Index muss zuvor spezifiziert werden, bevor ein Abgleich für geb&uuml;ndelte Aktualisierungen (Batch Updates) stattfinden kann';
$lang['db_batch_missing_index'] = 'Bei einer oder mehreren Zeilen, die f&uuml;r die geb&uuml;ndelten Aktualisierungen (Batch Updates) angegeben worden sind, fehlt der spezifizierte Index';
$lang['db_must_use_where'] = 'Aktualisierungen von Datens&auml;tzen erfordern eine "WHERE"-Klausel.';
$lang['db_del_must_use_where'] = 'Das L&ouml;schen von Datens&auml;tzen erfordert eine "WHERE"-Klausel.';
$lang['db_field_param_missing'] = 'Der Name der Tabelle, aus der Daten abgefragt werden sollen, muss angegeben werden.';
$lang['db_unsupported_function'] = 'Dieser Befehl wird von der verwendeten Datenbank nicht unterst&uuml;tzt.';
$lang['db_transaction_failure'] = 'Die Transaktion ist fehlgeschlagen: Der vorherige Zustand wurde wiederhergestellt.';
$lang['db_unable_to_drop'] = 'Die Datenbank konnte nicht gel&ouml;scht werden.';
$lang['db_unsuported_feature'] = 'Dieser Befehl wird von der verwendeten Datenbank nicht unterst&uuml;tzt.';
$lang['db_unsuported_compression'] = 'Das verwendete Kompressions-Dateiformat wird von der Datenbank nicht unterst&uuml;tzt.';
$lang['db_filepath_error'] = 'Die Ausgabe von Daten in den angegebenen Dateipfad ist fehlgeschlagen.';
$lang['db_invalid_cache_path'] = 'Der Zwischenspeicher-Pfad (Cache) ist ung&uuml;ltig oder schreibgesch&uuml;tzt.';
$lang['db_table_name_required'] = 'F&uuml;r diese Verarbeitung wird ein Tabellenname ben&ouml;tigt.';
$lang['db_column_name_required'] = 'F&uuml;r diese Verarbeitung wird ein Spaltenname ben&ouml;tigt.';
$lang['db_column_definition_required'] = 'F&uuml;r diese Verarbeitung wird eine Spaltenbeschreibung ben&ouml;tigt.';
$lang['db_unable_to_set_charset'] = 'Es ist nicht m&ouml;glich den Zeichensatz %s f&uuml;r die Client Verbindung zu setzen.';
$lang['db_error_heading'] = 'Ein Datenbankfehler ist aufgetreten';
