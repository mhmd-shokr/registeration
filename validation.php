<?php
// دالة للتحقق من أن القيمة غير فارغة
function validate_not_empty($input, $field_name) {
    if (empty($input)) {
        return "$field_name is required.";
    }
    return null;
}

// دالة للتحقق من البريد الإلكتروني
function validate_email($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    return null;
}

// دالة للتحقق من أن الهاتف يحتوي فقط على أرقام
function validate_phone($phone) {
    if (!preg_match('/^[0-9]+$/', $phone)) {
        return "Telephone must be a valid number.";
    }
    return null;
}

// دالة للتحقق من التاريخ
function validate_date($date) {
    $current_date = date('Y-m-d');
    if ($date < $current_date) {
        return "Date cannot be in the past.";
    }
    return null;
}

// دالة رئيسية لتنفيذ جميع التحقق
function validate_input($name, $email, $address, $telephone, $date) {
    $errors = [];

    // تحقق من البيانات
    $name_error = validate_not_empty($name, "Name");
    if ($name_error) $errors[] = $name_error;

    $email_error = validate_not_empty($email, "Email");
    if ($email_error) $errors[] = $email_error;
    else {
        $email_error = validate_email($email);
        if ($email_error) $errors[] = $email_error;
    }

    $address_error = validate_not_empty($address, "Address");
    if ($address_error) $errors[] = $address_error;

    $telephone_error = validate_not_empty($telephone, "Telephone");
    if ($telephone_error) $errors[] = $telephone_error;
    else {
        $telephone_error = validate_phone($telephone);
        if ($telephone_error) $errors[] = $telephone_error;
    }

    $date_error = validate_not_empty($date, "Date");
    if ($date_error) $errors[] = $date_error;
    else {
        $date_error = validate_date($date);
        if ($date_error) $errors[] = $date_error;
    }

    return $errors;
}
?>
