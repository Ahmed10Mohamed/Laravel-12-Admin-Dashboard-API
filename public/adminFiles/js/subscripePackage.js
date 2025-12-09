document.addEventListener('DOMContentLoaded', function () {
    const printBtn = document.getElementById('printBtn');
    if (!printBtn) return;

    printBtn.addEventListener('click', () => {
        const wrapper = document.getElementById('bookingTableWrapper');
        if (!wrapper) {
            alert('خطأ: عناصر الصفحة مفقودة للطباعة.');
            return;
        }

        // نسخ الجدول
        const tableClone = wrapper.cloneNode(true);

        // إخفاء عمود الأكشن (آخر عمود)
        tableClone.querySelectorAll('tr').forEach(row => {
            const cells = row.querySelectorAll('th, td');
            if (cells.length > 0) {
                cells[cells.length - 1].style.display = 'none';
            }
        });

        // تنظيف الكلاسات من الجدول المستنسخ
        tableClone.querySelectorAll('table').forEach(tbl => {
            tbl.removeAttribute('class');
            tbl.removeAttribute('id');
            tbl.style = '';
        });

        const tableContent = tableClone.innerHTML;

        const logoUrl = printBtn.dataset.logo || '';

        // ---------------------------
        // ⭐ دالة التاريخ الجديدة الصحيحة
        // ---------------------------
        function getFormattedPrintDate() {
            const now = new Date();

            const months = [
                "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
                "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
            ];

            const day = now.getDate().toString().padStart(2, '0');
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            let hours = now.getHours();
            const minutes = now.getMinutes().toString().padStart(2, '0');

            const period = hours >= 12 ? "م" : "ص";
            hours = (hours % 12) || 12;

            return `${day} ${month} ${year} - ${hours}:${minutes} ${period}`;
        }

        const formattedDate = getFormattedPrintDate();

        // ---------------------------
        // الطباعة — الشكل الاحترافي
        // ---------------------------

        const html = `
<!doctype html>
<html dir="rtl" lang="ar">
<head>
<meta charset="utf-8">
<title>تقرير الاشتراكات</title>

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

<style>

    /* إعدادات عامة */
    body {
        font-family: 'Cairo', sans-serif;
        margin: 25px;
        background: #fff;
        color: #222;
        line-height: 1.6;
        font-size: 15px;
    }

    /* الهيدر */
    .header {
        text-align: center;
        margin-bottom: 25px;
        border-bottom: 2px solid #253b79;
        padding-bottom: 15px;
    }

    .header img {
        width: 110px;
        margin-bottom: 8px;
    }

    .header h2 {
        margin: 5px 0;
        font-size: 28px;
        font-weight: 700;
        color: #253b79;
    }

    .date {
        color: #444;
        font-size: 15px;
        margin-top: 5px;
    }

    /* الجدول */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        table-layout: fixed;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px 6px;
        font-size: 15px;
        word-wrap: break-word;
        text-align: center;
    }

    /* تظليل عناوين الأعمدة */
    th {
        background: #253b79 !important;
        color: #fff !important;
        font-weight: 700;
        font-size: 16px !important;
    }

    /* تظليل الصفوف بالتبادل */
    tr:nth-child(even) td {
        background-color: #f8f9fa;
    }

    /* البوتونات */
    .actions {
        text-align: center;
        margin-top: 25px;
    }

    .btn-print, .btn-cancel {
        display: inline-block;
        margin: 0 8px;
        padding: 10px 25px;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        cursor: pointer;
    }

    .btn-print {
        background: #198754;
        color: white;
    }

    .btn-cancel {
        background: #dc3545;
        color: white;
    }

    /* الفوتر */
    footer {
        position: fixed;
        bottom: 5px;
        left: 0;
        right: 0;
        font-size: 12px;
        text-align: center;
        color: #444;
    }
    footer::after {
        content: "الصفحة " counter(page);
    }

    /* إعدادات الطباعة */
    @media print {

        .actions { display: none; }

        body { zoom: 0.90; }

        @page {
            size: A4 portrait;
            margin: 12mm;
        }
    }

</style>

</head>

<body>

    <div class="header">
        ${logoUrl ? `<img src="${logoUrl}" alt="شعار">` : ''}
        <h2>📋 تقرير الاشتراكات</h2>
        <div class="date">تاريخ الطباعة: ${formattedDate}</div>
    </div>

    <div id="print-table-wrapper">
        ${tableContent}
    </div>

    <div class="actions">
        <button class="btn-print" id="confirmPrint">🖨️ اطبع الآن</button>
        <button class="btn-cancel" id="cancelPrint">❌ إلغاء</button>
    </div>

    <footer></footer>

    <script>
        document.getElementById('confirmPrint').addEventListener('click', () => {
            window.print();
            setTimeout(() => window.close(), 2000);
        });
        document.getElementById('cancelPrint').addEventListener('click', () => {
            window.close();
        });
    </script>

</body>
</html>
`.trim();

        // فتح نافذة الطباعة
        const printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write(html);
        printWindow.document.close();

    });
});
