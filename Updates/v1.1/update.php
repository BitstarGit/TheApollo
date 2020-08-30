<?php
if (file_exists('./assets/init.php')) {
    require_once('./assets/init.php');
} else {
    die('Please put this file in the home directory !');
}
function PT_UpdateLangs($lang, $key, $value) {
    global $sqlConnect;
    $update_query         = "UPDATE langs SET `{lang}` = '{lang_text}' WHERE `lang_key` = '{lang_key}'";
    $update_replace_array = array(
        "{lang}",
        "{lang_text}",
        "{lang_key}"
    );
    return str_replace($update_replace_array, array(
        $lang,
        mysqli_real_escape_string($sqlConnect, $value),
        $key
    ), $update_query);
}
$updated = false;
if (!empty($_GET['updated'])) {
    $updated = true;
}
if (!empty($_POST['query'])) {
    $query = mysqli_query($mysqli, base64_decode($_POST['query']));
    if ($query) {
        $data['status'] = 200;
    } else {
        $data['status'] = 400;
        $data['error']  = mysqli_error($mysqli);
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if (!empty($_POST['update_langs'])) {
    $data  = array();
    $query = mysqli_query($sqlConnect, "SHOW COLUMNS FROM `langs`");
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data['Field'];
    }
    unset($data[0]);
    unset($data[1]);
    $lang_update_queries = array();
    foreach ($data as $key => $value) {
        $value = ($value);
        if ($value == 'arabic') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'الرسائل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'رائع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'فكونتاكتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'حدد نوع الجنس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'تحديد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'حدد نوع الجنس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'باي بال');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'التحويل المصرفي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'بطاقة ائتمان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'اسم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'رقم البطاقة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'دفع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'تصفح للتحميل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'جدد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'التأكيد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'تم الحذف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'عملة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'اختر وسيلة الدفع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'خطأ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'نص الخروج');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'عنوان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'مدينة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'حالة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'رقم الهاتف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'نعم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'لم يتم العثور على رسائل ، يرجى اختيار مستخدم للدردشة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'لم يتم العثور على مستخدمين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'دردشة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'تحميل المزيد من الرسائل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'اكتب رسالة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'هل أنت متأكد أنك تريد حذف هذه الدردشة؟');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'لم يتم العثور على رسائل ، قل مرحباً!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'يرجى التحقق من التفاصيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'لتأكيد الدفع ، يرجى الانتظار ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'تم رفض الدفع ، يرجى المحاولة مرة أخرى في وقت لاحق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'التحقق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'حدد معرف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'رسالة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'تقديم الطلب');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'الملف كبير جدًا ، يرجى تجربة ملف آخر.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'تم التحقق منك الآن.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'غير نشط');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'عضو محترف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'عضو مجاني');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'نوع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'مشرف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'تم التحقق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'لم يتم التحقق منها');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'حد تحميل المستخدم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'سحب النص');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'اختر وسيلة الدفع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'هل أنت متأكد أنك تريد حذف هذه الدردشة؟');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'تم إرسال طلب التحقق الخاص بك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'قم بتحميل المعرف الخاص بك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'حدد ملف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'أرسل طلبك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'طلب التحقق الخاص بك لا يزال معلقًا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'تم إرسال طلب الدفع المصرفي الخاص بك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'حدد المعرف الخاص بك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'هاتف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'ممكن');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'تعطيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', 'تم تحديث الإعدادات بنجاح!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'الرجاء مراجعة التفاصيل الخاصة بك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'لقد أرسلنا لك بريدًا إلكترونيًا يحتوي على رمز التأكيد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'تم إرسال رسالة تأكيد.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'لقد أرسلنا رسالة تحتوي على رمز التأكيد لتمكين المصادقة الثنائية.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'تأكيد الكود');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'تم التحقق من رقم هاتفك بنجاح.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'شكرا لك ، دفعتك كانت ناجحة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'صورة مصغرة مخصصة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'تم رفض الدفع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'دفع');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'التحقق من الدفع');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'Berichten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'VKontakte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Select Gender');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'Selecteer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Selecteer geslacht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Overschrijving');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Kredietkaart');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'Naam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Kaartnummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Betalen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Uploaden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Bijvullen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Bedrag');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Bevestiging');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Verwijderd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'Valuta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Abonneren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Kies betalingsmethode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'Fout');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'afreken tekst');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'adres');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'stad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'staat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'zip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefoonnummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'Nee');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'Ja');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'Er zijn geen berichten gevonden. Kies een gebruiker om te chatten.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Geen gebruikers gevonden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Chat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Laad meer berichten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Schrijf een bericht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'Weet u zeker dat u deze chat wilt verwijderen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Controleer de details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Uw betaling wordt bevestigd, even geduld ...');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Betaling geweigerd. Probeer het later opnieuw.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'Verificatie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', 'Upload-ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'Selecteer ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'Bericht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'Aanvraag indienen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'Het bestand is te groot, probeer een ander bestand.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'je bent nu geverifieerd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Verificatieverzoek ontvangen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'inactief');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'Pro-lid');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'Gebruiker');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'beheerder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Geverifieerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'niet geverifieerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'Limiet gebruikersupload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Bekijk tekst');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Kies betalingsmethode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'Weet u zeker dat u deze chat wilt verwijderen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Uw verificatieverzoek is verzonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Upload uw ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Selecteer bestand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Dien uw verzoek in');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Uw verificatieverzoek is nog in behandeling');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Uw betalingsverzoek is verzonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Selecteer uw ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Twee-factor-authenticatie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Telefoon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Inschakelen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'Telefoonnummer moet de volgende notatie hebben: +90 ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'Check alsjeblieft je gegevens.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', 'Er is iets misgegaan, probeer het later opnieuw.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'We hebben je een e-mail gestuurd met de bevestigingscode.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Er is een bevestigingsbericht verzonden.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We hebben een bericht gestuurd met de bevestigingscode om tweefactorauthenticatie mogelijk te maken.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Bevestigingscode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Uw telefoonnummer is succesvol geverifieerd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Bedankt. Uw betaling is gelukt.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Aangepaste miniatuur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Betaling geweigerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Betaling');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Betalingsverificatie');
        } else if ($value == 'french') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'messages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'VKontakte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Sélectionnez le sexe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'Sélectionner');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Sélectionnez le sexe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'Pay Pal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Virement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Carte de crédit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'Nom');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Numéro de carte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Payer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Télécharger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Parcourir pour télécharger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Remplir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Montant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Supprimé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'Devise');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', 'Location');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Souscrire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Choisissez le mode de paiement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'Erreur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'texte de paiement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'Etat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Zip *: français');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Numéro de téléphone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'Non');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'Oui');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'Aucun message n\'a été trouvé, veuillez choisir un utilisateur pour discuter.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Bavarder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Charger plus de messages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Écrire un message');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'Voulez-vous vraiment supprimer ce chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'Aucun message n\'a été trouvé, dites Salut!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Veuillez vérifier les détails');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirmation de votre paiement, veuillez patienter.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Paiement refusé, veuillez réessayer plus tard.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'Vérification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'Sélectionnez ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'Message');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'Envoyer la demande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'Le fichier est trop volumineux, veuillez en essayer un autre.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'vous êtes maintenant vérifié.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Demande de vérification reçue.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'Membre gratuit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'Utilisateur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'Administrateur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Vérifié');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'non vérifié');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'Limite de téléchargement utilisateur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Extraire le texte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Choisissez le mode de paiement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'Voulez-vous vraiment supprimer ce chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Votre demande de vérification a été envoyée.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Téléchargez votre identifiant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Choisir le dossier');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Soumettez votre demande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Votre demande de vérification est toujours en attente');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Votre demande de paiement bancaire a été envoyée.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Sélectionnez votre identifiant');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Authentification à deux facteurs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Téléphone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Activer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'Le numéro de téléphone doit être au format suivant: +90 ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'S\'il vous plaît vérifier vos informations.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Nous vous avons envoyé un email avec le code de confirmation.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Nous avons envoyé un message contenant le code de confirmation pour activer l\'authentification à deux facteurs.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Code de confirmation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Votre numéro de téléphone a été vérifié avec succès.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Merci, votre paiement a été effectué avec succès.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Miniature personnalisée');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Paiement refusé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Paiement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Vérification des paiements');
        } else if ($value == 'german') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'Mitteilungen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'VKontakte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Wähle Geschlecht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'Wählen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Wähle Geschlecht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Banküberweisung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Kreditkarte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Kartennummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Zahlen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Hochladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Zum Hochladen navigieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Auffüllen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Menge');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Bestätigung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Gelöscht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'Währung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', 'Miete');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Abonnieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Zahlungsart auswählen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'Error');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'Checkout-Text');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'Adresse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'Stadt');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'Zustand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Postleitzahl');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefonnummer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'Nein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'Ja');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'Es wurden keine Nachrichten gefunden. Bitte wählen Sie einen Benutzer zum Chatten aus.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Keine Benutzer gefunden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Plaudern');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Laden Sie weitere Nachrichten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Nachricht schreiben');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'Möchten Sie diesen Chat wirklich löschen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'Es wurden keine Nachrichten gefunden, sagen Sie Hallo!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Bitte überprüfen Sie die Details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Bestätigen Sie Ihre Zahlung, bitte warten Sie ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Zahlung abgelehnt, bitte versuchen Sie es später erneut.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'Überprüfung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', 'ID hochladen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'ID auswählen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'Botschaft');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'Anfrage einreichen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'Die Datei ist zu groß, bitte versuchen Sie es mit einer anderen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'Sie sind jetzt verifiziert.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Bestätigungsanfrage erhalten.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'inaktiv');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'Pro Mitglied');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'Freies Mitglied');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Art');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'Benutzer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'Administrator');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verifiziert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'Nicht verifiziert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'Benutzer-Upload-Limit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Text auschecken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Zahlungsart auswählen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'Möchten Sie diesen Chat wirklich löschen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Ihre Bestätigungsanfrage wurde gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Laden Sie Ihre ID hoch');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Datei aussuchen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Senden Sie Ihre Anfrage');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Ihre Bestätigungsanfrage steht noch aus');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Ihre Bankzahlungsanforderung wurde gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Wählen Sie Ihre ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Zwei-Faktor-Authentifizierung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Telefon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Aktivieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Deaktivieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'Die Telefonnummer sollte das folgende Format haben: +90 ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', 'Einstellungen erfolgreich aktualisiert!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'Bitte überprüfe deine Details.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', 'Es ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Wir haben Ihnen eine E-Mail mit dem Bestätigungscode gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Eine Bestätigungsnachricht wurde gesendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Wir haben eine Nachricht gesendet, die den Bestätigungscode enthält, um die Zwei-Faktor-Authentifizierung zu aktivieren.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Bestätigungscode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Ihre Telefonnummer wurde erfolgreich überprüft.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Vielen Dank, Ihre Zahlung war erfolgreich.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Benutzerdefinierte Miniaturansicht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Zahlung abgelehnt');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Zahlung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Zahlungsüberprüfung');
        } else if ($value == 'russian') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'Сообщения');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'В Контакте');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Выберите пол');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'Выбрать');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Выберите пол');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Банковский перевод');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Кредитная карта');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'название');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Номер карты');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Оплатить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Загрузить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Просмотрите, чтобы загрузить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Восполнение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Количество');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'подтверждение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Исключен');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'валюта');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', 'Арендная плата');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Подписывайся');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Выберите способ оплаты');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'ошибка');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'текст оформления заказа');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'адрес');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'город');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'штат');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'застежка-молния');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Телефонный номер');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'нет');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'да');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'Сообщения не найдены, выберите пользователя для чата.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Пользователи не найдены');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Чат');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Загрузить больше сообщений');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Напиши сообщение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'Вы уверены, что хотите удалить этот чат?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'Сообщений не найдено. Передайте привет!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Пожалуйста, проверьте детали');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Подтверждение платежа, подождите ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Платеж отклонен, повторите попытку позже.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'верификация');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', 'ID загрузки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'Выберите ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'Сообщение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'Отправить запрос');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'Файл слишком большой, попробуйте другой.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'теперь вы проверены.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Запрос на подтверждение получен.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'неактивный');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'Член профи');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'Бесплатный член');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Тип');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'пользователь');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'Администратор');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Проверенный');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'не подтверждено');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'Лимит загрузки пользователей');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Проверить текст');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Выберите способ оплаты');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'Вы уверены, что хотите удалить этот чат?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Ваш запрос на подтверждение отправлен.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Загрузите свой идентификатор');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Выбрать файл');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Отправьте свой запрос');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Ваш запрос на подтверждение еще не принят');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Ваш запрос на банковский платеж отправлен.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Выберите свой ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Двухфакторная аутентификация');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Телефон');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'включить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Отключить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'Номер телефона должен быть в следующем формате: +90 ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', 'Настройки успешно обновлены!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'Пожалуйста, проверьте свои данные.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', 'Что-то пошло не так. Пожалуйста, повторите попытку позже.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Мы отправили вам электронное письмо с кодом подтверждения.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Было отправлено подтверждающее сообщение.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Мы отправили сообщение, содержащее код подтверждения для включения двухфакторной аутентификации.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Код подтверждения');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Ваш номер телефона успешно подтвержден.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Спасибо, ваш платеж прошел успешно.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Пользовательский эскиз');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Платеж отклонен');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Оплата');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Подтверждение платежа');
        } else if ($value == 'spanish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'Mensajes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'VKontakte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Seleccione género');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'Seleccione');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Seleccione género');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Transferencia bancaria');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Tarjeta de crédito');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'Nombre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Número de tarjeta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Pagar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Subir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Navegar para subir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Reponer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Cantidad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Eliminado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'Moneda');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', 'Alquilar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Suscribir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Elige el método de pago');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'Error');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'texto de pago');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'habla a');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'ciudad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'estado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'Código Postal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Número de teléfono');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'No');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'si');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'No se encontraron mensajes, elija un usuario para chatear.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'No se encontraron usuarios');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Charla');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Cargar más mensajes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Escribe un mensaje');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', '¿Estás seguro de que deseas eliminar este chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'No se encontraron mensajes, di ¡Hola!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Por favor revise los detalles');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirmando su pago, espere ...');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Pago rechazado. Vuelva a intentarlo más tarde.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'Verificación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', 'Cargar ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'Seleccionar ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'Mensaje');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'Enviar peticion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'El archivo es demasiado grande, pruebe con otro.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'ahora está verificado.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Se recibió la solicitud de verificación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'inactivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'Miembro Pro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'miembro gratuito');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Tipo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'Usuario');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'Administración');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verificado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'No verificado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'Límite de carga del usuario');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Ver texto');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Elige el método de pago');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', '¿Estás seguro de que deseas eliminar este chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Su solicitud de verificación ha sido enviada.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Cargue su ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Seleccione Archivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Envíe su solicitud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Su solicitud de verificación aún está pendiente');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Su solicitud de pago bancaria ha sido enviada.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Seleccione su ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Autenticación de dos factores');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Teléfono');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Habilitar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Inhabilitar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'El número de teléfono debe tener este formato: +90 ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', '¡Configuración actualizada correctamente!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'Por favor comprueba tus detalles.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', 'Se produjo un error. Vuelve a intentarlo más tarde.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Le hemos enviado un correo electrónico con el código de confirmación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Se envió un mensaje de confirmación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'Hemos enviado un mensaje que contiene el código de confirmación para habilitar la autenticación de dos factores.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Código de confirmación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Su número de teléfono se ha verificado correctamente.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Gracias, su pago se realizó correctamente.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Miniatura personalizada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Pago rechazado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Pago');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Verificación de pago');
        } else if ($value == 'turkish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'Mesajlar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'VKontakte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Cinsiyet seç');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'seçmek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Cinsiyet seç');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Banka transferi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Kredi kartı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'ad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Kart numarası');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Ödemek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Yükleme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Yüklemek için göz atın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Yenileyici');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Miktar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Onayla');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'silindi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'Para birimi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', 'Kira');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Abone ol');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Ödeme yöntemini seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'Hata');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'ödeme metni');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'adres');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'Kent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'durum');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'zip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Telefon numarası');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'Hayır');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'Evet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'Mesaj bulunamadı, lütfen sohbet etmek için bir kullanıcı seçin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'Kullanıcı bulunamadı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Sohbet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Daha fazla mesaj yükle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Mesaj Yaz');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'Bu sohbeti silmek istediğinizden emin misiniz?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'Mesaj bulunamadı, Merhaba deyin!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Lütfen ayrıntıları kontrol edin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Ödemenizi onaylıyoruz, lütfen bekleyin ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Ödeme reddedildi, lütfen daha sonra tekrar deneyin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'Doğrulama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', 'ID yükle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'Kimlik seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'İleti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'İstek gönderin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'Dosya çok büyük, lütfen başka bir tane deneyin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'şimdi doğrulandınız.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Doğrulama talebi alındı.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'pasif');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'Pro Üye');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'Ücretsiz Üye');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'tip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'kullanıcı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'yönetim');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Doğrulanmış');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'Doğrulanmadı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'Kullanıcı Yükleme Sınırı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Metni Kontrol Et');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Ödeme yöntemini seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'Bu sohbeti silmek istediğinizden emin misiniz?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Doğrulama talebiniz gönderildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Kimliğinizi Yükleyin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Dosya Seç');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Talebinizi Gönderin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Doğrulama İsteğiniz Hala Beklemede');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Banka ödeme talebiniz gönderildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Kimliğinizi Seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'İki faktörlü kimlik doğrulama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Telefon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'etkinleştirme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Devre Dışı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'Telefon numarası şu biçimde olmalıdır: +90 ..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', 'Ayarlar başarıyla güncellendi!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'Lütfen bilgilerinizi kontrol edin.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', 'Bir şeyler yanlış oldu. Lütfen sonra tekrar deneyiniz.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'Size onay kodunu içeren bir e-posta gönderdik.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'Bir onay mesajı gönderildi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'İki faktörlü kimlik doğrulamayı etkinleştirmek için onay kodunu içeren bir mesaj gönderdik.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Onay kodu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Telefon numaranız başarıyla doğrulandı.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Teşekkürler, ödemeniz başarılı oldu.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Özel Küçük Resim');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Ödeme Reddedildi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Ödeme');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Ödeme Doğrulaması');
        } else if ($value == 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'Messages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'VKontakte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Select gender');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'Select');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Select gender');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Bank Transfer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Credit Card');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Card Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Pay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Browse to upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Replenish');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Amount');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Deleted');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'Currency');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', 'Rent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Subscribe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Choose Payment Method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'Error');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'checkout text');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'address');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'city');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'state');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'zip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Phone Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'No');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'Yes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'No messages were found, please choose a user to chat.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'No users found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Chat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Load more messages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Write message');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'Are you sure you want to delete this chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'No messages were found, say Hi!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Please check the details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirming your payment, please wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Payment declined, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'Verification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', 'Upload ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'Select ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'Message');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'Submit Request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'The file is too big, please try another one.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'you are now verified.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Verification request received.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'inactive');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'Pro Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'Free Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'User');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'Admin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verified');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'Not verified');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'User Upload Limit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Check Out Text');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Chose Payment Method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'Are you sure you want to delete this chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Your verification request has been sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Upload Your ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Select File');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Submit Your Request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Your Verification Request Is Still Pending');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Your bank payment request has been sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Select Your ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Two-factor authentication');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Phone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Enable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Disable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'Phone number should be as this format: +90..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', 'Settings successfully updated!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'Please check your details.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', 'Something went wrong, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'We have sent you an email with the confirmation code.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'A confirmation message was sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent a message that contains the confirmation code to enable Two-factor authentication.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Confirmation code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Your phone number has been successfully verified.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Thank you, Your payment was successful.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Custom Thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Payment declined');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Payment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Payment Verification');
        } else if ($value != 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'messages', 'Messages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'wowonder', 'WoWonder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'vkontakte', 'VKontakte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_gender', 'Select gender');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select', 'Select');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select__gender', 'Select gender');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paypal', 'PayPal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_transfer', 'Bank Transfer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'credit_card', 'Credit Card');
            $lang_update_queries[] = PT_UpdateLangs($value, 'name', 'Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_number', 'Card Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay', 'Pay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload', 'Upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'browse_to_upload', 'Browse to upload');
            $lang_update_queries[] = PT_UpdateLangs($value, 'replenish', 'Replenish');
            $lang_update_queries[] = PT_UpdateLangs($value, 'amount', 'Amount');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation', 'Confirmation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'deleted', 'Deleted');
            $lang_update_queries[] = PT_UpdateLangs($value, 'currency', 'Currency');
            $lang_update_queries[] = PT_UpdateLangs($value, 'rent', 'Rent');
            $lang_update_queries[] = PT_UpdateLangs($value, 'subscribe', 'Subscribe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_payment_method', 'Choose Payment Method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'error', 'Error');
            $lang_update_queries[] = PT_UpdateLangs($value, 'checkout_text', 'checkout text');
            $lang_update_queries[] = PT_UpdateLangs($value, 'address', 'address');
            $lang_update_queries[] = PT_UpdateLangs($value, 'city', 'city');
            $lang_update_queries[] = PT_UpdateLangs($value, 'state', 'state');
            $lang_update_queries[] = PT_UpdateLangs($value, 'zip', 'zip');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number', 'Phone Number');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no', 'No');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yes', 'Yes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__please_choose_a_channel_to_chat.', 'No messages were found, please choose a user to chat.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_users_found', 'No users found');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chat', 'Chat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'load_more_messages', 'Load more messages');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_message', 'Write message');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_delete_chat', 'Are you sure you want to delete this chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_messages_were_found__say_hi_', 'No messages were found, say Hi!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_the_details', 'Please check the details');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirming_your_payment__please_wait..', 'Confirming your payment, please wait..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined__please_try_again_later.', 'Payment declined, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification', 'Verification');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_id', 'Upload ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_id', 'Select ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'message', 'Message');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_request', 'Submit Request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'file_is_too_big', 'The file is too big, please try another one.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'u_are_verified', 'you are now verified.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_request_received', 'Verification request received.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'inactive', 'inactive');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pro_mbr', 'Pro Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'free_mbr', 'Free Member');
            $lang_update_queries[] = PT_UpdateLangs($value, 'type', 'Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user', 'User');
            $lang_update_queries[] = PT_UpdateLangs($value, 'admin', 'Admin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verified');
            $lang_update_queries[] = PT_UpdateLangs($value, 'not_verified', 'Not verified');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user_upload_limit', 'User Upload Limit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_out_text', 'Check Out Text');
            $lang_update_queries[] = PT_UpdateLangs($value, 'chose_payment_method', 'Chose Payment Method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_delete_the_chat', 'Are you sure you want to delete this chat?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verif_sent', 'Your verification request has been sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'upload_your_id', 'Upload Your ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_file', 'Select File');
            $lang_update_queries[] = PT_UpdateLangs($value, 'submit_your_request', 'Submit Your Request');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verification_request_is_still_pending', 'Your Verification Request Is Still Pending');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank_payment_request_sent', 'Your bank payment request has been sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'select_your_id', 'Select Your ID');
            $lang_update_queries[] = PT_UpdateLangs($value, 'two-factor_authentication', 'Two-factor authentication');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone', 'Phone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'enable', 'Enable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'disable', 'Disable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'phone_number_should_be_as_this_format___90..', 'Phone number should be as this format: +90..');
            $lang_update_queries[] = PT_UpdateLangs($value, 'settings_successfully_updated_', 'Settings successfully updated!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_check_your_details.', 'Please check your details.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'something_went_wrong__please_try_again_later.', 'Something went wrong, please try again later.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_you_an_email_with_the_confirmation_code.', 'We have sent you an email with the confirmation code.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'a_confirmation_message_was_sent.', 'A confirmation message was sent.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.', 'We have sent a message that contains the confirmation code to enable Two-factor authentication.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'confirmation_code', 'Confirmation code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_phone_number_has_been_successfully_verified.', 'Your phone number has been successfully verified.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'card_charged', 'Thank you, Your payment was successful.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'custom_thumbnail', 'Custom Thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_declined', 'Payment declined');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment', 'Payment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'payment_verification', 'Payment Verification');
        }
    }
    if (!empty($lang_update_queries)) {
        foreach ($lang_update_queries as $key => $query) {
            $sql = mysqli_query($mysqli, $query);
        }
    }
    $query = mysqli_query($sqlConnect, "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'bank_description', '" . htmlspecialchars_decode('<div class="bank_info"><div class="dt_settings_header bg_gradient"><div class="dt_settings_circle-1"></div><div class="dt_settings_circle-2"></div><div class="bank_info_innr"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z"></path></svg><h4 class="bank_name">Garanti Bank</h4><div class="row"><div class="col col-md-12"><div class="bank_account"><p>4796824372433055</p><span class="help-block">Account number / IBAN</span></div></div><div class="col col-md-12"><div class="bank_account_holder"><p>Antoian Kordiyal</p><span class="help-block">Account name</span></div></div><div class="col col-md-6"><div class="bank_account_code"><p>TGBATRISXXX</p><span class="help-block">Routing code</span></div></div><div class="col col-md-6"><div class="bank_account_country"><p>United States</p><span class="help-block">Country</span></div></div></div></div></div></div>') . "')");
    $name  = md5(microtime()) . '_updated.php';
    rename('update.php', $name);
}
?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Updating AskMe</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <style>
         @import url('https://fonts.googleapis.com/css?family=Roboto:400,500');
         @media print {
            .wo_update_changelog {max-height: none !important; min-height: !important}
            .btn, .hide_print, .setting-well h4 {display:none;}
         }
         * {outline: none !important;}
         body {background: #f3f3f3;font-family: 'Roboto', sans-serif;}
         .light {font-weight: 400;}
         .bold {font-weight: 500;}
         .btn {height: 52px;line-height: 1;font-size: 16px;transition: all 0.3s;border-radius: 2em;font-weight: 500;padding: 0 28px;letter-spacing: .5px;}
         .btn svg {margin-left: 10px;margin-top: -2px;transition: all 0.3s;vertical-align: middle;}
         .btn:hover svg {-webkit-transform: translateX(3px);-moz-transform: translateX(3px);-ms-transform: translateX(3px);-o-transform: translateX(3px);transform: translateX(3px);}
         .btn-main {color: #ffffff;background-color: #0CA678;border-color: #0CA678;}
         .btn-main:disabled, .btn-main:focus {color: #fff;}
         .btn-main:hover {color: #ffffff;background-color: #0dcde2;border-color: #0dcde2;box-shadow: -2px 2px 14px rgba(168, 72, 73, 0.35);}
         svg {vertical-align: middle;}
         .main {color: #0CA678;}
         .wo_update_changelog {
          border: 1px solid #eee;
          padding: 10px !important;
         }
         .content-container {display: -webkit-box; width: 100%;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-flex-direction: column;flex-direction: column;min-height: 100vh;position: relative;}
         .content-container:before, .content-container:after {-webkit-box-flex: 1;box-flex: 1;-webkit-flex-grow: 1;flex-grow: 1;content: '';display: block;height: 50px;}
         .wo_install_wiz {position: relative;background-color: white;box-shadow: 0 1px 15px 2px rgba(0, 0, 0, 0.1);border-radius: 10px;padding: 20px 30px;border-top: 1px solid rgba(0, 0, 0, 0.04);}
         .wo_install_wiz h2 {margin-top: 10px;margin-bottom: 30px;display: flex;align-items: center;}
         .wo_install_wiz h2 span {margin-left: auto;font-size: 15px;}
         .wo_update_changelog {padding:0;list-style-type: none;margin-bottom: 15px;max-height: 440px;overflow-y: auto; min-height: 440px;}
         .wo_update_changelog li {margin-bottom:7px; max-height: 20px; overflow: hidden;}
         .wo_update_changelog li span {padding: 2px 7px;font-size: 12px;margin-right: 4px;border-radius: 2px;}
         .wo_update_changelog li span.added {background-color: #4CAF50;color: white;}
         .wo_update_changelog li span.changed {background-color: #e62117;color: white;}
         .wo_update_changelog li span.improved {background-color: #9C27B0;color: white;}
         .wo_update_changelog li span.compressed {background-color: #795548;color: white;}
         .wo_update_changelog li span.fixed {background-color: #2196F3;color: white;}
         input.form-control {background-color: #f4f4f4;border: 0;border-radius: 2em;height: 40px;padding: 3px 14px;color: #383838;transition: all 0.2s;}
input.form-control:hover {background-color: #e9e9e9;}
input.form-control:focus {background: #fff;box-shadow: 0 0 0 1.5px #a84849;}
         .empty_state {margin-top: 80px;margin-bottom: 80px;font-weight: 500;color: #6d6d6d;display: block;text-align: center;}
         .checkmark__circle {stroke-dasharray: 166;stroke-dashoffset: 166;stroke-width: 2;stroke-miterlimit: 10;stroke: #7ac142;fill: none;animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;}
         .checkmark {width: 80px;height: 80px; border-radius: 50%;display: block;stroke-width: 3;stroke: #fff;stroke-miterlimit: 10;margin: 100px auto 50px;box-shadow: inset 0px 0px 0px #7ac142;animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;}
         .checkmark__check {transform-origin: 50% 50%;stroke-dasharray: 48;stroke-dashoffset: 48;animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;}
         @keyframes stroke { 100% {stroke-dashoffset: 0;}}
         @keyframes scale {0%, 100% {transform: none;}  50% {transform: scale3d(1.1, 1.1, 1); }}
         @keyframes fill { 100% {box-shadow: inset 0px 0px 0px 54px #7ac142; }}
      </style>
   </head>
   <body>
      <div class="content-container container">
         <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
               <div class="wo_install_wiz">
                 <?php if ($updated == false) { ?>
                  <div>
                     <h2 class="light">Update to v1.1 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                            <li>[Added] OG meta tags for questions and profiles. </li>
                            <li>[Added] digtialocean, google cloud storage storages.</li>
                            <li>[Added] stripe payment method.</li>
                            <li>[Added] bank payment method.</li>
                            <li>[Added] ability to search in admin panel. </li>
                            <li>[Added] APIs for each feature.</li>
                            <li>[Added] ability to fetch link data in posts. </li>
                            <li>[Added] messages system. </li>
                            <li>[Added] custom pages. </li>
                            <li>[Added] invitation system</li>
                            <li>[Added] mass notifications. </li>
                            <li>[Added] emojies to post and messages. </li>
                            <li>[Added] two auth system. </li>
                            <li>[Added] verfication system. </li>
                            <li>[Added] ability to login with social login + wowonder. </li>
                            <li>[Added] auto follow system. </li>
                            <li>[Added] ability to sending email to users. </li>
                            <li>[Fixed] bugs in few features. </li>
                        </ul>
                        <p class="hide_print">Note: The update process might take few minutes.</p>
                        <p class="hide_print">Important: If you got any fail queries, please copy them, open a support ticket and send us the details.</p>
                        <br>
                             <button class="pull-right btn btn-default" onclick="window.print();">Share Log</button>
                             <button type="button" class="btn btn-main" id="button-update">
                             Update 
                             <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                                <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path>
                             </svg>
                          </button>
                     </div>
                     <?php }?>
                     <?php if ($updated == true) { ?>
                      <div>
                        <div class="empty_state">
                           <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                           </svg>
                           <p>Congratulations, you have successfully updated your site. Thanks for choosing AskMe.</p>
                           <br>
                           <a href="<?php echo $wo['config']['site_url'] ?>" class="btn btn-main" style="line-height:50px;">Home</a>
                        </div>
                     </div>
                     <?php }?>
                  </div>
               </div>
            </div>
            <div class="col-md-1"></div>
         </div>
      </div>
   </body>
</html>
<script>  
var queries = [
    "UPDATE config SET `value` = '1.1' WHERE `name` = 'version';",
    "ALTER TABLE `config` CHANGE `value` `value` VARCHAR(4000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'server', 'ajax'), (NULL, 'server', 'nodejs');",
    "ALTER TABLE questions CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;",
    "CREATE TABLE `bank_receipts` (`id` int(11) UNSIGNED NOT NULL,`user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',`description` tinytext,`price` varchar(50) NOT NULL DEFAULT '0',`mode` varchar(50) NOT NULL DEFAULT '',`track_id` varchar(50) CHARACTER SET utf8mb4 DEFAULT '',`approved` int(11) UNSIGNED NOT NULL DEFAULT '0',`receipt_file` varchar(250) NOT NULL DEFAULT '',`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,`approved_at` int(11) UNSIGNED NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `bank_receipts` ADD PRIMARY KEY (`id`);",
    "ALTER TABLE `bank_receipts` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'video_upload', 'on');",
    "CREATE TABLE `messages` (`id` int(11) NOT NULL,`from_id` int(11) NOT NULL DEFAULT '0',`to_id` int(11) NOT NULL DEFAULT '0',`text` text NOT NULL,`seen` int(11) NOT NULL DEFAULT '0',`time` int(11) NOT NULL DEFAULT '0',`from_deleted` int(11) NOT NULL DEFAULT '0',`to_deleted` int(11) NOT NULL DEFAULT '0',`sent_push` int(11) UNSIGNED NOT NULL DEFAULT '0',`notification_id` varchar(50) NOT NULL DEFAULT '',`type_two` varchar(32) NOT NULL DEFAULT '',`media` varchar(255) CHARACTER SET utf16 NOT NULL,`mediaFileName` varchar(200) CHARACTER SET utf16 NOT NULL,`mediaFileNames` varchar(200) CHARACTER SET utf8 DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "ALTER TABLE `messages` ADD PRIMARY KEY (`id`), ADD KEY `from_id` (`from_id`), ADD KEY `to_id` (`to_id`), ADD KEY `seen` (`seen`), ADD KEY `time` (`time`), ADD KEY `from_deleted` (`from_deleted`), ADD KEY `to_deleted` (`to_deleted`);",
    "ALTER TABLE `messages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "CREATE TABLE `verification_requests` (`id` int(11) NOT NULL,`user_id` int(11) NOT NULL DEFAULT '0',`name` varchar(200) NOT NULL DEFAULT '',`message` text,`media_file` text,`time` varchar(100) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `verification_requests` ADD PRIMARY KEY (`id`);",
    "ALTER TABLE `verification_requests` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'currency_symbol_array', 'a:10:{s:3:\"USD\";s:1:\"$\";s:3:\"EUR\";s:3:\"€\";s:3:\"JPY\";s:2:\"¥\";s:3:\"TRY\";s:3:\"₺\";s:3:\"GBP\";s:2:\"£\";s:3:\"RUB\";s:6:\"руб\";s:3:\"PLN\";s:3:\"zł\";s:3:\"ILS\";s:3:\"₪\";s:3:\"BRL\";s:2:\"R$\";s:3:\"INR\";s:3:\"₹\";}');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'currency_array', 'a:10:{i:0;s:3:\"USD\";i:1;s:3:\"EUR\";i:2;s:3:\"JPY\";i:3;s:3:\"TRY\";i:4;s:3:\"GBP\";i:5;s:3:\"RUB\";i:6;s:3:\"PLN\";i:7;s:3:\"ILS\";i:8;s:3:\"BRL\";i:9;s:3:\"INR\";}');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'paypal_currency', 'Usd');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'checkout_currency', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'checkout_payment', 'no');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'checkout_mode', 'sandbox');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'checkout_seller_id', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'checkout_publishable_key', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'credit_card', 'no');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'stripe_currency', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'bank_payment', 'yes');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'bank_transfer_note', 'In order to confirm the bank transfer, you will need to upload a receipt or take a screenshot of your transfer within 1 day from your payment date. If a bank transfer is made but no receipt is uploaded within this period, your order will be cancelled. We will verify and confirm your receipt within 3 working days from the date you upload it.');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'server', 'ajax');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'verification_badge', 'on');",
    "ALTER TABLE `langs` DROP INDEX `lang_key_2`;",
    "ALTER TABLE `bank_receipts` ADD `promote_charge_amount` INT(11) NOT NULL  AFTER `approved_at`;",
    "ALTER TABLE `questions` CHANGE `question` `question` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;",
    "CREATE TABLE `conversations` (`id` int(11) NOT NULL,`user_one` int(11) NOT NULL DEFAULT 0,`user_two` int(11) NOT NULL DEFAULT 0,`time` int(11) NOT NULL DEFAULT 0) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "ALTER TABLE `conversations` ADD PRIMARY KEY (`id`);",
    "ALTER TABLE `conversations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'login_auth', '0'), (NULL, 'two_factor', '1'), (NULL, 'two_factor_type', 'email');",
    "ALTER TABLE `users` ADD `two_factor` INT(11) NOT NULL DEFAULT '0' AFTER `lng`, ADD `new_email` VARCHAR(255) NULL AFTER `two_factor`, ADD `two_factor_verified` INT(11) NOT NULL DEFAULT '0' AFTER `new_email`, ADD `new_phone` VARCHAR(32) NULL AFTER `two_factor_verified`, ADD `phone_number` VARCHAR(32) NULL AFTER `new_phone`;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'sms_phone_number', ''), (NULL, 'sms_twilio_password', ''), (NULL, 'sms_twilio_username', ''), (NULL, 'sms_t_phone_number', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'invite_links_system', '0');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'user_links_limit', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'expire_user_links', '');",
    "CREATE TABLE `admin_invitations` ( `id` int(11) NOT NULL, `code` varchar(300) NOT NULL DEFAULT '0', `posted` varchar(50) NOT NULL DEFAULT '0' ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `admin_invitations` ADD PRIMARY KEY (`id`), ADD KEY `code` (`code`(255));",
    "ALTER TABLE `admin_invitations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "ALTER TABLE `admin_invitations` ADD `status` INT(11) NULL DEFAULT '0' AFTER `posted`;",
    "CREATE TABLE `invitation_links` ( `id` int(11) NOT NULL, `user_id` int(11) NOT NULL DEFAULT '0', `invited_id` int(11) NOT NULL DEFAULT '0', `code` varchar(300) NOT NULL DEFAULT '', `time` int(50) NOT NULL DEFAULT '0' ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
    "ALTER TABLE `invitation_links` ADD PRIMARY KEY (`id`), ADD KEY `code` (`code`(255)), ADD KEY `invited_id` (`invited_id`), ADD KEY `time` (`time`), ADD KEY `user_id` (`user_id`);",
    "ALTER TABLE `invitation_links` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "CREATE TABLE `custom_pages` ( `id` int(11) NOT NULL, `page_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', `page_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', `page_content` text COLLATE utf8_unicode_ci, `page_type` int(11) NOT NULL DEFAULT '0' ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    "ALTER TABLE `custom_pages` ADD PRIMARY KEY (`id`);",
    "ALTER TABLE `custom_pages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'stripe_payment', 'on');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'stripe_version', ''), (NULL, 'stripe_secret', '');",
    "CREATE TABLE `payments` ( `id` int(11) NOT NULL, `user_id` int(11) NOT NULL DEFAULT '0', `amount` float NOT NULL DEFAULT '0', `type` varchar(15) NOT NULL DEFAULT '', `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, `pro_plan` varchar(100) DEFAULT '', `info` varchar(100) DEFAULT '0', `via` varchar(100) DEFAULT '' ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "ALTER TABLE `payments` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);",
    "ALTER TABLE `payments` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'spaces_key', ''), (NULL, 'spaces_secret', ''), (NULL, 'space_name', ''), (NULL, 'space_region', ''), (NULL, 'spaces', 'off'), (NULL, 'cloud_upload', 'off'), (NULL, 'cloud_file_path', ''), (NULL, 'cloud_bucket_name', '');",
    "ALTER TABLE `questions` ADD `postLink` VARCHAR(1000) NOT NULL AFTER `lng`, ADD `postLinkTitle` TEXT NULL AFTER `postLink`, ADD `postLinkContent` VARCHAR(100) NOT NULL AFTER `postLinkTitle`, ADD `postLinkImage` VARCHAR(1000) NOT NULL AFTER `postLinkContent`;",
    "ALTER TABLE `questions` CHANGE `postLink` `postLink` VARCHAR(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL;",
    "ALTER TABLE `questions` CHANGE `postLinkContent` `postLinkContent` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL;",
    "ALTER TABLE `questions` CHANGE `postLinkImage` `postLinkImage` VARCHAR(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL;",
    "CREATE TABLE `apps_sessions` ( `id` int(11) NOT NULL, `user_id` int(11) NOT NULL DEFAULT '0', `session_id` varchar(120) NOT NULL DEFAULT '', `platform` varchar(32) NOT NULL DEFAULT '', `platform_details` text, `time` int(11) NOT NULL DEFAULT '0' ) ENGINE=InnoDB DEFAULT CHARSET=latin1;",
    "ALTER TABLE `apps_sessions` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `session_id` (`session_id`), ADD KEY `user_id` (`user_id`), ADD KEY `platform` (`platform`);",
    "ALTER TABLE `apps_sessions` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'max_upload_all_users', '0');",
    "ALTER TABLE `questions` CHANGE `postLinkContent` `postLinkContent` VARCHAR(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL;",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'fileSharing', 'on');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'audio_upload', 'on');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'mime_types', 'text/plain,video/mp4,video/mov,video/mpeg,video/flv,video/avi,video/webm,audio/wav,audio/mpeg,video/quicktime,audio/mp3,image/png,image/jpeg,image/gif,application/pdf,application/msword,application/zip,application/x-rar-compressed,text/pdf,application/x-pointplus,text/css');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'allowedExtenstion', 'jpg,png,jpeg,gif,mkv,docx,zip,rar,pdf,doc,mp3,mp4,flv,wav,txt,mov,avi,webm,wav,mpeg,mp4');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'wowonder_domain_uri', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'vkontakte_domain_uri', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'wowonder_img', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'vkonktake_domain_uri', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'vkontakte_app_key', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'vkontakte_app_ID', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'vkontakte_login', 'off');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'wowonder_login', 'on');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'wowonder_app_key', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'wowonder_app_ID', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'twitter_app_key', '');",
    "INSERT INTO `config` (`id`, `name`, `value`) VALUES (NULL, 'twitter_app_ID', '');",
    "ALTER TABLE `questions` ADD INDEX(`ask_question_id`);",
    "ALTER TABLE `questions` ADD INDEX(`shared_user_id`);",
    "ALTER TABLE `questions` ADD INDEX(`shared_question_id`);",
    "ALTER TABLE `questions` ADD INDEX(`replay_user_id`);",
    "ALTER TABLE `questions` ADD INDEX(`replay_question_id`);",
    "ALTER TABLE `questions` ADD INDEX(`type`);",
    "ALTER TABLE `questions` ADD INDEX(`public`);",
    "ALTER TABLE `questions` ADD INDEX(`time`);",
    "ALTER TABLE `questions` ADD INDEX(`lat`);",
    "ALTER TABLE `questions` ADD INDEX(`lng`);",
    "ALTER TABLE `questions` ADD INDEX(`promoted`);",
    "ALTER TABLE `notifications` ADD INDEX(`replay_id`);",
    "ALTER TABLE `users` ADD INDEX(`ip_address`);",
    "ALTER TABLE `users` ADD INDEX(`country_id`);",
    "ALTER TABLE `users` ADD INDEX(`verified`);",
    "ALTER TABLE `users` ADD INDEX(`lat`);",
    "ALTER TABLE `users` ADD INDEX(`lng`);",
    "ALTER TABLE `users` ADD `user_upload_limit` VARCHAR(150) NOT NULL AFTER `phone_number`;",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'messages');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'wowonder');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'vkontakte');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select_gender');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select__gender');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'paypal');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'bank_transfer');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'credit_card');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'name');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'card_number');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'upload');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'browse_to_upload');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'replenish');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'amount');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'confirmation');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'deleted');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'currency');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'rent');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'subscribe');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'choose_payment_method');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'error');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'checkout_text');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'address');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'city');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'state');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'zip');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'phone_number');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'yes');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_messages_were_found__please_choose_a_channel_to_chat.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_users_found');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'chat');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'load_more_messages');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'write_message');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'are_you_sure_you_want_delete_chat');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_messages_were_found__say_hi_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_check_the_details');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'confirming_your_payment__please_wait..');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'payment_declined__please_try_again_later.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'verification');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'upload_id');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select_id');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'message');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'submit_request');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'file_is_too_big');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'u_are_verified');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'verif_request_received');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'inactive');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pro_mbr');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'free_mbr');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'type');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'user');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'admin');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'verified');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'not_verified');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'user_upload_limit');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'check_out_text');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'chose_payment_method');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'are_you_sure_you_want_to_delete_the_chat');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'verif_sent');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'upload_your_id');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select_file');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'submit_your_request');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'verification_request_is_still_pending');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'bank_payment_request_sent');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'select_your_id');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'two-factor_authentication');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'phone');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'enable');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'disable');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'phone_number_should_be_as_this_format___90..');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'settings_successfully_updated_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_check_your_details.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'something_went_wrong__please_try_again_later.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_sent_you_an_email_with_the_confirmation_code.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'a_confirmation_message_was_sent.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_sent_a_message_that_contains_the_confirmation_code_to_enable_two-factor_authentication.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'confirmation_code');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_phone_number_has_been_successfully_verified.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'card_charged');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'custom_thumbnail');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'payment_declined');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'payment');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'payment_verification');",

];

