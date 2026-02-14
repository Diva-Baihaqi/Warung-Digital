// Neo-Brutalism Alert System
// Override default styling
const swalNeoConfig = {
  background: "#fff",
  color: "#000",
  backdrop: "rgba(0,0,0,0.8)",
  padding: "0",
  customClass: {
    popup: "border-4 border-black shadow-[8px_8px_0px_0px_#000] rounded-none",
    title:
      "text-2xl font-black uppercase bg-yellow-400 border-b-4 border-black p-4 m-0 w-full",
    htmlContainer: "text-lg font-bold p-6 m-0",
    actions: "border-t-4 border-black p-4 w-full bg-gray-50 m-0",
    confirmButton:
      "bg-black text-white px-6 py-3 font-black uppercase border-2 border-black hover:bg-gray-800 hover:shadow-none shadow-[4px_4px_0px_0px_#000] transition-all rounded-none mx-2",
    cancelButton:
      "bg-white text-black px-6 py-3 font-black uppercase border-2 border-black hover:bg-gray-100 hover:shadow-none shadow-[4px_4px_0px_0px_#000] transition-all rounded-none mx-2",
  },
  buttonsStyling: false,
  showClass: {
    popup: "animate__animated animate__bounceIn",
  },
  hideClass: {
    popup: "animate__animated animate__fadeOutUp",
  },
};

// Global function to handle link confirmations
window.confirmAction = function (e, message, url) {
  e.preventDefault();

  Swal.fire({
    ...swalNeoConfig,
    title: "KONFIRMASI",
    text: message || "Yakin ingin melanjutkan?",
    icon: null,
    showCancelButton: true,
    confirmButtonText: "YA, LANJUTKAN",
    cancelButtonText: "BATAL",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = url;
    }
  });

  return false;
};

// Global function to handle form confirmations
window.confirmForm = function (e, message) {
  // If the form was already confirmed, let it submit
  if (e.target.dataset.confirmed) return true;

  e.preventDefault();
  const form = e.target;

  Swal.fire({
    ...swalNeoConfig,
    title: "KONFIRMASI",
    text: message || "Proses data ini?",
    icon: null,
    showCancelButton: true,
    confirmButtonText: "YA, PROSES",
    cancelButtonText: "BATAL",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      form.dataset.confirmed = "true";
      form.submit();
    }
  });

  return false;
};

// Override standard alert
window.alert = function (message) {
  Swal.fire({
    ...swalNeoConfig,
    title: "INFORMASI",
    text: message,
    confirmButtonText: "OK SIAP",
  });
};

// Helper for PHP redirects with alert
window.alertRedirect = function (message, url) {
  Swal.fire({
    ...swalNeoConfig,
    title: "SUKSES",
    text: message,
    confirmButtonText: "LANJUT",
  }).then(() => {
    window.location.href = url;
  });
};
