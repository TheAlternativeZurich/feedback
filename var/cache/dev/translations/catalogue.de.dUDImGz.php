<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('de', array (
  'validators' => 
  array (
    'This value should be false.' => 'Dieser Wert sollte false sein.',
    'This value should be true.' => 'Dieser Wert sollte true sein.',
    'This value should be of type {{ type }}.' => 'Dieser Wert sollte vom Typ {{ type }} sein.',
    'This value should be blank.' => 'Dieser Wert sollte leer sein.',
    'The value you selected is not a valid choice.' => 'Sie haben einen ungültigen Wert ausgewählt.',
    'You must select at least {{ limit }} choice.|You must select at least {{ limit }} choices.' => 'Sie müssen mindestens {{ limit }} Möglichkeit wählen.|Sie müssen mindestens {{ limit }} Möglichkeiten wählen.',
    'You must select at most {{ limit }} choice.|You must select at most {{ limit }} choices.' => 'Sie dürfen höchstens {{ limit }} Möglichkeit wählen.|Sie dürfen höchstens {{ limit }} Möglichkeiten wählen.',
    'One or more of the given values is invalid.' => 'Einer oder mehrere der angegebenen Werte sind ungültig.',
    'This field was not expected.' => 'Dieses Feld wurde nicht erwartet.',
    'This field is missing.' => 'Dieses Feld fehlt.',
    'This value is not a valid date.' => 'Dieser Wert entspricht keiner gültigen Datumsangabe.',
    'This value is not a valid datetime.' => 'Dieser Wert entspricht keiner gültigen Datums- und Zeitangabe.',
    'This value is not a valid email address.' => 'Dieser Wert ist keine gültige E-Mail-Adresse.',
    'The file could not be found.' => 'Die Datei wurde nicht gefunden.',
    'The file is not readable.' => 'Die Datei ist nicht lesbar.',
    'The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}.' => 'Die Datei ist zu groß ({{ size }} {{ suffix }}). Die maximal zulässige Größe beträgt {{ limit }} {{ suffix }}.',
    'The mime type of the file is invalid ({{ type }}). Allowed mime types are {{ types }}.' => 'Der Dateityp ist ungültig ({{ type }}). Erlaubte Dateitypen sind {{ types }}.',
    'This value should be {{ limit }} or less.' => 'Dieser Wert sollte kleiner oder gleich {{ limit }} sein.',
    'This value is too long. It should have {{ limit }} character or less.|This value is too long. It should have {{ limit }} characters or less.' => 'Diese Zeichenkette ist zu lang. Sie sollte höchstens {{ limit }} Zeichen haben.|Diese Zeichenkette ist zu lang. Sie sollte höchstens {{ limit }} Zeichen haben.',
    'This value should be {{ limit }} or more.' => 'Dieser Wert sollte größer oder gleich {{ limit }} sein.',
    'This value is too short. It should have {{ limit }} character or more.|This value is too short. It should have {{ limit }} characters or more.' => 'Diese Zeichenkette ist zu kurz. Sie sollte mindestens {{ limit }} Zeichen haben.|Diese Zeichenkette ist zu kurz. Sie sollte mindestens {{ limit }} Zeichen haben.',
    'This value should not be blank.' => 'Dieser Wert sollte nicht leer sein.',
    'This value should not be null.' => 'Dieser Wert sollte nicht null sein.',
    'This value should be null.' => 'Dieser Wert sollte null sein.',
    'This value is not valid.' => 'Dieser Wert ist nicht gültig.',
    'This value is not a valid time.' => 'Dieser Wert entspricht keiner gültigen Zeitangabe.',
    'This value is not a valid URL.' => 'Dieser Wert ist keine gültige URL.',
    'The two values should be equal.' => 'Die beiden Werte sollten identisch sein.',
    'The file is too large. Allowed maximum size is {{ limit }} {{ suffix }}.' => 'Die Datei ist zu groß. Die maximal zulässige Größe beträgt {{ limit }} {{ suffix }}.',
    'The file is too large.' => 'Die Datei ist zu groß.',
    'The file could not be uploaded.' => 'Die Datei konnte nicht hochgeladen werden.',
    'This value should be a valid number.' => 'Dieser Wert sollte eine gültige Zahl sein.',
    'This file is not a valid image.' => 'Diese Datei ist kein gültiges Bild.',
    'This is not a valid IP address.' => 'Dies ist keine gültige IP-Adresse.',
    'This value is not a valid language.' => 'Dieser Wert entspricht keiner gültigen Sprache.',
    'This value is not a valid locale.' => 'Dieser Wert entspricht keinem gültigen Gebietsschema.',
    'This value is not a valid country.' => 'Dieser Wert entspricht keinem gültigen Land.',
    'This value is already used.' => 'Dieser Wert wird bereits verwendet.',
    'The size of the image could not be detected.' => 'Die Größe des Bildes konnte nicht ermittelt werden.',
    'The image width is too big ({{ width }}px). Allowed maximum width is {{ max_width }}px.' => 'Die Bildbreite ist zu groß ({{ width }}px). Die maximal zulässige Breite beträgt {{ max_width }}px.',
    'The image width is too small ({{ width }}px). Minimum width expected is {{ min_width }}px.' => 'Die Bildbreite ist zu gering ({{ width }}px). Die erwartete Mindestbreite beträgt {{ min_width }}px.',
    'The image height is too big ({{ height }}px). Allowed maximum height is {{ max_height }}px.' => 'Die Bildhöhe ist zu groß ({{ height }}px). Die maximal zulässige Höhe beträgt {{ max_height }}px.',
    'The image height is too small ({{ height }}px). Minimum height expected is {{ min_height }}px.' => 'Die Bildhöhe ist zu gering ({{ height }}px). Die erwartete Mindesthöhe beträgt {{ min_height }}px.',
    'This value should be the user\'s current password.' => 'Dieser Wert sollte dem aktuellen Benutzerpasswort entsprechen.',
    'This value should have exactly {{ limit }} character.|This value should have exactly {{ limit }} characters.' => 'Dieser Wert sollte genau {{ limit }} Zeichen lang sein.|Dieser Wert sollte genau {{ limit }} Zeichen lang sein.',
    'The file was only partially uploaded.' => 'Die Datei wurde nur teilweise hochgeladen.',
    'No file was uploaded.' => 'Es wurde keine Datei hochgeladen.',
    'No temporary folder was configured in php.ini.' => 'Es wurde kein temporärer Ordner in der php.ini konfiguriert oder der temporäre Ordner existiert nicht.',
    'Cannot write temporary file to disk.' => 'Kann die temporäre Datei nicht speichern.',
    'A PHP extension caused the upload to fail.' => 'Eine PHP-Erweiterung verhinderte den Upload.',
    'This collection should contain {{ limit }} element or more.|This collection should contain {{ limit }} elements or more.' => 'Diese Sammlung sollte {{ limit }} oder mehr Elemente beinhalten.|Diese Sammlung sollte {{ limit }} oder mehr Elemente beinhalten.',
    'This collection should contain {{ limit }} element or less.|This collection should contain {{ limit }} elements or less.' => 'Diese Sammlung sollte {{ limit }} oder weniger Elemente beinhalten.|Diese Sammlung sollte {{ limit }} oder weniger Elemente beinhalten.',
    'This collection should contain exactly {{ limit }} element.|This collection should contain exactly {{ limit }} elements.' => 'Diese Sammlung sollte genau {{ limit }} Element beinhalten.|Diese Sammlung sollte genau {{ limit }} Elemente beinhalten.',
    'Invalid card number.' => 'Ungültige Kartennummer.',
    'Unsupported card type or invalid card number.' => 'Nicht unterstützer Kartentyp oder ungültige Kartennummer.',
    'This is not a valid International Bank Account Number (IBAN).' => 'Dieser Wert ist keine gültige internationale Bankkontonummer (IBAN).',
    'This value is not a valid ISBN-10.' => 'Dieser Wert entspricht keiner gültigen ISBN-10.',
    'This value is not a valid ISBN-13.' => 'Dieser Wert entspricht keiner gültigen ISBN-13.',
    'This value is neither a valid ISBN-10 nor a valid ISBN-13.' => 'Dieser Wert ist weder eine gültige ISBN-10 noch eine gültige ISBN-13.',
    'This value is not a valid ISSN.' => 'Dieser Wert ist keine gültige ISSN.',
    'This value is not a valid currency.' => 'Dieser Wert ist keine gültige Währung.',
    'This value should be equal to {{ compared_value }}.' => 'Dieser Wert sollte gleich {{ compared_value }} sein.',
    'This value should be greater than {{ compared_value }}.' => 'Dieser Wert sollte größer als {{ compared_value }} sein.',
    'This value should be greater than or equal to {{ compared_value }}.' => 'Dieser Wert sollte größer oder gleich {{ compared_value }} sein.',
    'This value should be identical to {{ compared_value_type }} {{ compared_value }}.' => 'Dieser Wert sollte identisch sein mit {{ compared_value_type }} {{ compared_value }}.',
    'This value should be less than {{ compared_value }}.' => 'Dieser Wert sollte kleiner als {{ compared_value }} sein.',
    'This value should be less than or equal to {{ compared_value }}.' => 'Dieser Wert sollte kleiner oder gleich {{ compared_value }} sein.',
    'This value should not be equal to {{ compared_value }}.' => 'Dieser Wert sollte nicht {{ compared_value }} sein.',
    'This value should not be identical to {{ compared_value_type }} {{ compared_value }}.' => 'Dieser Wert sollte nicht identisch sein mit {{ compared_value_type }} {{ compared_value }}.',
    'The image ratio is too big ({{ ratio }}). Allowed maximum ratio is {{ max_ratio }}.' => 'Das Seitenverhältnis des Bildes ist zu groß ({{ ratio }}). Der erlaubte Maximalwert ist {{ max_ratio }}.',
    'The image ratio is too small ({{ ratio }}). Minimum ratio expected is {{ min_ratio }}.' => 'Das Seitenverhältnis des Bildes ist zu klein ({{ ratio }}). Der erwartete Minimalwert ist {{ min_ratio }}.',
    'The image is square ({{ width }}x{{ height }}px). Square images are not allowed.' => 'Das Bild ist quadratisch ({{ width }}x{{ height }}px). Quadratische Bilder sind nicht erlaubt.',
    'The image is landscape oriented ({{ width }}x{{ height }}px). Landscape oriented images are not allowed.' => 'Das Bild ist im Querformat ({{ width }}x{{ height }}px). Bilder im Querformat sind nicht erlaubt.',
    'The image is portrait oriented ({{ width }}x{{ height }}px). Portrait oriented images are not allowed.' => 'Das Bild ist im Hochformat ({{ width }}x{{ height }}px). Bilder im Hochformat sind nicht erlaubt.',
    'An empty file is not allowed.' => 'Eine leere Datei ist nicht erlaubt.',
    'The host could not be resolved.' => 'Der Hostname konnte nicht aufgelöst werden.',
    'This value does not match the expected {{ charset }} charset.' => 'Dieser Wert entspricht nicht dem erwarteten Zeichensatz {{ charset }}.',
    'This is not a valid Business Identifier Code (BIC).' => 'Dieser Wert ist kein gültiger BIC.',
    'Error' => 'Fehler',
    'This is not a valid UUID.' => 'Dies ist keine gültige UUID.',
    'This form should not contain extra fields.' => 'Dieses Formular sollte keine zusätzlichen Felder enthalten.',
    'The uploaded file was too large. Please try to upload a smaller file.' => 'Die hochgeladene Datei ist zu groß. Versuchen Sie bitte eine kleinere Datei hochzuladen.',
    'The CSRF token is invalid. Please try to resubmit the form.' => 'Der CSRF-Token ist ungültig. Versuchen Sie bitte das Formular erneut zu senden.',
  ),
  'security' => 
  array (
    'An authentication exception occurred.' => 'Es ist ein Fehler bei der Authentifikation aufgetreten.',
    'Authentication credentials could not be found.' => 'Es konnten keine Zugangsdaten gefunden werden.',
    'Authentication request could not be processed due to a system problem.' => 'Die Authentifikation konnte wegen eines Systemproblems nicht bearbeitet werden.',
    'Invalid credentials.' => 'Fehlerhafte Zugangsdaten.',
    'Cookie has already been used by someone else.' => 'Cookie wurde bereits von jemand anderem verwendet.',
    'Not privileged to request the resource.' => 'Keine Rechte, um die Ressource anzufragen.',
    'Invalid CSRF token.' => 'Ungültiges CSRF-Token.',
    'No authentication provider found to support the authentication token.' => 'Es wurde kein Authentifizierungs-Provider gefunden, der das Authentifizierungs-Token unterstützt.',
    'No session available, it either timed out or cookies are not enabled.' => 'Keine Session verfügbar, entweder ist diese abgelaufen oder Cookies sind nicht aktiviert.',
    'No token could be found.' => 'Es wurde kein Token gefunden.',
    'Username could not be found.' => 'Der Benutzername wurde nicht gefunden.',
    'Account has expired.' => 'Der Account ist abgelaufen.',
    'Credentials have expired.' => 'Die Zugangsdaten sind abgelaufen.',
    'Account is disabled.' => 'Der Account ist deaktiviert.',
    'Account is locked.' => 'Der Account ist gesperrt.',
  ),
  'account' => 
  array (
    'index.title' => 'Profil',
    'index.description' => 'Profil & Passwort',
    'index.change_password' => 'Passwort ändern',
    'index.do_change_password' => 'Neues Passwort setzen',
    'index.update' => 'Daten ändern',
    'index.hi' => 'Hallo %name%',
    'index.success.password_changed' => 'Ihr Passwort wurde erfolgreich geändert.',
    'index.error.email_taken' => 'Ein Benutzer mit dieser E-Mail ist bereits registriert.',
  ),
  'administration' => 
  array (
    'index.title' => 'Administration',
    'index.description' => 'Verwalten Sie die Benutzer und Termine',
  ),
  'administration_frontend_user' => 
  array (
    'index.title' => 'Benutzerverwaltung',
    'index.description' => 'Benutzer erstellen und bearbeiten, Zugriffe erteilen und entfernen, ...',
    'create.title' => 'Neuer Benutzer',
    'create.description' => 'Neuer Benutzer erstellen',
    'create.error.email_not_unique' => 'Diese E-Mail ist bereits vergeben',
    'update.title' => 'Benutzer bearbeiten',
    'update.description' => 'Ändern Sie Account, Name & Adresse des Benutzeres',
    'update.error.can_not_disable_login_self' => 'Sie können nicht sich selber den Zugriff verweigern.',
    'delete.title' => 'Benutzer entfernen',
    'delete.description' => 'Löschen Sie den Benutzer und alle damit verbundenen Daten',
    'delete.error.can_not_remove_self' => 'Sie können sich nicht selber entfernen.',
    'toggle_login_enabled.title' => 'Login erlauben ändern',
    'toggle_login_enabled.change' => 'ändern',
    'toggle_login_enabled.error.can_not_toggle_self' => 'Sie können nicht sich selber den Zugriff verweigern.',
  ),
  'administration_setting' => 
  array (
    'index.title' => 'Einstellungen',
    'index.description' => 'Benutzeranzahl ändern, ...',
    'update.title' => 'Einstellungen',
    'update.description' => 'Konfigurieren Sie die Anwendung nach Ihren Bedürfnissen',
    'update.administrators' => 'Administratoren',
    'update.administrators_help' => 'Ein Administrator kann Benutzer und die Einstellungen bearbeiten',
    'update.email_receivers' => 'E-Mail Empfänger',
    'update.email_receivers_help' => 'Hier aufgeführte Administratoren empfangen die automatisch versandten E-Mails & Kontaktanfragen der Webapplikation.',
    'update.error.select_at_least_one' => 'Zumindest ein Benutzer muss aktiviert sein.',
    'update.error.cannot_deactive_self' => 'Sie können sich nicht selber deaktivieren.',
  ),
  'contact' => 
  array (
    'index.title' => 'Administrator kontaktieren',
    'index.description' => 'Benachrichtigen Sie den Administrator.',
    'index.send_mail' => 'kontaktieren',
    'index.success.email_sent' => 'Der Administrator wurde kontaktiert.',
    'contact_email.subject' => 'Kontaktanfrage erhalten',
    'contact_email.description' => 'Sie haben auf %url% eine Kontaktanfrage erhalten.

Email:
%email%

Name:
%name%

Nachricht:
%message%',
  ),
  'entity_frontend_user' => 
  array (
    'entity.name' => 'Benutzer',
    'entity.description' => 'Benutzer können sich einloggen und mit der Anwendung interagieren',
    'entity.plural' => 'Benutzer',
    'entity.user_trait' => 'Account',
  ),
  'entity_setting' => 
  array (
    'max_show_users_in_list' => 'Maximale Benutzer dargestellt im Adminbereich',
    'entity.name' => 'Einstellung',
    'entity.description' => 'Eine Einstellung konfiguriert die Webapplikation',
  ),
  'enum_boolean_type' => 
  array (
    'yes' => 'Ja',
    'no' => 'Nein',
  ),
  'enum_email_type' => 
  array (
    'text_email' => 'Nachricht',
    'plain_email' => 'Kurznachricht ohne übliches E-Mail Layout',
    'action_email' => 'Nachricht mit Call-To-Action',
  ),
  'enum_message_type' => 
  array (
    'info' => 'info',
    'warning' => 'warning',
    'error' => 'error',
    'fatal' => 'fatal',
  ),
  'error' => 
  array (
    'error.title' => 'Fehler',
    'error.description' => 'Diese Seite existiert nicht oder kann nicht angezeigt werden',
    'error.404' => 'Diese Seite wurde nicht gefunden',
    'error.fallback' => 'Ein Problem hat verhindert dass diese Anfrage ausgeführt werden konnte',
    'error.500' => 'Ein kritischer Fehler ist bei der Ausführung Ihrer Anfrage aufgetreten. Probieren sie es am Besten einfach noch einmal. Besteht das Problem weiterhin nehmen Sie mit uns Kontakt auf.',
    'error.back_to_homepage' => 'Hier geht\'s zurück zur Startseite',
  ),
  'form_generic' => 
  array (
  ),
  'framework' => 
  array (
    'time.format.date_time' => 'd.m.Y H:i',
    'time.format.date' => 'd.m.Y',
    'time.weekdays.Mon' => 'Mo',
    'time.weekdays.Tue' => 'Di',
    'time.weekdays.Wed' => 'Mi',
    'time.weekdays.Thu' => 'Do',
    'time.weekdays.Fri' => 'Fr',
    'time.weekdays.Sat' => 'Sa',
    'time.weekdays.Sun' => 'So',
    'form.error.validation_failed' => 'Die Verarbeitung konnte nicht abgeschlossen werden. Sind alle benötigten Felder richtig ausgefüllt?',
    'form.successful.created' => 'Erfolgreich hinzugefügt',
    'form.successful.updated' => 'Erfolgreich gespeichert',
    'form.successful.deleted' => 'Erfolgreich entfernt',
    'form.submit_buttons.create' => 'erstellen',
    'form.submit_buttons.update' => 'speichern',
    'form.submit_buttons.delete' => 'entfernen',
    'form.fields.confirm_consequences' => 'Ich verstehe, das ich dies nicht rückgängig machen kann.',
    'email.wrongly_displayed' => 'Wird diese Mail nicht richtig dargestellt? Klicken Sie hier.',
    'email.is_generated' => 'Bitte antworten Sie nicht auf dieses automatisch generierte E-Mail.',
    'email.questions' => 'Administrator kontaktieren',
  ),
  'index' => 
  array (
    'index.title' => 'Willkommen',
    'index.description' => 'Hier ist noch nichts',
  ),
  'layout' => 
  array (
    'base.brand' => 'example.com',
  ),
  'login' => 
  array (
    'login.title' => 'Login',
    'login.description' => 'Willkommen zurück!',
    'login.problems_with_login' => 'Probleme beim Einloggen?',
    'login.do_login' => 'einloggen',
    'login.error.login_failed' => 'Login fehlgeschlagen',
    'login.error.email_not_found' => 'Diese E-Mail wurde nicht gefunden.',
    'login.error.login_disabled' => 'Ihr Account wurde vom Administrator deaktiviert.',
    'recover.title' => 'Passwort zurücksetzen',
    'recover.description' => 'Setzen Sie Ihr Passwort mit Ihrer E-Mail zurück',
    'recover.use_login_email' => 'Geben Sie die E-Mail ein, die Sie beim Login verwenden. Wir senden Ihnen dann einen Link zu, mit dem Sie das Passwort neu setzen können.',
    'recover.send_email' => 'E-Mail zusenden',
    'recover.success.email_sent' => 'Wir haben Ihnen soeben eine E-Mail versandt.',
    'recover.danger.email_not_found' => 'Diese E-Mail wurde nicht in unserem System gefunden.',
    'recover.email.reset_password.subject' => 'Passwort zurücksetzen',
    'recover.email.reset_password.message' => 'Sie können mit dem Knopf unten Ihr Passwort zurücksetzen. Haben Sie dieses E-Mail nicht angefordert, können Sie es ignorieren.',
    'recover.email.reset_password.action_text' => 'Jetzt Passwort zurücksetzen',
    'reset.title' => 'Passwort setzen',
    'reset.description' => 'Setzen Sie Ihr neues Passwort',
    'reset.success.password_set' => 'Neues Passwort erfolgreich gesetzt. Willkommen zurück :)',
    'reset.error.invalid_hash' => 'Dieser Link ist nicht mehr gültig. Beachten Sie, das jeder Link nur einmal benutzt werden kann.',
  ),
  'model_contact_request' => 
  array (
    'name' => 'Name',
    'email' => 'Email',
    'message' => 'Nachricht',
    'entity.name' => 'Kontaktanfrage',
    'entity.description' => 'Nehmen Sie Kontakt mit uns auf',
  ),
  'register' => 
  array (
    'index.title' => 'Registrieren',
    'index.description' => 'Erhalten Sie Zugriff',
    'index.success.registered' => 'Sie wurden erfolgreich registriert. Willkommen :).',
    'index.error.email_already_in_use' => 'Diese E-Mail wird bereits verwendet. Sie können das Passwort zurücksetzen, falls dies Ihre E-Mail ist.',
  ),
  'trait_address' => 
  array (
    'address' => 'Adresse',
    'street' => 'Strasse',
    'street_nr' => 'Hausnummer',
    'address_line' => 'Adresszeile 2',
    'postal_code' => 'Postleitzahl',
    'city' => 'Stadt',
    'country' => 'Land',
    'address_lines' => 'Adresse',
    'trait.name' => 'Adresse',
  ),
  'trait_change_aware' => 
  array (
    'last_changed_at' => 'Zuletzt geändert um',
    'last_changed_by' => 'Zuletzt geändert von',
    'trait.name' => 'Letzte Änderungen',
  ),
  'trait_communication' => 
  array (
    'phone' => 'Telefonnummer',
    'email' => 'Email',
    'trait.name' => 'Kontaktinformationen',
  ),
  'trait_event' => 
  array (
    'is_confirmed' => 'bestätigt',
    'confirm_date_time' => 'Bestätigt um',
    'confirmed_by' => 'Bestätigt von',
    'last_remainder_email_sent' => 'Letztes Erinnerungsemail versandt',
    'trait.name' => 'Termin',
  ),
  'trait_invitation' => 
  array (
    'last_invitation' => 'letzte Einladung versandt',
    'trait.name' => 'Einladung',
  ),
  'trait_person' => 
  array (
    'given_name' => 'Vorname',
    'family_name' => 'Nachname',
    'full_name' => 'Name',
    'trait.name' => 'Name',
  ),
  'trait_start_end' => 
  array (
    'start_date_time' => 'Anfang',
    'end_date_time' => 'Ende',
    'trait.name' => 'Anfangs- und Endzeiten',
  ),
  'trait_thing' => 
  array (
    'name' => 'Name',
    'description' => 'Beschreibung',
    'trait.name' => 'Objekt',
  ),
  'trait_user' => 
  array (
    'password' => 'Passwort',
    'plain_password' => 'Passwort',
    'repeat_plain_password' => 'Passwort wiederholen',
    'email' => 'Email',
    'can_login' => 'Login erlaubt',
    'last_login' => 'Letzer Login',
    'trait.name' => 'Benutzer',
    'error.passwords_do_not_match' => 'Die Passwörter stimmen nicht überein',
    'error.password_needs_at_least_8_chars' => 'Das Passwort ist zu kurz. Bitte verwenden Sie mindestens 8 Stellen.',
  ),
));


return $catalogue;
