document.addEventListener("DOMContentLoaded", function () {
    function updateDate() {
      const dateEl = document.getElementById("auto-date");
      if (!dateEl) return; // safety check
  
      const now = new Date();
  
      const formatted = now.toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
  
      dateEl.textContent = formatted;
    }
  
    updateDate();
  
    // Optional: Update at midnight if page is left open
    setInterval(() => {
      const now = new Date();
      if (now.getHours() === 0 && now.getMinutes() === 0) {
        updateDate();
      }
    }, 60000); // Check every minute
  });
  