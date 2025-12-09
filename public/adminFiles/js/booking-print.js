document.addEventListener('DOMContentLoaded', function () {
  const printBtn = document.getElementById('printBtn');
  if (!printBtn) return;

  printBtn.addEventListener('click', () => {
    const form = document.getElementById('bookingFilterForm');
    const wrapper = document.getElementById('bookingTableWrapper');
    if (!form || !wrapper) {
      alert('خطأ: عناصر الصفحة مفقودة للطباعة.');
      return;
    }

    // ===== جمع الفلاتر =====
    const filters = {
      search: form.querySelector('input[name="search"]')?.value || 'الكل',
      mainCategory: form.querySelector('select[name="play_ground_category_id"]')?.selectedOptions[0]?.textContent.trim() || 'الكل',
      subCategory: form.querySelector('select[name="sub_category"]')?.selectedOptions[0]?.textContent.trim() || 'الكل',
      fromDate: form.querySelector('input[name="from"]')?.value || 'غير محدد',
      toDate: form.querySelector('input[name="to"]')?.value || 'غير محدد',
      fromTime: form.querySelector('input[name="bookingFrom"]')?.value || 'غير محدد',
      toTime: form.querySelector('input[name="bookingTo"]')?.value || 'غير محدد'
    };

    // ===== استنساخ الجدول =====
    const tableClone = wrapper.cloneNode(true);
    tableClone.querySelectorAll('table').forEach(tbl => {
      tbl.removeAttribute('class');
      tbl.removeAttribute('id');
      tbl.style = '';
    });
    const tableContent = tableClone.innerHTML;

    const logoUrl = printBtn.dataset.logo || '';

    // ===== التاريخ الجديد المحسن بالعربي =====
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

    // ===== HTML الطباعة =====
    const html = `
<!doctype html>
<html dir="rtl" lang="ar">
<head>
<meta charset="utf-8">
<title>تقرير الحجوزات</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Cairo', sans-serif;
    margin: 30px;
    background: #fff;
    color: #000;
    font-size: 15px;
  }

  /* الهيدر */
  .header {
    text-align: center;
    margin-bottom: 25px;
    padding-bottom: 12px;
    border-bottom: 3px solid #253b79;
  }

  .header img {
    width: 120px;
    margin-bottom: 5px;
  }

  .header h2 {
    margin: 8px 0;
    font-size: 26px;
    font-weight: 700;
    color: #253b79;
  }

  .date {
    font-size: 15px;
    color: #444;
    margin-top: 4px;
  }

  /* الجدول */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    border: 1px solid #bbb;
  }

  th, td {
    border: 1px solid #bbb;
    padding: 10px 8px;
    font-size: 15px;
    text-align: center;
    vertical-align: middle;
  }

  /* تمييز العناوين */
  th {
    background: #253b79;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
  }

  /* تظليل الصفوف */
  tr:nth-child(even) td {
    background: #f5f7fa;
  }

  /* الصور داخل الجدول */
  td img {
    max-width: 85px;
    max-height: 65px;
    border-radius: 4px;
  }

  /* أزرار الطباعة */
  .actions {
    text-align: center;
    margin-top: 30px;
  }

  .btn-print, .btn-cancel {
    padding: 12px 26px;
    margin: 0 10px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
  }

  .btn-print { background: #198754; color: white; }
  .btn-cancel { background: #dc3545; color: white; }

  /* إعدادات الطباعة */
  @media print {
    .actions { display: none; }
    body { zoom: 0.92; }
    @page { size: A4 portrait; margin: 10mm; }
  }
</style>
</head>

<body>

  <div class="header">
    ${logoUrl ? `<img src="${logoUrl}" alt="شعار">` : ''}
    <h2>📋 تقرير الحجوزات</h2>
    <div class="date">تاريخ الطباعة: ${formattedDate}</div>
  </div>

  <div id="print-table-wrapper">
    ${tableContent}
  </div>

  <div class="actions">
    <button class="btn-print" id="confirmPrint">🖨️ اطبع الآن</button>
    <button class="btn-cancel" id="cancelPrint">❌ إلغاء</button>
  </div>

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

    const printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write(html);
    printWindow.document.close();

  });
});
