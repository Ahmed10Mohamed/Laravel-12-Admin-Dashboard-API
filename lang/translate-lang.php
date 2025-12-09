<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

require __DIR__ . '/../vendor/autoload.php';

// 📁 المسارات داخل مجلد lang/
$sourcePath = __DIR__ . '/en/messages.php';
$targetPath = __DIR__ . '/ar/messages.php';

// ✅ تأكد أن الملف الأصلي موجود
if (!file_exists($sourcePath)) {
    die("❌ الملف $sourcePath غير موجود.\n");
}

// استيراد النصوص الإنجليزية
$messages = include $sourcePath;

// ✅ إنشاء مجلد اللغة العربية إن لم يكن موجودًا
if (!is_dir(dirname($targetPath))) {
    mkdir(dirname($targetPath), 0777, true);
}

// 🧠 تهيئة مترجم Google Translate
$tr = new GoogleTranslate('ar'); // اللغة الهدف: العربية
$tr->setSource('en'); // اللغة الأصلية: الإنجليزية

echo "🔄 جاري ترجمة الملف messages.php إلى العربية...\n";

$translated = [];

foreach ($messages as $key => $value) {
    // تجاهل القيم غير النصية أو الفارغة
    if (!is_string($value) || trim($value) === '') {
        $translated[$key] = $value;
        continue;
    }

    try {
        $translatedValue = $tr->translate($value);
        $translated[$key] = $translatedValue;
        echo "✅ تمت ترجمة: $key\n";
    } catch (Throwable $e) {
        $translated[$key] = $value; // احتفظ بالنص الأصلي إذا حدث خطأ
        echo "⚠️ خطأ أثناء ترجمة [$key]: {$e->getMessage()}\n";
    }

    // ⏱ تأخير بسيط لتجنب حظر Google
    usleep(200000); // 0.2 ثانية
}

// ✍️ حفظ الترجمة في ملف جديد
$exported = var_export($translated, true);
file_put_contents($targetPath, "<?php\nreturn $exported;\n");

echo "\n🎉 تمت الترجمة بنجاح! الملف الناتج: $targetPath\n";