$('#input_code').bind("paste keyup input propertychange", function(e) {
    if (isPurchaseCode($(this).val())) {
        $('#button-update').removeAttr('disabled');
    } else {
        $('#button-update').attr('disabled', 'true');
    }
});

function isPurchaseCode(str) {
    var patt = new RegExp("(.*)-(.*)-(.*)-(.*)-(.*)");
    var res = patt.test(str);
    if (res) {
        return true;
    }
    return false;
}

$(document).on('click', '#button-update', function(event) {
    if ($('body').attr('data-update') == 'true') {
        window.location.href = '<?php echo $site_url?>';
        return false;
    }
    $(this).attr('disabled', true);
    $('.wo_update_changelog').html('');
    $('.wo_update_changelog').css({
        background: '#1e2321',
        color: '#fff'
    });
    $('.setting-well h4').text('Updating..');
    $(this).attr('disabled', true);
    RunQuery();
});

var queriesLength = queries.length;
var query = queries[0];
var count = 0;
function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
    }));
}
function RunQuery() {
    var query = queries[count];
    $.post('?update', {
        query: b64EncodeUnicode(query)
    }, function(data, textStatus, xhr) {
        if (data.status == 200) {
            $('.wo_update_changelog').append('<li><span class="added">SUCCESS</span> ~$ mysql > ' + query + '</li>');
        } else {
            $('.wo_update_changelog').append('<li><span class="changed">FAILED</span> ~$ mysql > ' + query + '</li>');
        }
        count = count + 1;
        if (queriesLength > count) {
            setTimeout(function() {
                RunQuery();
            }, 1500);
        } else {
            $('.wo_update_changelog').append('<li><span class="added">Updating Langauges & Categories</span> ~$ languages.sh, Please wait, this might take some time..</li>');
            $.post('?run_lang', {
                update_langs: 'true'
            }, function(data, textStatus, xhr) {
              $('.wo_update_changelog').append('<li><span class="fixed">Finished!</span> ~$ Congratulations! you have successfully updated your site. Thanks for choosing AskMe.</li>');
              $('.setting-well h4').text('Update Log');
              $('#button-update').html('Home <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18"> <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path> </svg>');
              $('#button-update').attr('disabled', false);
              $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
              $('body').attr('data-update', 'true');
            });
        }
        $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
    });
}
</script>