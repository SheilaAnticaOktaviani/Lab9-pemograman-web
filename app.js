document.addEventListener('DOMContentLoaded', () => {
  // Konfirmasi hapus (fallback jika atribut inline tidak ada)
  document.body.addEventListener('click', (e) => {
    const a = e.target.closest('a');
    if (!a) return;
    const href = a.getAttribute('href') || '';
    if (href.includes('page=user/hapus')) {
      if (!confirm('Hapus data ini?')) {
        e.preventDefault();
        e.stopPropagation();
      }
    }
  });

  // Batasi input angka pada field numerik
  function restrictNumber(selector) {
    document.querySelectorAll(selector).forEach((el) => {
      el.addEventListener('input', () => {
        el.value = el.value.replace(/[^0-9]/g, '');
      });
    });
  }
  restrictNumber('input[name="harga_jual"], input[name="harga_beli"], input[name="stok"]');
});
