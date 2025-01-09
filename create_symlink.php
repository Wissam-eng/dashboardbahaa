<?php

// تأكد أن هذه الوظيفة متاحة على الاستضافة
try {
    symlink('storage/app/public', 'public/storage');
    echo "Symlink created successfully.";
} catch (Exception $e) {
    echo "Error creating symlink: " . $e->getMessage();
}
