

const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

dropdownToggles.forEach((toggle) => {
  toggle.addEventListener('click', () => {
    toggle.classList.toggle('active');
    const dropdownMenu = toggle.nextElementSibling;
    dropdownMenu.classList.toggle('show');
  });
});

document.addEventListener('click', (event) => {
  if (!event.target.matches('.dropdown-toggle')) {
    dropdownToggles.forEach((toggle) => {
      const dropdownMenu = toggle.nextElementSibling;
      if (dropdownMenu.classList.contains('show')) {
        toggle.classList.remove('active');
        dropdownMenu.classList.remove('show');
      }
    });
  }
});

function toggleMode(mode) {
    const body = document.body;
    const lightModeButton = document.getElementById('lightModeButton');
    const darkModeButton = document.getElementById('darkModeButton');

 

    if (mode === 'light') {
        body.classList.remove('dark-mode');
        lightModeButton.disabled = true;
        darkModeButton.disabled = false;
    } else if (mode === 'dark') {
        body.classList.add('dark-mode');
        lightModeButton.disabled = false;
        darkModeButton.disabled = true;
    }
}


