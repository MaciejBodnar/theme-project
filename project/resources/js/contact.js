document.addEventListener('DOMContentLoaded', function () {
  const consentCheckbox = document.getElementById('consent');

  if (consentCheckbox) {
    const checkboxLabel = consentCheckbox.nextElementSibling;
    const checkboxDisplay = checkboxLabel.querySelector('div');

    function updateCheckboxDisplay() {
      if (consentCheckbox.checked) {
        checkboxDisplay.classList.add(
          'checked',
          'border-[#d1b07a]',
          'bg-[#d1b07a]/10'
        );
        checkboxDisplay.classList.remove('border-white/40');
      } else {
        checkboxDisplay.classList.remove(
          'checked',
          'border-[#d1b07a]',
          'bg-[#d1b07a]/10'
        );
        checkboxDisplay.classList.add('border-white/40');
      }
    }

    consentCheckbox.addEventListener('change', updateCheckboxDisplay);
    updateCheckboxDisplay();
  }
});
