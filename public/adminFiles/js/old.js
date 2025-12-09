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

    const filters = {
      search: form.querySelector('input[name="search"]')?.value || 'الكل',
      mainCategory: form.querySelector('select[name="play_ground_category_id"]')?.selectedOptions[0]?.textContent.trim() || 'الكل',
      subCategory: form.querySelector('select[name="sub_category"]')?.selectedOptions[0]?.textContent.trim() || 'الكل',
      fromDate: form.querySelector('input[name="from"]')?.value || 'غير محدد',
      toDate: form.querySelector('input[name="to"]')?.value || 'غير محدد',
      fromTime: form.querySelector('input[name="bookingFrom"]')?.value || 'غير محدد',
      toTime: form.querySelector('input[name="bookingTo"]')?.value || 'غير محدد'
    };

    const tableClone = wrapper.cloneNode(true);
    tableClone.querySelectorAll('table').forEach(tbl => {
      tbl.removeAttribute('class');
      tbl.removeAttribute('id');
      tbl.style = '';
    });
    const tableContent = tableClone.innerHTML;

    const logoUrl = printBtn.dataset.logo || '';
    const now = new Date();
    const formattedDate = now.toLocaleDateString('ar-EG', { year: 'numeric', month: 'long', day: 'numeric' });
    const formattedTime = now.toLocaleTimeString('ar-EG', { hour: '2-digit', minute: '2-digit' });

    const html = `
<!doctype html>
<html dir="rtl" lang="ar">
<head>
<meta charset="utf-8">
<title>تقرير الحجوزات</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Cairo', sans-serif;
    margin: 30px;
    direction: rtl;
    text-align: right;
    background: #fff;
    color: #222;
  }

  .header {
    text-align: center;
    margin-bottom: 25px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
  }

  .header img {
    width: 100px;
    margin-bottom: 5px;
  }

  .header h2 {
    margin: 5px 0;
    font-size: 22px;
    color: #007bff;
  }

  .date {
    color: #555;
    font-size: 13px;
  }

  .filters {
    border: 1px solid #ddd;
    background: #f9f9f9;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
  }

  .filters p {
    margin: 5px 0;
    font-size: 14px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    table-layout: auto;
  }

  th, td {
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 13px;
    text-align: center;
    vertical-align: middle;
    white-space: normal;
    word-wrap: break-word;
  }

  th {
    background: #f1f5f9;
    font-weight: 600;
  }

  tr:nth-child(even) {
    background: #fafafa;
  }

  td img {
    max-width: 80px;
    max-height: 60px;
    border-radius: 4px;
  }

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

  @media print {
    .actions { display: none; }
    title, a[href]:after { display: none; }
  }
</style>
</head>
<body>
  <div class="header">
    ${logoUrl ? `<img src="${logoUrl}" alt="شعار">` : ''}
    <h2>📋 تقرير الحجوزات</h2>
    <div class="date">تاريخ الطباعة: ${formattedDate} - ${formattedTime}</div>
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
